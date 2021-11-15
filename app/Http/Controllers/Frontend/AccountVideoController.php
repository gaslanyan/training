<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountVideoRequest;
use App\Services\AccountVideoService;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @group Account & Course
 *
 * APIs for a account course
 * @package App\Http\Controllers\Frontend
 */
class AccountVideoController extends Controller
{
    protected $service;

    public function __construct(AccountVideoService $service)
    {
        $this->service = $service;
        $this->user = JWTAuth::parseToken()->authenticate();
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function getVideoById()
    {
        try {

            $video = $this->service->getVideoById(request('id'),request('account_id') );
            $v = false;
            if (!$video->isEmpty())
                $v = $video[0];

            return response()->json([
                'access_token' => request('token'),
                'video' => $v,
//                'token_type' => 'bearer',
//                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    /**
     * Add Video Point
     *
     * get the result by test
     *
     *
     * @queryParam access_token token
     * @queryParam point Get the video point by the user Example: 7.199989
     * @queryParam user_id The account id to filter Example: 2
     * @queryParam id The video id to filter by id Example: 3
     *
     *
     * @response
     * {
     * "access_token": "",
     * "video": false
     * }
     */
    public function addPointById(AccountVideoRequest $request)
    {
        try {

            $video = $this->service->addPointById($request);
            $v = false;
            if (!empty($video))
                $v = $video[0];
            return response()->json([
                'access_token' => request('token'),
                'video' => $v,
//                'token_type' => 'bearer',
//                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }
}
