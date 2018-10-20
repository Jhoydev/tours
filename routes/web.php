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

Route::post('event/{event}/import-csv', 'ImportCsvController@importCsv');


Auth::routes();
Route::get('login/{key_app?}', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/', 'HomeController@index')->name('home');

Route::get('evento/{page}', 'PageController@show')->name('event.page');
Route::get('redirect-authenticated', 'Customer\Auth\LoginController@redirectAuthenticated');
Route::get('asset/page/public/backgrounds', 'ImageController@publicBackgrounds');
Route::get('companies/{company}/events/{event}/flyer/{filename}', 'ImageController@flyer');

Route::prefix('portal')->group(function () {
    Route::get('login', 'Customer\Auth\LoginController@showLoginForm')->name('portal.login');
    Route::post('login', 'Customer\Auth\LoginController@login')->name('portal.login');
    Route::post('logout', 'Customer\Auth\LoginController@logout')->name('portal.logout');
    Route::get('register','Customer\Auth\RegisterController@showRegistrationForm');
    Route::post('register','Customer\Auth\RegisterController@register')->name('portal.register');
});

Route::middleware(['auth:customer'])->group(function () {
    Route::get('portal', 'CustomerController@portal');
    Route::get('portal/home', 'CustomerController@portal')->name('portal');
    Route::get('portal/shop', 'OrderController@show')->name('shop');
    Route::post('portal/shop', 'OrderController@store')->name('shop.store');
    Route::get('portal/order/{order}/invoice', 'OrderController@invoice')->name('order.invoice');
    Route::get('portal/orders', 'OrderController@index');
    Route::get('portal/explorer', 'EventController@index')->name('portal.explorer.events');
    Route::get('portal/history', 'CustomerController@history')->name('customer.history');
    Route::get('portal/event/{event}', 'CustomerController@event')->name('customer.event');
    Route::get('portal/event/{event}/orders', 'CustomerController@orders')->name('customer.event.orders');
    Route::get('portal/customer/event/{event}/details', 'CustomerController@Details')->name('customer.event.details');
    Route::get('portal/event/{event}/order/{order}', 'CustomerController@order')->name('customer.event.order');
    Route::get('portal/profile', 'CustomerController@profile')->name('profile');
    Route::get('portal/customer/change-password', 'CustomerController@changePassword')->name('customer.changepassword');
    Route::put('portal/customer/update-password', 'CustomerController@updatePassword')->name('customer.update.password');
    Route::put('portal/profile/{customer}', 'CustomerController@update')->name('profile.update');
    Route::put('portal/event/{event}/date/{date}', 'MeetingController@update');
    Route::post('portal/event/{event}/date', 'MeetingController@store');
    Route::delete('portal/event/{event}/date/{date}', 'MeetingController@destroy');
    Route::post('portal/events/order/assign-ticket/{orderDetail}', 'TicketController@assignToCustomer');
    Route::post('portal/asiggn-by-token', 'TicketController@asiggnByToken');
    Route::delete('portal/ticket/{orderDetail}', 'TicketController@refuse');
    Route::post('portal/ticket/{orderDetail}', 'TicketController@resendEmail');

    Route::get('portal/event/{event}/agenda', 'MeetingController@index');
    Route::get('portal/event/{event}/agenda/customer/{customer}/calendar', 'MeetingController@customer');

});

Route::middleware('auth:web')->group(function () {

    Route::post('page', 'PageController@store');
    Route::prefix('page')->group(function () {
        Route::get('{event}/create', 'PageController@create');
        Route::get('{page}/edit', 'PageController@edit');
        Route::put('{page}', 'PageController@update');
        Route::delete('{page}', 'PageController@destroy');
    });


    Route::prefix('events')->group(function () {
        Route::get('{event}/edit/page','EventController@page')->name('event.edit.page');
        Route::get('{event}/edit/order_description','EventController@orderDescription')->name('event.order_description');
        Route::put('{event}/edit/order_description','EventController@orderDescriptionUpdate')->name('event.order_description.put');
        Route::get('{event}/edit/memory-certificate','EventController@memoryAndCertificate')->name('event.memory_certificate');
        Route::put('{event}/edit/memory-certificate','EventController@memoryAndCertificateUpdate')->name('event.memory_certificate.put');
        Route::get('{event}/edit/taxes','EventController@taxes')->name('event.taxes');
        Route::put('{event}/edit/taxes','EventController@taxesUpdate')->name('event.taxes.put');
        Route::get('{event}/customers','EventController@customers')->name('event.customers');
        Route::get('{event}/orders','EventController@orders')->name('event.orders');
        Route::get('{event}/orders/{order}/details','EventController@details')->name('event.orders.details');
        Route::resource('{event}/tickets','TicketController');
        Route::resource('{event}/tickets/{ticket}/send-tickets','SpecialTicketController')->except(['show']);
        Route::get('{event}/tickets/{ticket}/send-tickets/customer/{customer}','SpecialTicketController@show');
        Route::delete('tickets/refuse/{orderDetail}','TicketController@refuse');
    });
    Route::resource('events','EventController');

    Route::resource('customer', 'CustomerController');

    Route::prefix('user')->group(function () {
        Route::get('permissions', 'UserController@getPermissionsAndRoles');
        Route::get('avatar/{company}/{id}', 'UserController@getImageAvatar')->name('avatar.id');
    });
    Route::resource('user','UserController');

    Route::resource('role','RoleController');
    Route::delete('order/{order}','OrderController@destroy');
    Route::get('role/{role}/permissions','RoleController@permissions');
});

