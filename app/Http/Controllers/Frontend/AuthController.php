<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\Registration;
use App\Models\Account;
use Illuminate\Http\Request;


/**
 * Class AuthController
 * @package App\Http\Controllers\Frontend
 */
class AuthController extends Controller
{

    use Registration;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    /**
     * The account registration
     *
     * @queryParam name The account name.  Example: "name"
     * @queryParam surname The account surname.  Example: "surname"
     * @queryParam father_name The account father_name.  Example: "father_name"
     * @queryParam date_of_expiry The date of expiry.  Example: "2022-06-13"
     * @queryParam date_of_issue The date of issue Example: "2020-06-02"
     * @queryParam diplomas The rest after removing.  Example: "["OfU5qs_2.jpeg"]"
     * @queryParam j_diplomas The passport field /all img from db.  Example: "OfU5qs_2.jpeg,3NqMqY_2.jpeg"
     * @queryParam diploma_1 The new upload file.  Example: "(binary)"
     * @queryParam passport The passport field.  Example: "AN0771747"
     * @queryParam re_passport The confirm passport field.  Example: "AN0771747"
     * @queryParam member_of_palace The member of palace 0 or 1.  Example: "0"
     * @queryParam bday The bday Example: "1978-09-13",
     * @queryParam email The account email Example: "g_aslanyan@mail.ru",
     * @queryParam phone The account phone Example: "93610174",
     * @queryParam h_region The home region id Example: "3",
     * @queryParam h_street The home street name Example: "հիմնական 7",
     * @queryParam h_territory The home territory id Example: "145",
     * @queryParam w_region The work region id Example: "3",
     * @queryParam w_street The work street name "հիմնական 7",
     * @queryParam w_territory The work territory id "145",
     * @queryParam workplace_name The work place name "պոլիկնիկա",
     * @queryParam specialty_id Կրթությունը  "30",
     * @queryParam education_id Մասնագիտացումը "7",
     * @queryParam profession Մասնագիտական խումբը "3",
     *
     * @response
     *{
     * "success": "pending",
     * "user": "2"
     * }
     */
    public function register(Request $request)
    {
        dd($request);
        return Registration::register($accountRequest, $professionRequest, $userRequest, 'user', 'pending');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $unverified = request(['email', 'password']);
        $credentials = request(['email', 'password']);
        $credentials['status'] = 'approved';
        try {
//          dd(JWTAuth::attempt($credentials));
            if (!$token = auth('api')->attempt($unverified)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unverified'], 400);
            }
            return $this->respondWithTokenById($token);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 500);
        }

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        var_dump(response()->json(auth('api')->user()));
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithTokenById(auth('api')->refresh());
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
            ])->where('id', $user->account_id)
            ->first();

        return response()->json([
            'access_token' => $token,
            'user' => $account,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithTokenById($token)
    {
        $user = $this->guard()->user();

        $account = Account::select('id')
            ->with(['prof' => function ($query) {
                $query->select('member_of_palace', 'account_id');
            }])
            ->where('id', $user->account_id)
            ->first();

        return response()->json([
            'access_token' => $token,
            'user' => $account,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 6000
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
