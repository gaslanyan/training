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

/**
 * @group Course
 *
 * APIs for a course
 * @package App\Http\Controllers\Frontend
 */
class CourseController extends Controller
{

    protected $service;


    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }

    /**
     * All courses
     * get all courses
     * if image = nul by default get /css/frontend/img/logo.png
     *
     *
     * @response
     * {"data":[{"id":1,
     * "name":"Կովիդի Տարածումը",
     * "image":"https:\/\/www.shmz.am\/uploads\/courses\/\u053f\u0578\u057e\u056b\u0564\u056b \u054f\u0561\u0580\u0561\u056e\u0578\u0582\u0574\u0568.jpg",
     * "cost":10,
     * "start_date":"2021-11-24"},
     * {"id":2,
     * "name":"Test",
     * "image":null,
     * "cost":3000,
     * "start_date":"2021-11-16"}
     * ]}
     */

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
