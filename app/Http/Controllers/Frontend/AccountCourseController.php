<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\AccountCourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @group Account & Course
 *
 * APIs for a account course
 * @package App\Http\Controllers\Frontend
 */
class AccountCourseController extends Controller
{
    protected $service;

    public function __construct(AccountCourseService $service)
    {
        $this->service = $service;
        $this->user = JWTAuth::parseToken()->authenticate();
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     *  Test Result
     *
     * get the result by test
     * if percent < 50% 3x block account
     * first number is question order, second number is answer order
     * if answer the checkbox, then true ex: 2_3: true, or radio button then answers number ex: 1_2: 2
     *
     * @queryParam access_token token
     * @queryParam model The answers Example: {1_2: 2, 1_3: 3, 2_2: true, 2_3: true, 3_2: true, 3_3: true, 4_1: true, 4_2: true, 5_2: true}
     * @queryParam user_id The account id to filter Example: 2
     * @queryParam course_id The course id to filter by id Example: 1
     *
     *
     * @response
     * {
     * "access_token": "",
     * "percent": 42.857142857142854,
     * "token_type": "bearer",
     * "expires_in": 21600000
     * }
     */
    function getResult()
    {

        try {
            $percent = $this->service->getTestResult(request('id'), request('user_id'), request('model'));
            return response()->json([
                'access_token' => request('token'),
                'percent' => $percent,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    /**
     * Account`s Tests certificates--- for tests menu
     * get the all passed tests by account
     * if in response the tests = [] // Դուք դեռ թեստ չեք անցել
     *
     * @queryParam access_token token Example: token
     * @queryParam id The account id to filter Example: 1
     *
     * @response
     * {"access_token":"..",
     * "tests":[{"id":1,"account_id":1,"course_id":1,"percent":75,"updated_at":"2021-11-30T18:49:33.000000Z","course":{"id":1,"name":"\u053f\u0578\u057e\u056b\u0564\u056b \u054f\u0561\u0580\u0561\u056e\u0578\u0582\u0574\u0568","credit":"[{\"name\": \"theoretical\", \"credit\": \"40\"}, {\"name\": \"practical\", \"credit\": \"30\"}, {\"name\": \"selfeducation\", \"credit\": \"30\"}]"}}],"token_type":"bearer","expires_in":21600000}
     */
    function getTestsResult()
    {
        try {
            $tests = $this->service->getTestsResult(request('id'));

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

    function getPaymentById()
    {
        try {
//            if(!request('mobile')) {
            $data = $this->service->getPaymentById(request('account_id'), request('course_id'));

            return response()->json([
                'access_token' => request('token'),
                'data' => $data['paid'],
                'read' => $data['reading'],
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
//            }else{
//                $paid= $this->service->getPaymentByMobile(request('account_id'), request('course_id'));
//                return response()->json([
//                    'access_token' => request('token'),
//                    'data' => $paid,
//                    'token_type' => 'bearer',
//                    'expires_in' => auth('api')->factory()->getTTL() * 60
//                ]);
//            }
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    function getCPCourse()
    {
        try {
            $pass = false;
            $info = $this->service->getCountOfTest(request('id'), request('user_id'));
            if ($info->percent >= config('constants.COUNT_OF_TEST'))
                $pass = true;
            return response()->json([
                'access_token' => request('token'),
                'info' => json_encode($info),
                'token_type' => 'bearer',
                'pass' => $pass,
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
     * important for mobile --- send account_id, course_id, token, mobile=true
     * @queryParam ClientID The client ID Example:
     * @queryParam Username The username Example: username
     * @queryParam Password The password Example: password
     * @queryParam Currency The currency  to filter Example:AMD
     * @queryParam Description The description Example: SHMZ
     * @queryParam Amount The amount Example:10
     * @queryParam OrderID The Order ID to filter Example: AMD
     * @queryParam BackURL The back url Example: https://www.shmz.am/lesson
     * @queryParam Opaque The opaque Example:  Opaque VPOS
     * @queryParam CardHolderID The card holder ID url Example:  CARD VPOS
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
            $info = $this->service->getCourseById(request('course_id'));
            $data = [];
            $data['ClientID'] = env('CLIENT_ID');
            $data['Amount'] = $info->cost;
            $data['OrderID'] = rand(1, 2000000000);//2milliard
            $data["BackURL"] = env('BACK_URL') . request('course_id');
            $data['Username'] = env('PAY_USERNAME');
            $data['Password'] = env('PAY_PASSWORD');
            $data['Description'] = mb_convert_encoding($info->name, 'UTF-8');
            $data['Cardholder'] = 'CARD VPOS';
            $data['Currency'] = 'AMD';
            $data['Opaque'] = 'Opaque VPOS';
//
            $endpoint = "https://services.ameriabank.am/VPOS/api/VPOS/InitPayment";
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST',
                $endpoint, ['form_params' => $data]);
            $statusCode = $response->getStatusCode();

            $content = json_decode($response->getBody(), true);
            return response()->json([
                'access_token' => request('token'),
                'payment' => $content,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException $exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    function paymentIdram()
    {
        try {
            $info = $this->service->getCourseById(request('course_id'));

            $action = env('ACTION');
            $d = 'EDP_LANGUAGE=' . 'am'
                . '&EDP_AMOUNT=' . '10'
                . '&EDP_REC_ACCOUNT=' . env('EDP_REC_ACCOUNT')
                . '&EDP_BILL_NO=' . rand(1, 2000000000)
                . '&EDP_DESCRIPTION=' . mb_convert_encoding($info->name, 'UTF-8')
                . 'SECRET_KEY=' . env('SECRET_KEY');
            $server_output = $this->post_curl_request($action, $d, "IDRAM");

            preg_match_all('~<a(.*?)href="([^"]+)"(.*?)>~', $server_output, $matches);
            $redirect_uri = env('REDIRECT_URI');
            $result_uai = str_replace("&amp;", "&", $matches[2][0]);
            $redirect_uri .= $result_uai;
            return response()->json([
                'access_token' => request('token'),
                'url' => $redirect_uri,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException $exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    function getPayment()
    {
        $data['Username'] = env('PAY_USERNAME');
        $data['Password'] = env('PAY_PASSWORD');
        $data['PaymentID'] = request('PaymentID');

        $endpoint = "https://services.ameriabank.am/VPOS/api/VPOS/GetPaymentDetails";
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST',
            $endpoint, ['form_params' => $data]);
        $statusCode = $response->getStatusCode();

//        $content = $response->getBody();
        $content = json_decode($response->getBody(), true);

        $msg = __('messages.payment_success');
        if ($content['ResponseCode'] == "00") {
            $upload_data = [];
            $upload_data['PaymentID'] = $data['PaymentID'];
            $upload_data['ClientName'] = $content['ClientName'];
            $upload_data['DateTime'] = $content['DateTime'];
            $upload_data['OrderID'] = $content['OrderID'];
            $upload_data['Amount'] = $content['Amount'];

            $this->service->uploadPayment(request('course_id'), request('account_id'), $upload_data);
        } else {
            $msg = $this->getResponseCode($content['ResponseCode']);
        }
        return response()->json([
            'access_token' => request('token'),
            'getpayment' => $content,
            'msg' => $msg,
            'code' => $content['ResponseCode'],
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    function getPaymentIdram()
    {

        $ir = Session::get('idram_request');
        $msg = __('messages.payment_success');
        $code ="00";

        if (!empty($ir)) {
            if (request('EDP_BILL_NO') == $ir['EDP_BILL_NO']) {
                $upload_data = [];
                $upload_data['PaymentID'] = $ir['EDP_BILL_NO'];
//            $upload_data['ClientName'] = $content['ClientName'];
                $upload_data['DateTime'] = $ir['EDP_BILL_DATE'];
                $upload_data['OrderID'] = $ir['EDP_PAYER_ACCOUNT'];
                $upload_data['Amount'] = $ir['EDP_AMOUNT'];

                $this->service->uploadPayment(request('course_id'), request('account_id'), $upload_data);
            } else {
                $msg = $this->getResponseCode('');
                $code = "";
            }
        } else {
            $msg = $this->getResponseCode('');
        }
        return response()->json([
            'access_token' => request('token'),
            'getpayment' => \GuzzleHttp\json_encode($ir),
            'msg' => $msg,
            'code' => $code,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }


    /**
     * Certificate
     * get certificate by test id
     *
     * @queryParam access_token token Example: token
     * @queryParam id The test id to filter Example: 1
     * @queryParam user_id The account id to filter Example: 2
     *
     * @response
     *{
     * "data": "img name.png",
     * "token_type": "bearer"
     * }
     */
    public
    function certificate(Request $request)
    {
        $text_send = $this->service->getCertificate($request->id, $request->user_id);
        return response()->json([
            'data' => $text_send . ".png",
            'access_token' => request('token'),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }


    public
    function readingBook(Request $request)
    {
        $read = $this->service->readingBook($request);
        return response()->json([
            'page' => $request->page,
            'access_token' => request('token'),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public
    function getPage(Request $request)
    {
        $page = $this->service->getPage($request);
        return response()->json([
            'page' => $page->page,
            'access_token' => request('token'),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public
    function getResponseCode($code)
    {
        $msg = "";
        switch ($code) {
            case "0-1":
                $msg = __('messages.sv_unavailable');
                break;
            case "0116":
                $msg = __('messages.enough_money');
                break;
            case "0-2001":
                $msg = __('messages.IP_blacklisted');
                break;
            case "0-2002":
                $msg = __('messages.payment_over_limit');
                break;
            case "0-20010":
                $msg = __('messages.BLOCKED_BY_LIMIT');
                break;
            case "0-2003":
                $msg = __('messages.restricted');
                break;
            case "0-2006":
                $msg = __('messages.3DSecdecline');
                break;
            case "0-2007":
                $msg = __('messages.payment_time_limit');
                break;
            case "0-2012":
                $msg = __('messages.not_supported');
                break;
            case "0-2013":
                $msg = __('messages.payment_attempts');
                break;

            default:
                $msg = __('messages.payment_field');
        }
        return $msg;
    }

    public function post_curl_request($action, $el, $r_u)
    {
        $redirect_uri = "";
        $ch = curl_init();
        if ($el == "IDRAM") {
            $headers = array();
            $headers[] = "Accept: application/json";
            $headers[] = "Content-Type: application/x-www-form-urlencoded";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_URL, $action);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            $el);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }
}
