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
//todo: JSONresource ,
//todo: Colleaction+paginate,
//todo: foldering,
//todo: comment,
//todo: create read update delete(owner controll)=>inside controller.
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
Route::get('/offers', 'OffersController@index');
Route::get('/offer/{id}', 'OffersController@show');

Route::get('/luggages', 'LuggagesController@index');
Route::get('/luggage/{id}', 'LuggagesController@show');

Route::get('/ratings', 'RatingsController@index');
Route::get('/rating/{id}', 'RatingsController@show');

Route::resource('/trips', 'TripController');