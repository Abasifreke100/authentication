<?php


namespace LoanHistory\Modules\Auth\Api\v1\Repositories;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use LoanHistory\Modules\Auth\Models\User;
use LoanHistory\Modules\BaseRepository;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthRepository extends BaseRepository
{
    protected $jwtAuth;

    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    /**
     * @param $credentials
     */
    public function login($credentials){

        try {

            $token = $this->jwtAuth->attempt($credentials);

            if (!$token){
                return $this->failResponse("Invalid Email or Password",422);
            }

        }catch (JWTException $exception){
            return $this->failResponse("Cannot generate access token",401);
        }

        $user = User::where("email", $credentials['email'])->first();

        return [
            "user" => $user,
            "token" => $token
        ];
    }

    public function changePassword($request){

        if (!(Hash::check($request['old_password'], Auth::user()->password))) {
            return response()->json(['message' => 'Current password is Wrong !!'], 422);
        }

        if(strcmp($request['old_password'], $request['password']) == 0){
            return response()->json(['message' => 'New Password cannot be same as your current password. Please choose a different password.'], 422);
        }

        $user = Auth::user();

        $user->password = bcrypt($request['password']);
        $user->save();

        return response()->json(['message' => 'Password updated successfully !!'], 200);


    }


}
