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
Route::get('tour/{key_app}/{page}', 'PageController@show');
Route::middleware('auth')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::post('page', 'PageController@store');
    Route::get('page/{event}/create', 'PageController@create');
    Route::get('page/{page}/edit', 'PageController@edit');
    Route::put('page/{page}', 'PageController@update');
    Route::delete('page/{page}', 'PageController@destroy');

    Route::get('events/{event}/prices', 'EventController@prices');
    Route::resource('events','EventController');

    Route::get('user/permissions', 'userController@getPermissionsAndRoles');
    Route::get('user/avatar/{company}/{id}', 'userController@getImageAvatar')->name('avatar.id');
    Route::resource('user','UserController');

    Route::resource('role','RoleController');


});

