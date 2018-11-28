<?php

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
    'middleware' => 'api',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::get('my-info', 'AuthController@info');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');

    Route::apiresource('/trips', 'TripsController');
    Route::resource('/offers', 'OfferController');
    Route::resource('/luggages', 'LuggageController');
    Route::delete('luggages/{luggage}', 'LuggageController@destroy');
    Route::resource('/users', 'UserController');
    Route::resource('/ratings', 'RatingController');
    Route::patch('offers-accept/{id}', 'OfferController@accept');
});
