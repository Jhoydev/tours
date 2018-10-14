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

Route::prefix('portal')->group(function () {
    Route::get('event/{event}/customer/{customer}/calendar', 'CustomerController@calendar');
    Route::get('event/{event}/agenda/customer/{customer}/calendar', 'agendaController@customer');
});

Route::get('states/{id}', 'DynamicLocationController@get_states_by_country');
Route::get('cities/{id}', 'DynamicLocationController@get_cities_by_state');
Route::get('verify-token', 'TicketController@verify');
Route::post('event/{event}/order-detail/{orderDetail}/attended', 'TicketController@attended');

Route::middleware('auth')->group(function () {
    Route::post('events', 'EventController@store');
});

/*
 * Manage PayU Latam Orders
 */
Route::post('confirmation/{order_id}', [
    'as'   => 'confirmationAPIPayU',
    'uses' => 'PaymentController@confirmationAPIPayU',
]);
