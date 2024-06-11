<?php

namespace App\Validations\Api;

use App\Helpers\MessageHelper;

class AuthApiValidation
{
    /**
     ** Register validation.
     *
     * @param $request
     * @return ArrayObject
     */
    public function register($request)
    {
        $status = true;
        $message = MessageHelper::validationSuccess();

        $validate = [
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required'],
        ];

        $errorMessage = [
            'email.required' => 'Email tidak boleh kosong !',
            'email.unique' => 'Email sudah digunakan !',

            'password.required' => 'Password tidak boleh kosong !',
            'password.confirmed' => 'Password tidak sama dengan konfirmasi password !',

            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong !',
        ];

        $request->validate($validate, $errorMessage);

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     ** Login validation.
     *
     * @param $request
     * @return ArrayObject
     */
    public function login($request)
    {
        $status = true;
        $message = MessageHelper::validationSuccess();

        $validate = [
            'email' => ['required', 'exists:users,email'],
            'password' => ['required'],
        ];

        $errorMessage = [
            'email.required' => 'Email tidak boleh kosong !',
            'email.exists' => 'Email tidak ditemukan !',

            'password.required' => 'Password tidak boleh kosong !',
        ];

        $request->validate($validate, $errorMessage);

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     ** Logout validation.
     *
     * @param $request
     * @return ArrayObject
     */
    public function logout($request)
    {
        $status = true;
        $message = MessageHelper::validationSuccess();

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
