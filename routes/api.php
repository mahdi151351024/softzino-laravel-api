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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

Route::prefix('v1')->group(function(){

    // front
    Route::post('/register', 'Api\AuthController@register')->name('auth.register');
    Route::post('/login', 'Api\AuthController@login')->name('auth.login');
    Route::get('/login', function(){
        return response()->json(['status'=>false, 'message'=> 'Unauthorized access']);
    })->name('login');

    Route::middleware('auth:api')->group(function(){

        // user
        Route::post('/logout', 'Api\AuthController@logout')->name('auth.logout');
        Route::post('/create-user', 'Api\UserController@create')->name('user.create');
        Route::post('/edit-user', 'Api\UserController@edit')->name('user.edit');
        Route::get('/delete-user/{id}', 'Api\UserController@delete')->name('user.delete');
        Route::get('/get-user-by-id/{id}', 'Api\UserController@getUserById')->name('user.get');
        Route::get('/all-users', 'Api\UserController@getAllUsers')->name('user.all');

    });

});

