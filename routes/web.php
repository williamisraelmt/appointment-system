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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['prefix' => 'appointments'], function(){

    Route::get('/appointments', 'AppointmentController@index');
    Route::get('/appointments/next-possible-appointment', 'AppointmentController@getNextCustomerPossibleSchedules');

});

Route::get('/home', 'HomeController@index')->name('home');