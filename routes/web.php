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

Route::prefix('admin')->group(function () {

    // Login de Admin
    Route::get('/login/{key_app?}', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login');

    // Cerrar Sesion
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:web']], function () {

    //Inicio
    Route::get('/', 'HomeController@index')->name('home');

    // Usuarios
    Route::get('/user/permissions', 'UserController@getPermissionsAndRoles');
    Route::get('/user/avatar/{company}/{id}', 'UserController@getImageAvatar')->name('avatar.id');
    Route::resource('/user', 'UserController');

    // Eventos
    Route::group(['prefix' => 'events'], function () {

        Route::group(['prefix' => '{event}'], function () {

            // Panel de configuracion
            Route::group(['prefix' => 'dashboard'], function () {

                // Pagina
                Route::get('page', 'Admin\Event\PageController@edit')->name('event.edit.page');

                // Descripcion de orden
                Route::get('order-description', 'Admin\Event\DashboardController@orderDescription')->name('event.order_description');
                Route::put('order-description', 'Admin\Event\DashboardController@orderDescriptionUpdate')->name('event.order_description.put');

                // Memorias y certificados
                Route::get('memory-certificate', 'Admin\Event\DashboardController@memoryAndCertificate')->name('event.memory_certificate');
                Route::put('memory-certificate', 'Admin\Event\DashboardController@memoryAndCertificateUpdate')->name('event.memory_certificate.put');

                // Impuestos
                Route::get('taxes', 'Admin\Event\DashboardController@taxes')->name('event.taxes');
                Route::put('taxes', 'Admin\Event\DashboardController@taxesUpdate')->name('event.taxes.put');


            });

            // Asistentes del evento
            Route::get('customers', 'EventController@customers')->name('event.customers');

            // Ordenes del evento
            Route::get('orders', 'EventController@orders')->name('event.orders');

            // Detalles de la orden
            Route::get('orders/{order}/details', 'EventController@details')->name('event.orders.details');

            // Tiquetes
            Route::resource('tickets', 'TicketController');

            // Enviar tiquete?
            Route::resource('tickets/{ticket}/send-tickets', 'SpecialTicketController')->except(['show']);

            //?
            Route::get('tickets/{ticket}/send-tickets/customer/{customer}', 'SpecialTicketController@show');
            // Confirmar borrado
            Route::get('confirm-delete', 'EventController@confirmDelete');
        });

        Route::delete('tickets/refuse/{orderDetail}', 'TicketController@refuse');

    });

});

Route::get('evento/{page}', 'PageController@show')->name('event.page');
Route::get('redirect-authenticated', 'Customer\Auth\LoginController@redirectAuthenticated');
Route::get('asset/page/public/backgrounds', 'ImageController@publicBackgrounds');
Route::get('companies/{company}/events/{event}/flyer/{filename}', 'ImageController@flyer');

Route::middleware('auth:web')->group(function () {

    Route::post('page', 'PageController@store');
    Route::prefix('page')->group(function () {
        Route::get('{event}/create', 'PageController@create');
        Route::get('{page}/edit', 'PageController@edit');
        Route::put('{page}', 'PageController@update');
        Route::delete('{page}', 'PageController@destroy');
    });

    Route::resource('events', 'EventController');
    Route::resource('customer', 'CustomerController');
    Route::resource('role', 'RoleController');
    Route::delete('order/{order}', 'OrderController@destroy');
    Route::get('role/{role}/permissions', 'RoleController@permissions');
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
    Route::put('portal/event/{event}/date/{meeting}', 'MeetingController@update');
    Route::post('portal/event/{event}/date', 'MeetingController@store');
    Route::delete('portal/event/{event}/date/{meeting}', 'MeetingController@destroy');
    Route::post('portal/events/order/assign-ticket/{orderDetail}', 'TicketController@assignToCustomer');
    Route::post('portal/asiggn-by-token', 'TicketController@asiggnByToken');
    Route::delete('portal/ticket/{orderDetail}', 'TicketController@refuse');
    Route::post('portal/ticket/{orderDetail}', 'TicketController@resendEmail');

    Route::get('portal/event/{event}/agenda', 'MeetingController@index');
    Route::get('portal/event/{event}/agenda/customer/{customer}/calendar', 'MeetingController@customer');
});


