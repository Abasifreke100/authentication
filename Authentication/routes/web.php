<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'auth'])->name('home');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// DASHBOARD
//Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// TODO
Route::post('/post', [TodoController::class,'post'])->name('post');
Route::get('/list', [TodoController::class,'list'])->name('list');;

