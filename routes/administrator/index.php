<?php

use App\Events\ChatPusherEvent;
use App\Http\Requests\PusherChatRequest;
use App\Models\Notification;
use App\Models\RestfulAPI;
use App\Models\User;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/admin', 'App\Http\Controllers\Admin\AdminController@loginAdmin');
Route::post('/admin', 'App\Http\Controllers\Admin\AdminController@postLoginAdmin');

Route::get('/admin/logout', [
    'as' => 'administrator.logout',
    'uses' => '\App\Http\Controllers\Admin\AdminController@logout'
]);


Route::prefix('administrator')->group(function () {

    Route::prefix('history-data')->group(function () {
        Route::get('/', [
            'as' => 'administrator.history_data.index',
            'uses' => 'App\Http\Controllers\Admin\AdminHistoryDataController@index',
            'middleware' => 'can:history-data-list',
        ]);

    });

    Route::prefix('logo')->group(function () {
        Route::get('/', [
            'as' => 'administrator.logo.add',
            'uses' => 'App\Http\Controllers\Admin\AdminLogoController@create',
            'middleware' => 'can:logo-list',
        ]);

        Route::post('/store', [
            'as' => 'administrator.logo.store',
            'uses' => 'App\Http\Controllers\Admin\AdminLogoController@store',
            'middleware' => 'can:logo-add',
        ]);

    });

    Route::prefix('setting')->group(function () {
        Route::get('/', [
            'as' => 'administrator.setting.index',
            'uses' => 'App\Http\Controllers\Admin\AdminSettingController@index',
        ]);

        Route::put('/update', [
            'as' => 'administrator.setting.update',
            'uses' => 'App\Http\Controllers\Admin\AdminSettingController@update',
        ]);

    });

    Route::prefix('users')->group(function () {

        Route::get('/', [
            'as' => 'administrator.users.index',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@index',
            'middleware' => 'can:user-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.users.create',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@create',
            'middleware' => 'can:user-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.users.store',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@store',
            'middleware' => 'can:user-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.users.edit',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@edit',
            'middleware' => 'can:user-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.users.update',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@update',
            'middleware' => 'can:user-edit',
        ]);

        Route::put('/update-status/{id}', [
            'as' => 'administrator.users.status.update',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@updateStatus',
            'middleware' => 'can:user-edit',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'administrator.users.delete',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@delete',
            'middleware' => 'can:user-delete',
        ]);

        Route::get('/export', [
            'as' => 'administrator.users.export',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@exportUser',
            'middleware' => 'can:user-list',
        ]);

        Route::post('/send-email', [
            'as' => 'administrator.users.send_email',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@sendEmail',
            'middleware' => 'can:user-edit',
        ]);

        Route::get('/get', [
            'as' => 'administrator.users.get',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@get',
            'middleware' => 'can:user-list',
        ]);

        Route::put('/update', [
            'as' => 'administrator.users.update',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@updateAjax',
            'middleware' => 'can:user-edit',
        ]);

    });

    Route::prefix('employees')->group(function () {
        Route::get('/', [
            'as' => 'administrator.employees.index',
            'uses' => 'App\Http\Controllers\Admin\AdminEmployeeController@index',
            'middleware' => 'can:employee-list',
        ]);
        Route::get('/detail/{id}', [
            'as' => 'administrator.employees.detail',
            'uses' => 'App\Http\Controllers\Admin\AdminEmployeeController@detail',
            'middleware' => 'can:employee-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.employees.create',
            'uses' => 'App\Http\Controllers\Admin\AdminEmployeeController@create',
            'middleware' => 'can:employee-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.employees.store',
            'uses' => 'App\Http\Controllers\Admin\AdminEmployeeController@store',
            'middleware' => 'can:employee-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.employees.edit',
            'uses' => 'App\Http\Controllers\Admin\AdminEmployeeController@edit',
            'middleware' => 'can:employee-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.employees.update',
            'uses' => 'App\Http\Controllers\Admin\AdminEmployeeController@update',
            'middleware' => 'can:employee-edit',
        ]);

        Route::get('/update/{id}', [
            'as' => 'administrator.employees.updateStatus',
            'uses' => 'App\Http\Controllers\Admin\AdminEmployeeController@updateStatus',
            'middleware' => 'can:employee-edit',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'administrator.employees.delete',
            'uses' => 'App\Http\Controllers\Admin\AdminEmployeeController@delete',
            'middleware' => 'can:employee-delete',
        ]);

    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'administrator.roles.index',
            'uses' => 'App\Http\Controllers\Admin\AdminRoleController@index',
            'middleware' => 'can:role-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.roles.create',
            'uses' => 'App\Http\Controllers\Admin\AdminRoleController@create',
            'middleware' => 'can:role-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.roles.edit',
            'uses' => 'App\Http\Controllers\Admin\AdminRoleController@edit',
            'middleware' => 'can:role-edit',
        ]);

        Route::post('/store', [
            'as' => 'administrator.roles.store',
            'uses' => 'App\Http\Controllers\Admin\AdminRoleController@store',
            'middleware' => 'can:role-add',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.roles.update',
            'uses' => 'App\Http\Controllers\Admin\AdminRoleController@update',
            'middleware' => 'can:role-edit',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'administrator.roles.delete',
            'uses' => 'App\Http\Controllers\Admin\AdminRoleController@delete',
            'middleware' => 'can:role-delete',
        ]);

    });

    Route::prefix('permissions')->group(function () {
        Route::get('/create', [
            'as' => 'administrator.permissions.create',
            'uses' => 'App\Http\Controllers\Admin\AdminPermissionController@create',
            'middleware' => 'can:permission-list',
        ]);

        Route::post('/store', [
            'as' => 'administrator.permissions.store',
            'uses' => 'App\Http\Controllers\Admin\AdminPermissionController@store',
            'middleware' => 'can:permission-add',
        ]);

    });

    Route::prefix('notification')->group(function () {
        Route::get('/', [
            'as' => 'administrator.notification.index',
            'uses' => 'App\Http\Controllers\Admin\AdminNotificationController@index',
            'middleware' => 'can:notification-list',
        ]);

        Route::get('/edit', [
            'as' => 'administrator.notification.edit',
            'uses' => 'App\Http\Controllers\Admin\AdminNotificationController@edit',
            'middleware' => 'can:notification-edit',
        ]);

        Route::put('/update', [
            'as' => 'administrator.notification.update',
            'uses' => 'App\Http\Controllers\Admin\AdminNotificationController@update',
            'middleware' => 'can:notification-edit',
        ]);

        Route::get('/delete/{id}', [
            'as'=>'administrator.notification.delete',
            'uses'=>'App\Http\Controllers\Admin\AdminNotificationController@delete',
            'middleware'=>'can:notification-delete',
        ]);

    });

    Route::prefix('request-payment-wallet')->group(function () {
        Route::get('/', [
            'as' => 'administrator.request_payment_wallet.index',
            'uses' => 'App\Http\Controllers\Admin\AdminRequestPaymentWalletController@index',
            'middleware' => 'can:notification-list',
        ]);

        Route::get('/edit', [
            'as' => 'administrator.request_payment_wallet.edit',
            'uses' => 'App\Http\Controllers\Admin\AdminRequestPaymentWalletController@edit',
            'middleware' => 'can:notification-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.request_payment_wallet.update',
            'uses' => 'App\Http\Controllers\Admin\AdminRequestPaymentWalletController@update',
            'middleware' => 'can:notification-edit',
        ]);

        Route::get('/delete/{id}', [
            'as'=>'administrator.request_payment_wallet.delete',
            'uses'=>'App\Http\Controllers\Admin\AdminRequestPaymentWalletController@delete',
            'middleware'=>'can:notification-delete',
        ]);

    });

    Route::prefix('slider')->group(function () {
        Route::get('/', [
            'as' => 'administrator.slider.index',
            'uses' => 'App\Http\Controllers\Admin\AdminSliderController@index',
            'middleware' => 'can:slider-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.slider.create',
            'uses' => 'App\Http\Controllers\Admin\AdminSliderController@create',
            'middleware' => 'can:slider-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.slider.store',
            'uses' => 'App\Http\Controllers\Admin\AdminSliderController@store',
            'middleware' => 'can:slider-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.slider.edit',
            'uses' => 'App\Http\Controllers\Admin\AdminSliderController@edit',
            'middleware' => 'can:slider-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.slider.update',
            'uses' => 'App\Http\Controllers\Admin\AdminSliderController@update',
            'middleware' => 'can:slider-edit',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'administrator.slider.delete',
            'uses' => 'App\Http\Controllers\Admin\AdminSliderController@delete',
            'middleware' => 'can:slider-delete',
        ]);

    });

    Route::prefix('lends')->group(function () {

        Route::get('/', [
            'as' => 'administrator.lends.index',
            'uses' => 'App\Http\Controllers\Admin\AdminLendController@index',
            'middleware' => 'can:lend-list',
        ]);

        Route::get('/create', [
            'as' => 'administrator.lends.create',
            'uses' => 'App\Http\Controllers\Admin\AdminLendController@create',
            'middleware' => 'can:lend-add',
        ]);

        Route::post('/store', [
            'as' => 'administrator.lends.store',
            'uses' => 'App\Http\Controllers\Admin\AdminLendController@store',
            'middleware' => 'can:lend-add',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'administrator.lends.edit',
            'uses' => 'App\Http\Controllers\Admin\AdminLendController@edit',
            'middleware' => 'can:lend-edit',
        ]);

        Route::get('/detail/{id}', [
            'as' => 'administrator.lends.detail',
            'uses' => 'App\Http\Controllers\Admin\AdminLendController@detail',
            'middleware' => 'can:lend-edit',
        ]);

        Route::put('/update/{id}', [
            'as' => 'administrator.lends.update',
            'uses' => 'App\Http\Controllers\Admin\AdminLendController@update',
            'middleware' => 'can:lend-edit',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'administrator.lends.delete',
            'uses' => 'App\Http\Controllers\Admin\AdminLendController@delete',
            'middleware' => 'can:lend-delete',
        ]);

        Route::put('/approve', [
            'as' => 'administrator.lends.approve',
            'uses' => 'App\Http\Controllers\Admin\AdminLendController@approve',
            'middleware' => 'can:lend-edit',
        ]);

        Route::put('/reject', [
            'as' => 'administrator.lends.reject',
            'uses' => 'App\Http\Controllers\Admin\AdminLendController@reject',
            'middleware' => 'can:lend-edit',
        ]);

        Route::get('/export', [
            'as' => 'administrator.lends.export',
            'uses' => 'App\Http\Controllers\Admin\AdminLendController@exportUser',
            'middleware' => 'can:lend-list',
        ]);

        Route::get('/get', [
            'as' => 'administrator.lends.get',
            'uses' => 'App\Http\Controllers\Admin\AdminLendController@get',
            'middleware' => 'can:lend-list',
        ]);

    });

});

