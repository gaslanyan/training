<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AccountVideo;
use App\Models\Book;
use App\Models\Courses;
use App\Models\Profession;
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
     * @return \Illuminate\Http\JsonResponse
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    function getBooksById()
    {
        try {
            $result = $this->service->getBook(request('id'));

            if (is_int($result)) {
                $book['count'] = $result;
                $book['path'] = Config::get('constants.UPLOADS') . Config::get('constants.BOOKS') . request('id');

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
     * Course Test
     * get Test by id
     *
     * @queryParam access_token token Example: token
     * @queryParam id The course id to filter Example: 1
     * @queryParam account_id The account id to filter Example: 2
     *
     * @response
     * {
     * "access_token": "",
     * "tests": [
     * {
     * "id": 1,
     * "courses_id": 1,
     * "question": "harc harc harc harc harc",
     * "answers": "[{\"answer\":\"patasxan patasxan patasxan patasxan patasxan patasxan\"},{\"answer\":\"patasxan patasxan patasxan patasxan patasxan patasxan1\",\"check\":1},{\"img\":\"https:\\/\\/natmedpalace.s3.amazonaws.com\\/uploads%2Ftest%2Fimages1603703829126-logo.png\",\"answer\":\"patasxan patasxan patasxan patasxan patasxan patasxan2\"}]",
     * "question_icons_paths": null,
     * "answers_icons_paths": null,
     * "updated_at": "2020-11-07T11:24:21.000000Z",
     * "created_at": "2020-10-26T09:17:59.000000Z"
     * },
     * {
     * "id": 2,
     * "courses_id": 1,
     * "question": "harc harc harc harc harc 2",
     * "answers": "[{\"answer\":\"patasxan patasxan &nbsp;patasxan &nbsp;patasxan &nbsp;patasxan &nbsp;patasxan&nbsp; \",\"check\":1},{\"img\":\"https:\\/\\/natmedpalace.s3.amazonaws.com\\/uploads%2Ftest%2Fimages1603704561246-x.png\",\"answer\":\"patasxan&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp; \",\"check\":1},{\"answer\":\"patasxan&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp;&nbsp;patasxan&nbsp; \"}]",
     * "question_icons_paths": null,
     * "answers_icons_paths": null,
     * "updated_at": "2020-10-26T09:29:50.000000Z",
     * "created_at": "2020-10-26T09:29:50.000000Z"
     * },
     * {
     * "id": 3,
     * "courses_id": 1,
     * "question": "harc harc harc harc harc 2",
     * "answers": "[{\"answer\":\"patasxan patasxan patasxan patasxan patasxan patasxan\",\"check\":1},{\"img\":\"https:\\/\\/natmedpalace.s3.amazonaws.com\\/uploads%2Ftest%2Fimages1603704561246-x.png\",\"answer\":\"patasxan patasxan patasxan patasxan patasxan patasxan2patasxan patasxan patasxan patasxan patasxan patasxan\",\"check\":1},{\"answer\":\"patasxan patasxan patasxan patasxan patasxan patasxan3\"}]",
     * "question_icons_paths": null,
     * "answers_icons_paths": null,
     * "updated_at": "2020-11-07T11:26:11.000000Z",
     * "created_at": "2020-10-26T09:29:50.000000Z"
     * },
     * ],
     * "token_type": "bearer",
     * "expires_in": 21600000
     * }
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
                            $query->select('id','name','surname',
                                'father_name','bday','image_name', 'role');
                        }])->first();
                        if (!empty($v)) {
                            $p =Profession::where('account_id',$v->lectures->id)
                            ->with('prof')->first();
                            dd($p);
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

    /**
     * @return bool
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
     * @return mixed
     */
    public function guard()
    {
        return \Auth::Guard('api');
    }
}
