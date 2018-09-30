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

Route::get('states/{id}','DynamicLocationController@get_states_by_country');
Route::get('cities/{id}','DynamicLocationController@get_cities_by_state');
Route::get('calendar/customer/{customer}','CustomerController@calendar');

Route::middleware('auth')->group(function () {
    Route::post('events', 'EventController@store');
});