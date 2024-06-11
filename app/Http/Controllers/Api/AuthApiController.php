<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Validations\Api\AuthApiValidation;
use App\Services\Api\AuthApiService;

class AuthApiController extends Controller
{
    /**
     ** Validation instance.
     *
     * @var \App\Validations\Api\AuthApiValidation
     */
    protected $authApiValidation;

    /**
     ** Service instance.
     *
     * @var \App\Services\Api\AuthApiService
     */
    protected $authApiService;

    /**
     ** Create a new instance.
     *
     * @return void
     */
    public function __construct(AuthApiValidation $authApiValidation, AuthApiService $authApiService)
    {
        $this->authApiValidation = $authApiValidation;
        $this->authApiService = $authApiService;
    }

    /**
     ** Register.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validation = $this->authApiValidation->register($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->authApiService->register($request);

        return $this->formatResponse($result);
    }

    /**
     ** Login.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validation = $this->authApiValidation->login($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->authApiService->login($request);

        return $this->formatResponse($result);
    }

    /**
     ** Logout.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $validation = $this->authApiValidation->logout($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->authApiService->logout($request);

        return $this->formatResponse($result);
    }
}
