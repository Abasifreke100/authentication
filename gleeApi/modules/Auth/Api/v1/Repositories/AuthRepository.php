<?php

namespace Glee\Modules\Auth\Api\v1\Repositories;

use Glee\Modules\Auth\Models\User;
use Glee\Modules\BaseRepository;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthRepository extends BaseRepository
{
    private $jwtAuth;

    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

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
}
