<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('sign-up', 'UserController@create');
Route::post('sign-in', 'UserController@login');
Route::post('forgot-password', 'UserController@forgotPassword');
Route::post('recover-password', 'UserController@recoverPassword');

Route::middleware('jwt.auth')->group(function () {
    Route::get('me', 'UserController@me');
    Route::post('logout', 'UserController@logout');
    Route::post('refresh', 'UserController@refresh');

    Route::apiResource('user', 'UserController');
});