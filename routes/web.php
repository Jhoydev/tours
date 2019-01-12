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
            // Confirmar borrado de un evento
            Route::get('confirm-delete', 'Admin\EventController@confirmDelete')->name('delete');
            Route::get('dashboard', 'Admin\EventController@show')->name('show');

        });

        Route::delete('tickets/refuse/{orderDetail}', 'Admin\Event\TicketController@refuse');

    });

    // Eventos
    Route::resource('events', 'Admin\EventController')->except(['create','show']);
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

Route::get('login', 'Customer\Auth\LoginController@showLoginForm')->name('portal.login');
Route::post('login', 'Customer\Auth\LoginController@login')->name('portal.login');
Route::post('logout', 'Customer\Auth\LoginController@logout')->name('portal.logout');
Route::get('register', 'Customer\Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Customer\Auth\RegisterController@register')->name('portal.register');

Route::get('/', 'EventController@index')->name('home');

Route::middleware('auth:customer')->group(function () {

    // portal.
    Route::group(['as' => 'portal.'], function () {

        // portal.home.
        Route::group(['as' => 'home.'], function (){

            // Home del portal
            Route::get('/home', 'Portal\HomeController@index')->name('index');

            // Eventos anteriores
            Route::get('/history', 'Portal\HomeController@history')->name('history');

        });

    });

    Route::get('/shop', 'OrderController@show')->name('shop');
    Route::post('/shop', 'OrderController@store')->name('shop.store');
    Route::get('/order/{order}/invoice', 'OrderController@invoice')->name('order.invoice');
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/event/{event}', 'Portal\CustomerController@event')->name('customer.event');
    Route::get('/event/{event}/orders', 'Portal\CustomerController@orders')->name('customer.event.orders');
    Route::get('/customer/event/{event}/details', 'Portal\CustomerController@Details')->name('customer.event.details');
    Route::get('/event/{event}/order/{order}', 'Portal\CustomerController@order')->name('customer.event.order');
    Route::get('/profile', 'Portal\CustomerController@profile')->name('profile');
    Route::get('/customer/change-password', 'Portal\CustomerController@changePassword')->name('customer.changepassword');
    Route::put('/customer/update-password', 'Portal\CustomerController@updatePassword')->name('customer.update.password');
    Route::put('/profile/{customer}', 'Portal\CustomerController@update')->name('profile.update');
    Route::put('/event/{event}/date/{meeting}', 'MeetingController@update');
    Route::post('/event/{event}/date', 'MeetingController@store');
    Route::delete('/event/{event}/date/{meeting}', 'MeetingController@destroy');
    Route::post('/events/order/assign-ticket/{orderDetail}', 'Admin\Event\TicketController@assignToCustomer');
    Route::post('/asiggn-by-token', 'Admin\Event\TicketController@asiggnByToken');
    Route::delete('/ticket/{orderDetail}', 'Admin\Event\TicketController@refuse');
    Route::post('/ticket/{orderDetail}', 'Admin\Event\TicketController@resendEmail');
    Route::get('/event/{event}/agenda', 'MeetingController@index');
    Route::get('/event/{event}/agenda/customer/{customer}/calendar', 'MeetingController@customer');
});


