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
            $courses = $this->service->getCourses(request('id'));

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
     * Payment- Init Payment Request
     * Init Payment Request
     *
     * @queryParam ClientID The client ID Example:
     * @queryParam Username The username Example: username
     * @queryParam Password The password Example: password
     * @queryParam Currency The currency  to filter Example:AMD
     * @queryParam Description The description Example: SHMZ
     * @queryParam Amount The amount Example:10
     * @queryParam OrderID The Order ID to filter Example: AMD
     * @queryParam BackURL The back url Example: https://www.shmz.am/lesson
     * @queryParam Opaque The opaque Example: TEST Opaque VPOS
     * @queryParam CardHolderID The card holder ID url Example: TEST CARD VPOS
     *
     * @response
     * {
     * "PaymentID": "sample string 1",
     * "ResponseCode": 2,
     * "ResponseMessage": "sample string 3"
     * }
     */
    function payment()
    {
        try {
            $data = [];
            $data['ClientID'] = '945431d0-ee02-4129-bacd-fc68eb0698ba';
            $data['Amount'] = 10;
            $data['OrderID'] = 2357353;
            $data["BackURL"] = "https://www.shmz.am/lesson";
            $data['Username'] = '3d19541048';
            $data['Password'] = 'lazY2k';
            $data['Description'] = 'name';
            $data['Cardholder'] = 'TEST CARD VPOS';
            $data['Currency'] = 'AMD';
            $data['Opaque'] = 'TEST Opaque VPOS';
//
            $endpoint = "https://servicestest.ameriabank.am/VPOS/api/VPOS/InitPayment";
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST',
                $endpoint, ['form_params' => $data]);
            $statusCode = $response->getStatusCode();
            $content = $response->getBody();
            $content = json_decode($response->getBody(), true);
            return response()->json([
                'access_token' => request('token'),
                'payment' => $content,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException $exception) {
            dd($exception);
            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    function getPayment()
    {
        $data['Username'] = '3d19541048';
        $data['Password'] = 'lazY2k';
        $data['PaymentID'] = request('PaymentID');

        $endpoint = "https://servicestest.ameriabank.am/VPOS/api/VPOS/GetPaymentDetails";
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST',
            $endpoint, ['form_params' => $data]);
        $statusCode = $response->getStatusCode();
        $content = $response->getBody();
        $content = json_decode($response->getBody(), true);
        //$data['PaymentID']
        //Amount
        //ClientName
        //DateTime
        //DepositedAmount

        return response()->json([
            'access_token' => request('token'),
            'getpayment' => $content,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
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
     * @queryParam access_token token
     * @queryParam course_id The course id to filter
     * @queryParam account_id The account id to filter
     *
     * @response
     * {
     * "access_token": "",
     * "tests": [
     * {
     * "id": 1,
     * "courses_id": 1,
     * "question": "harc harc harc harc harc",
     * "answers": "[{\"inp\":\"<p>patasxan patasxan patasxan patasxan patasxan patasxan<\\/p>\"},{\"inp\":\"<p>patasxan patasxan patasxan patasxan patasxan patasxan1<\\/p>\",\"check\":\"1\"},{\"inp\":\"<p>patasxan patasxan patasxan patasxan patasxan patasxan2<\\/p><p><img src=\\\"https:\\/\\/natmedpalace.s3.amazonaws.com\\/uploads%2Ftest%2Fimages1603703829126-logo.png\\\" style=\\\"width: 45px;\\\" class=\\\"fr-fic fr-dib\\\"><\\/p>\"}]",
     * "question_icons_paths": null,
     * "answers_icons_paths": null,
     * "updated_at": "2020-11-07T11:24:21.000000Z",
     * "created_at": "2020-10-26T09:17:59.000000Z"
     * },
     * {
     * "id": 2,
     * "courses_id": 1,
     * "question": "harc harc harc harc harc 2",
     * "answers": "[{\"inp\":\"<p>patasxan <span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">patasxan<\\/span> &nbsp;<span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">patasxan<\\/span> &nbsp;<span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">patasxan<\\/span> &nbsp;<span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">patasxan<\\/span> &nbsp;<span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">patasxan<\\/span>&nbsp; <\\/p>\",\"check\":\"1\"},{\"inp\":\"<p><img src=\\\"https:\\/\\/natmedpalace.s3.amazonaws.com\\/uploads%2Ftest%2Fimages1603704561246-x.png\\\" style=\\\"width: 89px;\\\" class=\\\"fr-fic fr-dib\\\"><\\/p><p><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">patasxan&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;<\\/span>&nbsp;<\\/p><p><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">patasxan&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;<\\/span> <\\/p>\",\"check\":\"1\"},{\"inp\":\"<p><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">patasxan&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;&nbsp;<\\/span><span style=\\\"box-sizing: border-box; color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-style: initial; text-decoration-color: initial; background-color: rgb(255, 255, 255); float: none; display: inline !important;\\\">patasxan<\\/span><span style=\\\"color: rgb(65, 65, 65); font-family: sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\\\">&nbsp;<\\/span> <\\/p>\"}]",
     * "question_icons_paths": null,
     * "answers_icons_paths": null,
     * "updated_at": "2020-10-26T09:29:50.000000Z",
     * "created_at": "2020-10-26T09:29:50.000000Z"
     * },
     * {
     * "id": 4,
     * "courses_id": 1,
     * "question": "harc harc harc harc harc 2",
     * "answers": "[{\"inp\":\"<p>patasxan patasxan patasxan patasxan patasxan 5<\\/p>\",\"check\":\"1\"},{\"inp\":\"<p><img src=\\\"https:\\/\\/natmedpalace.s3.amazonaws.com\\/uploads%2Ftest%2Fimages1603704561246-x.png\\\" style=\\\"width: 89px;\\\" class=\\\"fr-fic fr-dib\\\"><\\/p><p>patasxan patasxan patasxan patasxan patasxan patasxan patasxan 5<\\/p>\",\"check\":\"1\"},{\"inp\":\"<p>patasxan patasxan patasxan patasxan patasxan patasxan patasxan 9<\\/p>\"}]",
     * "question_icons_paths": null,
     * "answers_icons_paths": null,
     * "updated_at": "2020-11-07T11:28:42.000000Z",
     * "created_at": "2020-10-26T09:29:50.000000Z"
     * },
     * {
     * "id": 8,
     * "courses_id": 1,
     * "question": "harc harc harc harc harc 1",
     * "answers": "[{\"inp\":\"<p>answers, answers<\\/p>\", \"check\":\"1\"},{\"inp\":\"<p>answers, answers, answers<\\/p>\"},{\"inp\":\"<p>answers, answer, answer,&nbsp; answer<\\/p>\"}]",
     * "question_icons_paths": null,
     * "answers_icons_paths": null,
     * "updated_at": "2020-11-07T13:19:11.000000Z",
     * "created_at": "2020-11-07T13:19:11.000000Z"
     * },
     * {
     * "id": 10,
     * "courses_id": 1,
     * "question": "harc harc harc harc harc 1",
     * "answers": "[{\"inp\":\"<p>answers, answers<\\/p>\", \"check\":\"1\"},{\"inp\":\"<p>answers, answers, answers<\\/p>\"},{\"inp\":\"<p>answers, answer, answer,&nbsp; answer<\\/p>\"}]",
     * "question_icons_paths": null,
     * "answers_icons_paths": null,
     * "updated_at": "2020-11-07T13:19:11.000000Z",
     * "created_at": "2020-11-07T13:19:11.000000Z"
     * }
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
                    $path = Config::get('constants.UPLOADS') . Config::get('constants.BOOKS') . request('id');
                    $b = Book::select('id', 'title')->where('id', $book)->first();

                    $s3_books[$index] = $b;
                    $s3_books[$index]['count'] = $this->service->getBook(request('id'));
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
