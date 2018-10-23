<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/trips', function () {
//    $trips = \App\Trip::all();
//    return view('trips',[
//        'trips' => $trips
//    ]);
//});
//
//Route::get('/trips/{id}', function ($id) {
//    return "This is trip ".$id;
//});

Route::get('/offers', 'OffersController@index');

Route::get('/luggages', 'LuggagesController@index');

Route::get('/ratings', 'OffersController@index');

Route::get('/trips', 'LuggagesController@index');

