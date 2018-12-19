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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'appointments'], function(){

    Route::post('', 'AppointmentController@create');
    Route::get('', 'AppointmentController@getAll');
    Route::get('next-possible-appointment', 'AppointmentController@getNextCustomerPossibleSchedules');
    Route::get('available-schedules', 'AppointmentController@getAll');

});

Route::group(['prefix' => 'speciality'], function(){

    Route::get('', 'SpecialityController@getAll');

});

Route::group(['prefix' => 'doctor'], function(){

    Route::get('', 'DoctorController@getAll');

});

Route::group(['prefix' => 'appointment-type'], function(){

    Route::get('', 'AppointmentTypeController@getAll');

});

