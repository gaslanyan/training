<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AccountVideo;
use App\Models\Book;
use App\Models\Courses;
use App\Models\Specialty;
use App\Models\Videos;
use App\Services\CourseService;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


class CourseController extends Controller
{

    protected $service;


    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }


    public function allCourses()
    {
        try {
            $courses = $this->service->all();
            return response()->json(['data' => $courses]);
        } catch (MethodNotAllowedHttpException$exception) {
            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function courseinfo()
    {
        $courses = Courses::where("id", '=', request('id'))->first();

        if (isset($courses)) {
            if ($courses->books) {
                $books = json_decode($courses->books);
                $s3_books = [];
//                if (!$videos->isEmpty()) {
                foreach ($books as $index => $book) {
                    $path = Config::get('constants.UPLOADS') . Config::get('constants.BOOKS') . $book;
                    $b = Book::select('id', 'title')->where('id', $book)->first();

                    $s3_books[$index] = $b;
                    $s3_books[$index]['count'] = $this->service->getBook($book);
                    $s3_books[$index]['path'] = $path;
//                    $s3_books[$index]['path'] = sprintf("%s/%s", env('AWS_URL_ACL'), $b->path);
                }
                $courses->books = json_encode($s3_books, true);

            }
            if ($courses->videos) {
                $videos = json_decode($courses->videos);
                $s3_videos = [];
                if (!empty($videos)) {
                    foreach ($videos as $index => $video) {
                        $v = Videos::where('id', $video)->with('lectures')->first();
                        if (!empty($v)) {
                            $s3_videos[$index] = $v;
                            $s3_videos[$index]['path'] = sprintf("%s/%s", env('AWS_URL_ACL'), $v->path);
                        }
                    }
                    $courses->videos = json_encode($s3_videos, true);
                }
            }

            if (!empty($courses->credit)) {
                $credits = json_decode($courses->credit);

                $c = [];
                foreach ($credits as $index => $credit) {
                    $c[$index]['name'] = $credit->name;
                    $c[$index]['credit'] = $credit->credit;
                }

                $courses->credit = json_encode($c, true);
            }
            if ($courses->specialty_ids) {
                $spec_ids = json_decode($courses->specialty_ids);
                for ($i = 0; $i < count($spec_ids); $i++) {
                    $specialtis = Specialty::query()->find($spec_ids[$i]);
                    $specialties_obj[] = ["id" => $specialtis->id,
                        "name" => $specialtis->name];
                }
            }
            //$courses["specialities"] = $specialties_obj;
        }
        return response()->json(['data' => $courses, 'specialities' => $specialties_obj]);
    }


    public function finishedCount()
    {
        $isFinished = 1;
        $videos = Courses::select('id', 'videos')
            ->with(['account_course' => function ($query) {
                $query->select('course_id')->where('course_id', request('id'));
            }])
            ->where('id', request('id'))
            ->first();
        if (!empty($videos->account_course)) {
            if (!empty($videos->videos)) {
                $videos = json_decode($videos->videos);

                if (!empty($videos)) {
                    dd(request('user_id'));
                    foreach ($videos as $index => $video) {
                        $status = AccountVideo::select('status')
                            ->where([["video_id", $video], ['account_id', request('user_id')]])
                            ->first();

                        if ((!empty($status) && $status->status != "finished")
                            || empty($status)) {

                            $isFinished = 0;
                            break;
                        }
                    }
                }
            }
        }
        else
            $isFinished = -1;
        return $isFinished;
    }

    function getCourseByProf()
    {
        try {
            $courses = $this->service->getCoursesById(request('id'));
            return response()->json([
                'courses' => $courses,
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    function getCoursesById()
    {
        try {
            $courses = $this->service->getCoursesByIdC(request('id'));
            return response()->json([
                'courses' => $courses,
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }
}
