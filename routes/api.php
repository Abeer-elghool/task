<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', 'User\AuthController@register');
Route::post('login', 'User\AuthController@login');

Route::middleware(['auth:api'])->group(function () {
    Route::get('my_posts', 'Post\PostController@my_posts');
    Route::resource('posts', 'Post\PostController')->except('show');
});
