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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login')->name("login");
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });

});

Route::group(["prefix" => 'members'], function() {
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/', 'Api\MemberController@index')->name('products.index');
        Route::post('/', 'Api\MemberController@store')->name('products.store');
        Route::get('/{member}', 'Api\MemberController@show')->name('products.show');
        Route::put('/{member}', 'Api\MemberController@update')->name('products.update');
        Route::delete('/{member}', 'Api\MemberController@destroy')->name('products.destroy');
    });
});

Route::group(["prefix" => 'walking-classes'], function() {
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/', 'Api\WalkingClassController@index');
        Route::post('/', 'Api\WalkingClassController@store');
        Route::get('/{walkingClass}', 'Api\WalkingClassController@show');
        Route::put('/{walkingClass}', 'Api\WalkingClassController@update');
        Route::delete('/{walkingClass}', 'Api\WalkingClassController@destroy');
    });
});

Route::group(["prefix" => 'yogaClasses'], function() {
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/', 'Api\YogaClassController@index');
        Route::post('/', 'Api\YogaClassController@store');
        Route::get('/{yogaClass}', 'Api\YogaClassController@show');
        Route::put('/{yogaClass}', 'Api\YogaClassController@update');
        Route::delete('/{yogaClass}', 'Api\YogaClassController@destroy');
    });
});
