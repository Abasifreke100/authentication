<?php

namespace Glee\Modules\Auth\Api\v1\Controllers;

use Glee\Modules\Auth\Api\v1\Repositories\AuthRepository;
use Glee\Modules\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');
        $response = $this->authRepository->login($credentials);

        if (!isset($response['status_code'])) {
            return $this->success($response);
        }
        return $this->handleErrorResponse($response);
    }


    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }



    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }

}
