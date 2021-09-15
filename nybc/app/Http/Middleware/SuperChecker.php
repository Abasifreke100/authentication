<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;

class SuperChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        $admin = Role::where("name","Super Admin")->first();

        if(!$user)
            return response()->json(["status"=>"error", "message"=>"Unauthenticated"],401);


        if($user->role_id != $admin->id){
            return response()->json(["status"=>"error", "message"=>"User is a super admin"],401);
        }

        return $next($request);

    }
}
