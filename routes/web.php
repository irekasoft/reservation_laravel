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

Auth::routes();



Route::get('/', function () {
    return view('welcome');
});


Route::resource('places', 'PlacesController');
Route::resource('facilities', 'FacilitiesController');
Route::get('facilities/create/{place_id}', 'FacilitiesController@create');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'ReservationsController@search');

Route::get('/checkReservation', 'ReservationsController@checkReservation');

Route::get('/reservations','ReservationsController@index');
Route::get('/reservation/{facility_id}','ReservationsController@reservationDetail');
Route::post('/reservation/confirmReservation','ReservationsController@confirmReservation');

Route::get('/vue',function (){

  return view('vue');

});
