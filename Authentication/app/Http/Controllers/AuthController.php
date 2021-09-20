<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Utils;

class AuthController extends Controller
{
    public function auth()
    {
        return view('auth');
    }



    public function register(Request $request)
    {
        $this->validate($request,[
           "name"=>"required",
           "email"=>"required",
           "password"=>"required"
        ]);
       $user = new User();

       $user->name = $request->input('name');
       $user->email = $request->input('email');
       $user->password = $request->input('password');
       $user->save();

       return redirect(route('list'))->with('success', 'User Has Been Added Successfully.');

    }


    

    public function login(Request $request)
    {
       $this->validate($request, [
           "email"=>"required",
           "password"=>"required"
       ]);

       $credentials = $request->only(["email","password"]);

       if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
           // Authentication passed...
           return redirect()->route('list');
       }

    }

    public function logout(){

        auth()->logout();

        return redirect(route('home'))->with('success', 'User logout Successfully.');
    }


}
