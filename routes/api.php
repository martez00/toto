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

Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::delete('user/{id}', 'UserController@destroy')->middleware('isAdmin');
    Route::post('user/{id}', 'UserController@update')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
    Route::delete('post/{id}', 'PostController@destroy')->middleware('isAdmin');
    Route::post('posts', 'PostController@store')->middleware('isAdmin');
    Route::post('teams', 'TeamController@store')->middleware('isAdmin');
    Route::delete('team/{id}', 'TeamController@destroy')->middleware('isAdmin');
});
Route::get('posts', 'PostController@index');
Route::get('teams', 'TeamController@index');
Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get('auth/user', 'AuthController@user');
    Route::post('auth/logout', 'AuthController@logout');
});
Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('auth/refresh', 'AuthController@refresh');
});