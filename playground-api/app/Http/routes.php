<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {
	
    Route::get('token', 'ApiController@getToken');

    Route::post('auth/login','ApiController@login');

    Route::post('auth/logout', function () {
        if (Auth::logout()) {
            return 'Bye :)';
        }
    });

    Route::post('me', ['middleware' => 'auth', function() {
        return response()->json(['message' => Auth::user()->email]);
    }]);
});