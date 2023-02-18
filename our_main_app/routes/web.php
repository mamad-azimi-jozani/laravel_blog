<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// user related route
Route::get('/', [UserController::class, 'show_correct_home_page'])
    ->name('login');

Route::post('/register', [UserController::class, 'register'])
    ->middleware('guest');

Route::post('/login', [UserController::class, 'login'])
    ->middleware('guest');

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/logout', [UserController::class, 'logout'])
    ->middleware('auth');

// blog related route
Route::get('/create-post', [PostController::class, 'show_create_form'])
    ->middleware('must_be_logged_in');

Route::post('/create-post', [PostController::class, 'show_new_post'])
    ->middleware('must_be_logged_in');

Route::get('/post/{post}', [PostController::class, 'view_single_post']);

// profile
Route::get('/profile/{user:username}', [UserController::class, 'profile']);
