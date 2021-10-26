<?php


namespace LoanHistory\Modules\Auth\Api\v1\Controllers;


use Illuminate\Http\Request;
use LoanHistory\Modules\Auth\Api\v1\Repositories\AuthRepository;
use LoanHistory\Modules\BaseController;

class AuthController extends BaseController
{

    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request){

        $this->validate($request, [
            "email"=>"required|email",
            "password"=>"required"
        ]);

        $credentials = $request->only('email','password');

        $response = $this->authRepository->login($credentials);

        if (!isset($response['status_code'])){
            return $this->success($response);
        }

        return $this->handleErrorResponse($response);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
        ]);

        $data = [
            'old_password' => $request->input('old_password'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation')
        ];

        return $this->authRepository->changePassword($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){

        auth()->logout();

        return response()->json(["User successful logout",200]);
    }



}
