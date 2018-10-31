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
//TODO: Controller middlewarw api: sonra
//todo: query index (tripcontroller index)
//todo: formrequest validator custom message (example triprequest)
//todo: tema tabuu (bootstrap4)
//todo: formatted address lat long placeid table_name table(faker)
//todo: to from string->number(trip luggage faker) model realation koshulat model(relation)(azat)
//todo: address table with ui autocompleate(azat)
//todo: list item ui(azat+ayzat)
//todo: colection katalar check toute name (php artisan routes:list)
Route::group([
    'middleware' => 'api',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');
//    routes

});
Route::apiresource('/trips', 'TripsController');
Route::resource('/offers', 'OfferController');
Route::resource('/luggages', 'LuggageController');
Route::delete('luggages/{luggage}', 'LuggageController@destroy');

Route::resource('/ratings', 'RatingController');
