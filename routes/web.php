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

// Avatar
Route::get('/user/avatar/{company}/{user}', 'Admin\UserController@getImageAvatar')->name('user.avatar');

// Autenticacion de Admin
Route::prefix('admin')->group(function () {

    // Login de Admin
    Route::get('/login/{key_app?}', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login');

    // Cerrar Sesion
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

});

// Admin
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth:web']], function () {

    //Inicio
    Route::get('/dashboard', 'Admin\HomeController@index')->name('home');

    // Usuarios
    Route::get('/user/permissions', 'Admin\UserController@getPermissionsAndRoles')->name('user.permissions-and-roles');
    Route::resource('/user', 'Admin\UserController')->except(['show']);

    // Roles y Permisos
    Route::resource('/role', 'Admin\RoleController')->only(['index']);

    // Customers
    Route::resource('/customer', 'Admin\CustomerController')->except(['show','edit','destroy','update']);

    // Eventos
    Route::group(['as' => 'events.', 'prefix' => 'events'], function () {

        Route::group(['prefix' => '{event}'], function () {

            // Panel de configuracion
            Route::group(['prefix' => 'settings'], function () {

                // Pagina
                Route::get('page', 'Admin\Event\SettingsController@page')->name('page');

                // Descripcion de orden
                Route::get('order-description', 'Admin\Event\SettingsController@orderDescription')->name('order_description');
                Route::put('order-description', 'Admin\Event\SettingsController@orderDescriptionUpdate')->name('order_description.put');

                // Memorias y certificados
                Route::get('memory-certificate', 'Admin\Event\SettingsController@memoryAndCertificate')->name('memory_certificate');
                Route::put('memory-certificate', 'Admin\Event\SettingsController@memoryAndCertificateUpdate')->name('memory_certificate.put');

                // Impuestos
                Route::get('taxes', 'Admin\Event\SettingsController@taxes')->name('taxes');
                Route::put('taxes', 'Admin\Event\SettingsController@taxesUpdate')->name('taxes.put');


            });

            // Asistentes del evento
            Route::get('customers', 'Admin\EventController@customers')->name('customers');

            // Ordenes del evento
            Route::get('orders', 'Admin\EventController@orders')->name('orders');

            // Detalles de la orden
            Route::get('orders/{order}/details', 'Admin\EventController@details')->name('orders.details');

            // Tiquetes
            Route::resource('tickets', 'Admin\Event\TicketController');

            // Enviar tiquete?
            Route::resource('tickets/{ticket}/send-tickets', 'SpecialTicketController')->except(['show']);

            //?
            Route::get('tickets/{ticket}/send-tickets/customer/{customer}', 'SpecialTicketController@show');
            // Confirmar borrado
            Route::get('confirm-delete', 'Admin\EventController@confirmDelete');
        });

        Route::delete('tickets/refuse/{orderDetail}', 'Admin\Event\TicketController@refuse');

    });

    // Eventos
    Route::resource('events', 'Admin\EventController')->except(['create','show']);
    Route::get('events/{event}/dashboard', 'Admin\EventController@show')->name('events.show');

});

// Pagina web del evento
Route::get('evento/{page}', 'PageController@show')->name('event.page');

// Redirigir para cerrar sesion
Route::get('redirect-authenticated', 'Customer\Auth\LoginController@redirectAuthenticated');

// Fondos para paginas de eventos
Route::get('asset/page/public/backgrounds', 'ImageController@publicBackgrounds');

// Flyer del evento
Route::get('companies/{company}/events/{event}/flyer/{filename}', 'ImageController@flyer');

Route::middleware('auth:web')->group(function () {

    Route::post('page', 'PageController@store');
    Route::prefix('page')->group(function () {
        Route::get('{event}/create', 'PageController@create');
        Route::get('{page}/edit', 'PageController@edit');
        Route::put('{page}', 'PageController@update');
        Route::delete('{page}', 'PageController@destroy');
    });

    Route::delete('order/{order}', 'OrderController@destroy');
    Route::get('role/{role}/permissions', 'Admin\RoleController@permissions');
    Route::put('event/{event}/order/{order}/confirm', ['as' => 'order.confirm', 'uses' => 'OrderController@confirm']);
});

Route::prefix('portal')->group(function () {
    Route::get('login', 'Customer\Auth\LoginController@showLoginForm')->name('portal.login');
    Route::post('login', 'Customer\Auth\LoginController@login')->name('portal.login');
    Route::post('logout', 'Customer\Auth\LoginController@logout')->name('portal.logout');
    Route::get('register', 'Customer\Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Customer\Auth\RegisterController@register')->name('portal.register');
});
Route::middleware('auth:customer')->group(function () {
    Route::get('portal', 'Portal\CustomerController@portal');
    Route::get('portal/home', 'Portal\CustomerController@portal')->name('portal');
    Route::get('portal/shop', 'OrderController@show')->name('shop');
    Route::post('portal/shop', 'OrderController@store')->name('shop.store');
    Route::get('portal/order/{order}/invoice', 'OrderController@invoice')->name('order.invoice');
    Route::get('portal/orders', 'OrderController@index');
    Route::get('portal/explorer', 'Admin\EventController@index')->name('portal.explorer.events');
    Route::get('portal/history', 'Portal\CustomerController@history')->name('customer.history');
    Route::get('portal/event/{event}', 'Portal\CustomerController@event')->name('customer.event');
    Route::get('portal/event/{event}/orders', 'Portal\CustomerController@orders')->name('customer.event.orders');
    Route::get('portal/customer/event/{event}/details', 'Portal\CustomerController@Details')->name('customer.event.details');
    Route::get('portal/event/{event}/order/{order}', 'Portal\CustomerController@order')->name('customer.event.order');
    Route::get('portal/profile', 'Portal\CustomerController@profile')->name('profile');
    Route::get('portal/customer/change-password', 'Portal\CustomerController@changePassword')->name('customer.changepassword');
    Route::put('portal/customer/update-password', 'Portal\CustomerController@updatePassword')->name('customer.update.password');
    Route::put('portal/profile/{customer}', 'Portal\CustomerController@update')->name('profile.update');
    Route::put('portal/event/{event}/date/{meeting}', 'MeetingController@update');
    Route::post('portal/event/{event}/date', 'MeetingController@store');
    Route::delete('portal/event/{event}/date/{meeting}', 'MeetingController@destroy');
    Route::post('portal/events/order/assign-ticket/{orderDetail}', 'Admin\Event\TicketController@assignToCustomer');
    Route::post('portal/asiggn-by-token', 'Admin\Event\TicketController@asiggnByToken');
    Route::delete('portal/ticket/{orderDetail}', 'Admin\Event\TicketController@refuse');
    Route::post('portal/ticket/{orderDetail}', 'Admin\Event\TicketController@resendEmail');

    Route::get('portal/event/{event}/agenda', 'MeetingController@index');
    Route::get('portal/event/{event}/agenda/customer/{customer}/calendar', 'MeetingController@customer');
});


