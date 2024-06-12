<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name' => $request->name,
        ];

        $user = User::create($data);

        $data = User::firstWhere('id', $user->id);
        $token = $data->createToken('passportToken')->accessToken;

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
        $token = $data->createToken('passportToken')->accessToken;

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

        $accessToken = Auth::user()->token();

        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
