<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountVideo;
use App\Models\Book;
use App\Models\Courses;
use App\Models\Profession;
use App\Models\Specialty;
use App\Models\Videos;
use App\Services\CourseService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

/**
 * @group Course
 *
 * APIs for a course
 * @package App\Http\Controllers\Frontend
 */
class CourseAppController extends Controller
{

    /**
     * @var CourseService
     */
    protected $service;

    /**
     * CourseAppController constructor.
     * @param CourseService $service
     */
    public function __construct(CourseService $service)
    {
        $this->service = $service;
//        $this->user = JWTAuth::parseToken()->authenticate();
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get all courses by specialty
     * get all courses by specialty
     *
     * @queryParam access_token token
     * @queryParam id The professions id ex for Ուռոլոգիա.  Example: "30" for Ուռոլոգիա
     * @queryParam mobile Check request from the mobile devise or not. Example: "false"
     *
     *
     * @response
     *{
     * "access_token":"",
     * "courses":{"1":{"id":1,"name":"sd","image":null,"cost":47,"start_date":"2021-10-05"},"2":{"id":2,"name":"sd ds","image":null,"cost":47,"start_date":"2021-10-05"}},
     * "token_type":"bearer",
     * "expires_in":21600000
     * }
     */
    function getCourseBySpec()
    {
        try {
            $mobile = (bool)request('mobile');
            $courses = $this->service->getCourses(request('id'), $mobile);
            return response()->json([
                'access_token' => request('token'),
                'courses' => $courses,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    function getCourseTitleById()
    {
        try {

            $title = $this->service->getCourseTitleById(request('id'));

            return response()->json([
                'access_token' => request('token'),
                'title' => $title,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    function getCourseInfo()
    {
        try {

            $courses = $this->service->getCoursesInfo(request('id'));

            return response()->json([
                'access_token' => request('token'),
                'courses' => $courses,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    /**
     * Get book by id
     * get book`s page count and path
     * ցիկլով count-ով ստսնալ նակարները ինդեքներով․jpg
     * օր՝ 1.jpg, 2.jpg, 3.jpg
     *
     * @queryParam access_token token
     * @queryParam id The course id
     *
     *
     * @response
     *{"access_token":"",
     * "book":{"count":3,"path":"\/uploads\/books\/1"},
     * "token_type":"bearer",
     * "expires_in":21600000}
     */
    function getBooksById()
    {
        try {
            $result = $this->service->getBook(request('id'));

            if (is_int($result)) {
                $book['count'] = $result;
                $book['path'] = trim(Config::get('constants.UPLOADS'), "/") . Config::get('constants.BOOKS') . request('id');
                $book['links'] = [];
                $storage = Storage::disk('s3');
                for ($i = 1; $i <= $result; $i++) {
                    $book['links'][$i] = $storage->temporaryUrl(sprintf('%s/%d.jpg', $book['path'], $i), now()->addHours());
                }

                return response()->json([
                    'access_token' => request('token'),
                    'book' => $book,
                    'token_type' => 'bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 60
                ]);
            } else
                return response()->json(['error' => true], 404);
        } catch (MethodNotAllowedHttpException$exception) {
            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    function getBookById()
    {
        try {
            $book = $this->service->getBookById(request('id'));
            return response()->json([
                'access_token' => request('token'),
                'book' => $book,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    /**
     * Get Tests
     * get Test by id if watched the videos
     * if in response the fV = 0 // so he did not pass the test
     *
     * @queryParam access_token token Example: token
     * @queryParam id The account id to filter Example: 1
     *
     * @response
     * {
     * "access_token":"",
     * "fv": "0 || 1"
     * "tests":[],
     * "token_type":"bearer",
     * "expires_in":21600000}
     */
    function getTestsById()
    {
        try {
            $tests = $this->service->getTestsById(request('id'), request('account_id'));

            return response()->json([
                'access_token' => request('token'),
                'tests' => $tests,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function coursedetails()
    {
        $type = "";
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
                        $v = Videos::where('id', $video)->with(['lectures' => function ($query) {
                            $query->select('id', 'name', 'surname',
                                'father_name', 'bday', 'image_name', 'role');
                        }])->first();
                        if (!empty($v)) {
                            $p = Profession::where('account_id', $v->lectures->id)
                                ->with('spec')->first();
                            $s3_videos[$index] = $v;
                            $s3_videos[$index]['spec'] = $p->spec->name;
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

                $parent_start = Specialty::query()->select('type_id')->where('id', $spec_ids[0])->first();
                $parent_end = Specialty::query()->select('type_id')->where('id', $spec_ids[count($spec_ids) - 1])->first();

                $count = Specialty::whereIn('type_id', [$parent_start->type_id, $parent_end->type_id])->
                whereNotNull('parent_id')->count();

                if ($count == count($spec_ids))
                    $type = ($parent_start->type_id == "1" || $parent_start->type_id == "3") ? "senior" : "middle";
                if($parent_start->type_id == 1 && $parent_end->type_id == 4)
                    $type = "all";
                for ($i = 0; $i < count($spec_ids); $i++) {
                    $specialtis = Specialty::query()->find($spec_ids[$i]);
                    $specialties_obj[] = ["id" => $specialtis->id,
                        "name" => $specialtis->name];
                }
            }
            //$courses["specialities"] = $specialties_obj;
        }
        return response()->json(['data' => $courses, 'specialities' => $specialties_obj, 'type' => $type]);
    }

    /**
     * Get Tests
     * get Test by id if watched the videos
     * if in response the fV = 0 // so he did not pass the test
     *
     * @queryParam access_token token Example: token
     * @queryParam id The account id to filter Example: 1
     *
     * @response
     * {
     * "access_token":"",
     * "fv": "0 || 1"
     * "tests":[],
     * "token_type":"bearer",
     * "expires_in":21600000}
     */
    public function finishedCount()
    {
        $isFinished = true;
        $videos = Courses::select('videos')->where('id', request('id'))->first();
        if (!empty($videos->vidos)) {

            $videos = json_decode($videos->videos);
            foreach ($videos as $index => $video) {
                $status = AccountVideo::select('status')
                    ->where([["video_id", $video], ['account_id', request('user_id')]])
                    ->first();

                if ((!empty($status) && $status->status != "finished") || empty($status)) {
                    $isFinished = false;
                    break;
                }
            }
        }
        return $isFinished;
    }

    /**
     * Check Course Test count
     * get watched the test video or not
     *
     * @queryParam access_token token. Example: token
     * @queryParam id The course id to filter. Example: 1
     * @queryParam user_id The account id to filter. Example: 2
     *
     *
     * @response
     *{
     * "": "1|0 true or false"
     * }
     */
    public function finishedVideo()
    {
        $isMamber = Profession::select('member_of_palace')
            ->where('account_id', request('user_id'))
            ->first();
        $isFinished = 1;
        if (!$isMamber->member_of_palace) {
            $videos = Courses::select('id', 'videos')
                ->with(['account_course' => function ($query) {
                    $query->select('course_id')->
                    where('course_id', request('id'));
                }])
                ->where('id', request('id'))
                ->first();

            if (!empty($videos->account_course)) {
                if (!empty($videos->videos)) {
                    $videos = json_decode($videos->videos);
                    if (!empty($videos)) {
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
            } else
                $isFinished = -1;
        }

        return $isFinished;
    }

    /**
     * @return mixed
     */
    public function guard()
    {
        return \Auth::Guard('api');
    }
}
