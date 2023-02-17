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
Route::get('/', [UserController::class, 'show_correct_home_page']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/', [UserController::class, 'logout']);

// blog related route
Route::get('/create-post', [PostController::class, 'show_create_form']);
Route::post('/create-post', [PostController::class, 'show_new_post']);

Route::get('/post/{post}', [PostController::class, 'view_single_post']);

