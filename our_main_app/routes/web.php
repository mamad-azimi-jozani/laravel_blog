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

// admin
Route::get('/admins-only', function (){
    return "only admin should be able to see this page";
})->middleware('can:admin_visit_pages');


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

Route::get('/manage-avatar', [UserController::class, 'show_avatar']);
Route::post('/manage-avatar', [UserController::class, 'store_avatar']);



// blog related route
Route::get('/create-post', [PostController::class, 'show_create_form'])
    ->middleware('must_be_logged_in');

Route::post('/create-post', [PostController::class, 'show_new_post'])
    ->middleware('must_be_logged_in');

Route::get('/post/{post}', [PostController::class, 'view_single_post']);

Route::delete('/post/{post}', [PostController::class, 'delete'])
    ->middleware('can:delete, post');

Route::get('/post/{post}/edit', [PostController::class, 'show_edit_form'])->middleware('can:update,post');
Route::put('/post/{post}', [PostController::class, 'update_post'])->middleware('can:update,post');



// profile
Route::get('/profile/{user:username}', [UserController::class, 'profile']);




