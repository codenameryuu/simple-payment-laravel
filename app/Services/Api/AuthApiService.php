<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Helpers\MessageHelper;

use App\Models\User;

class AuthApiService
{
    /**
     ** Register service.
     *
     * @param $request
     * @return ArrayObject
     */
    public function register($request)
    {
        $status = true;
        $message = MessageHelper::registerationSuccess();

        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::create($data);

        $data = User::firstWhere('id', $user->id);

        $credentials = request(['email', 'password']);
        $token = auth()->guard('api')->attempt($credentials);

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'token' => $token,
        ];

        return $result;
    }

    /**
     ** Login service.
     *
     * @param $request
     * @return ArrayObject
     */
    public function login($request)
    {
        $status = true;
        $message = MessageHelper::loginSuccess();

        $data = User::firstWhere('email', $request->email);

        $credentials = request(['email', 'password']);
        $token = auth()->guard('api')->attempt($credentials);

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'token' => $token,
        ];

        return $result;
    }

    /**
     ** Logout service.
     *
     * @param $request
     * @return ArrayObject
     */
    public function logout($request)
    {
        $status = true;
        $message = MessageHelper::logoutSuccess();

        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
