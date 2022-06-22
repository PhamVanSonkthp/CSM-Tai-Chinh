<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('/')->group(function () {
    Route::get('/', [
        'as'=>'welcome.index',
        'uses'=>'App\Http\Controllers\WelcomeController@index',
    ])->middleware('auth');

    Route::get('/logout', [
        'as'=>'welcome.logout',
        'uses'=>'App\Http\Controllers\WelcomeController@logout',
    ])->middleware('auth');

    Route::get('/information', [
        'as'=>'welcome.information',
        'uses'=>'App\Http\Controllers\WelcomeController@indexInformation',
    ])->middleware('auth');

    Route::put('/information', [
        'as'=>'welcome.information',
        'uses'=>'App\Http\Controllers\WelcomeController@updateInformation',
    ])->middleware('auth');

    Route::post('/loan', [
        'as'=>'welcome.loan',
        'uses'=>'App\Http\Controllers\WelcomeController@loan',
    ])->middleware('auth');

    Route::post('/welcome.wallet-out', [
        'as'=>'welcome.wallet_out',
        'uses'=>'App\Http\Controllers\WelcomeController@walletOut',
    ])->middleware('auth');

});


//Route::get('/send-notification', [\App\Http\Controllers\NotificationController::class, 'sendNotification']);
