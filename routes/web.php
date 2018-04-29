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
Route::middleware('auth')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('event','EventController');
    Route::resource('user/roles','RoleController');
    Route::resource('user/permissions', 'PermissionController');
    Route::get('user/avatar/{company}/{id}', 'userController@getImageAvatar')->name('avatar.id');
    Route::resource('user','UserController');
    Route::resource('company','CompanyController')->middleware('insignia');
});

