<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Open route
    Route::post('/register', [AuthController::class,'register']);
    Route::post('/login', [AuthController::class,'login']);

Route::group(['middleware' => 'auth:api'], function() {

    // Auth
    Route::post('/logout', [AuthController::class,'logout']);

    // Post
    Route::post('/create', [PostController::class,'create']);
    Route::get('/index', [PostController::class,'index']);
    Route::get('/show/{id}', [PostController::class,'show']);
});





