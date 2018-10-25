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
//todo: JSONresource , rename
//todo: Colleaction+paginate, +controller
//todo: comment,
//todo: create read update delete(owner controll)=>inside controller.
// put-manual
// patch update field by
// get-list show
// Post-new
// delete-remove
//todo:prrotected fillable
//TODO:Resource(single) without data ResourceCollection(plural) to array ex=>offers relation type id data
//TODO: Controller middlewarw api:
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
Route::resource('/ratings', 'RatingController');
