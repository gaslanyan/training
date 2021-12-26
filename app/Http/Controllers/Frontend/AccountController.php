<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountApproveRequest;
use App\Http\Requests\AccountEditRequest;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfessionApproveRequest;
use App\Http\Requests\ProfessionEditRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Account;
use App\Models\User;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

/**
 * @group Account Profile
 *
 * APIs for a account profile
 * @package App\Http\Controllers\Frontend
 */
class AccountController extends Controller
{

    /**
     * @var AccountService
     */
    protected $service;


    /**
     * Create a new AccountController instance.
     * AccountController constructor.
     * @param AccountService $service
     */
    public function __construct(AccountService $service)
    {
        $this->service = $service;
//        $this->user = JWTAuth::parseToken()->authenticate();
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function getAccountById()
    {
        $account = $this->service->getFAccountById(request('id'));
        return response()->json([
            'access_token' => request('token'),
            'account' => $account,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * (int)__('messages.expires_in')
        ]);
    }

    public function getStatus()
    {
        $status = $this->service->getStatus(request('id'));
        return response()->json([
            'access_token' => request('token'),
            'status' => $status,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * (int)__('messages.expires_in')
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVideoById(Request $request, $id)
    {
        $video = $this->service->getVideoById($id);
        return response()->json([
            'access_token' => $request->token,
            'video' => $video,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * (int)__('messages.expires_in')
        ]);
    }


    /**
     * Change avatar
     *
     * change avatar by account id
     *
     * @queryParam access_token token
     * @queryParam avatar the image  Example: "(binary)"
     * @queryParam _method Example: PUT
     *
     *
     * @response
     * {
     * "token": ""
     * }
     */
    public function avatar(AvatarRequest $request)
    {

//todo test

        $result = $this->service->updateFAvatar($request);
        if ($result)
            return $this->respondWithToken($request->token);
        return response()->json(['error' => true], 500);

    }

    /**
     * Edit Account profile
     *
     * edit profile by account id
     *
     * @queryParam access_token token
     * @queryParam phone The account phone number Example: "93656565"
     * @queryParam bday The account bday  Example: "2022-06-13"
     * @queryParam workplace_name The workplace name Example: "name"
     * @queryParam h_region The home region id Example: "2"
     * @queryParam w_region The work region id Example: "2"
     * @queryParam h_territory The home territory id Example: "2"
     * @queryParam w_territory The work territory id  Example: "2"
     * @queryParam w_street The work street name Example: "name"
     * @queryParam h_street The home street name  Example: "name"
     * @queryParam profession The member of palace 0 or 1  Example: "0"
     * @queryParam specialty_id The specialty id  Example: "30"
     * @queryParam education_id The education id  Example: "3"
     * @queryParam info The info description  Example: ""
     * @queryParam _method Example: PUT
     *
     *
     * @response
     *{
     * "success": "true",
     * "user": "2"
     * }
     */

    public function updateProfile(AccountEditRequest $accountRequest,
                                  ProfessionEditRequest $professionRequest,
                                  UserEditRequest $userRequest, $id)
    {

        $code = $this->service->updateFProfile($accountRequest, $professionRequest, $userRequest, $id);

        if (is_numeric($code))
            return response()->json(['error' => true, 'message' => getErrorMessage($code)], 500);
        else {
            return response()->json(['success' => true, 'user' => $id, 200]);
        }
    }

    /**
     * Edit Account profile and approve by admin
     * multipart/form-data
     * edit profile by account id
     *
     * @queryParam access_token token
     * @queryParam name The account name  Example: "name"
     * @queryParam surname The account surname  Example: "surname"
     * @queryParam father_name The account father_name  Example: "father_name"
     * @queryParam date_of_expiry The date of expiry  Example: "2022-06-13"
     * @queryParam date_of_issue The date of issue Example: "2020-06-02"
     * @queryParam diplomas The rest after removing  Example: "["OfU5qs_2.jpeg"]"
     * @queryParam j_diplomas The passport field /all img from db  Example: "OfU5qs_2.jpeg,3NqMqY_2.jpeg"
     * @queryParam diploma_1 The new upload file  Example: "(binary)"
     * @queryParam passport The passport field  Example: "AN0771747"
     * @queryParam member_of_palace The member of palace 0 or 1  Example: "0"
     * @queryParam _method Example: PUT
     *
     *
     * @response
     *{
     * "success": "pending",
     * "user": "2"
     * }
     */

    public function editApprove(AccountApproveRequest $accountRequest,
                                ProfessionApproveRequest $professionRequest, $id)
    {

        try {
            $this->service->updateFAccount($accountRequest, $professionRequest, $id);
            return response()->json(['success' => 'pending', 'user' => $id], 200);
        } catch (\Exception $exception) {
            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }


    /**
     * Change password
     *
     * change password by account id
     *
     * @queryParam access_token token
     * @queryParam old_password Example: "111111111"
     * @queryParam password Example: "6666666"
     * @queryParam re-password Example: "6666666"
     * @queryParam _method Example: PUT
     *
     *
     * @response
     * {
     * "success": "true",
     * "user_id": "2"
     * }
     */
    public function changePassword(PasswordRequest $request, $id)
    {

        try {
            $user = User::where('account_id', $id)->first();
            if (!Hash::check($request->old_password, $user->password)) {

                return response()->json(['error' => false, 'user' => $id], 401);
            } else {
                $this->service->updatePassword($request, $id);

                return response()->json([
                    'success' => true,
                    'user' => $id,
                ]);
            }
//
        } catch (MethodNotAllowedHttpException $exception) {
            logger()->error($exception);
            return response()->json(['success' => false, 'user' => $id], 500);
        }
    }

    /**
     * Profile by account id
     * get the profile by id
     *
     * @response
     * {
     * "access_token": null,
     * "user": {
     * "id": 2,
     * "name": "name",
     * "surname": "surname",
     * "father_name": "father_name",
     * "image_name": "avatar_2.png",
     * "bday": "1978-09-13",
     * "email": "g_aslanyan@mail.ru",
     * "phone": "93610174",
     * "home_address": "{\"h_region\": \"7\", \"h_street\": \"վերդի 7/8\", \"h_territory\": \"523\"}",
     * "work_address": "{\"w_region\": \"3\", \"w_street\": \"հիմնական 7\", \"w_territory\": \"145\"}",
     * "workplace_name": "պոլիկնիկա",
     * "specialty_id": 30,
     * "education_id": 7,
     * "profession": 3,
     * "info": "Wfwf"
     * },
     * "app": {
     * "id": 2,
     * "name": "name",
     * "surname": "surname",
     * "father_name": "father_name",
     * "date_of_expiry": "2022-06-13",
     * "passport": "AN0771747",
     * "date_of_issue": "2020-06-02",
     * "prof": {
     * "specialty_id": 30,
     * "member_of_palace": 0,
     * "diplomas": "[\"OfU5qs_2.jpeg\", \"3NqMqY_2.jpeg\"]",
     * "account_id": 2
     * }
     * },
     * "token_type": "bearer",
     * "expires_in": 0
     * }
     * */
    public function editProfile(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $profile = $this->service->getFAccountById($id);
        $approve = $this->service->getFAccount($id);
        return response()->json([
            'access_token' => $request->token,
            'user' => $profile,
            'app' => $approve,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * (int)__('messages.expires_in')
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = $this->guard()->user();
        $account = Account::select(['id', 'name', 'surname', 'father_name', 'image_name'])
            ->with([
                'user' => function ($query) {
                    $query->select(['account_id', 'email']);
                },
                'prof' => function ($query) {
                    $query->select(['account_id', 'member_of_palace']);
                }
            ])->where('id', $user->account_id)->first();

        return response()->json([
            'access_token' => $token,
            'user' => $account,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * (int)__('messages.expires_in')
        ]);
    }


    /**
     * @return mixed
     */
    public function guard()
    {
        return \Auth::Guard('api');
    }
}
