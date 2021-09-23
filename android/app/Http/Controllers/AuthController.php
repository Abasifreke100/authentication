<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;
class AuthController extends Controller
{

    private $jwtAuth;

    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }


    /**
     * Registration
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'bail|required',
            'email' => 'bail|required|email:filter,rfc|unique:users',
            'password' => 'bail|required|min:6',
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $user = User::create($input);

        return response()->json($user);
    }

    /**
     * @throws AuthenticationException
     */
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'bail|required|email:filter,rfc',
            'password' => 'bail|required|min:6'
        ]);

        $token = $this->jwtAuth->attempt(['email' => $request->email, 'password' => $request->password]);

        if (!$token){
            throw new AuthenticationException('Your credentials does not match our record.');
        }

        $user = User::where("email", $request['email'])->first();

        return [
            "user" => $user,
            "token" => $token
        ];
    }

    public function logout(){
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'data' => 'user successfully logout!!'
        ]);
    }
}
