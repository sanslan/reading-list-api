<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('books','BooksController')->except(['create','edit'])->middleware('auth:api');
Route::post('logout','AuthController@logout')->middleware('auth:api');

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');