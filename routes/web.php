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
Route::get('login/{key_app?}', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/', 'HomeController@index')->name('home');

Route::get('evento/{event}/{page}', 'PageController@show')->name('event.page');
Route::get('redirect-authenticated', 'Customer\Auth\LoginController@redirectAuthenticated');

Route::prefix('portal')->group(function () {
    Route::get('login', 'Customer\Auth\LoginController@showLoginForm')->name('portal.login');
    Route::post('login', 'Customer\Auth\LoginController@login')->name('portal.login');
    Route::post('logout', 'Customer\Auth\LoginController@logout')->name('portal.logout');

});

Route::middleware(['auth:customer'])->group(function () {
    Route::get('portal/home', 'CustomerController@portal')->name('portal');
    Route::get('portal/shop', 'OrdenController@show')->name('shop');
    Route::get('portal/events', 'EventController@index')->name('portal.events');
    Route::get('portal/historic', 'CustomerController@events')->name('customer.events');
    Route::get('portal/profile', 'CustomerController@profile')->name('profile');
    Route::get('portal/customer/change-password', 'CustomerController@changePassword')->name('customer.changepassword');
    Route::put('portal/customer/update-password', 'CustomerController@updatePassword')->name('customer.update.password');
    Route::put('portal/profile/{customer}', 'CustomerController@update')->name('profile.update');
});

Route::middleware('auth:web')->group(function () {

    Route::post('page', 'PageController@store');
    Route::get('page/{event}/create', 'PageController@create');
    Route::get('page/{page}/edit', 'PageController@edit');
    Route::put('page/{page}', 'PageController@update');
    Route::delete('page/{page}', 'PageController@destroy');

    Route::resource('events','EventController');
    Route::get('events/{event}/customers','EventController@customers')->name('event.customers');
    Route::get('events/{event}/orders','EventController@orders')->name('event.orders');
    Route::get('events/{event}/orders/{order}/details','EventController@details')->name('event.orders.details');
    Route::resource('events/{event}/tickets','TicketController');
    Route::resource('customer', 'CustomerController');

    Route::get('user/permissions', 'userController@getPermissionsAndRoles');
    Route::get('user/avatar/{company}/{id}', 'userController@getImageAvatar')->name('avatar.id');
    Route::resource('user','UserController');

    Route::resource('role','RoleController');
    route::get('role/{role}/permissions','RoleController@permissions');

    Route::get('asset/page/public/backgrounds', 'ImageController@publicBackgrounds');
    Route::get('companies/{company}/events/{event}/flyer/{filename}', 'ImageController@flyer');

});

