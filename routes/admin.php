<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\DashboardController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/

// prefix is admin in RouteServiceProvider

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::group(['namespace'=>'Dashboard', 'middleware'=>'auth:admin','prefix'=>'admin'],function (){

        Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');

        Route::group(['prefix'=>'setting'],function (){
            Route::get('shipping-methods/{type}',[SettingController::class,'editShippingMethods'])->name('edit.shipping.methods');
            Route::put('shipping-methods/{id}',[SettingController::class,'updateShippingMethods'])->name('update.shipping.methods');
        });


    });

    Route::group(['namespace'=>'Dashboard','middleware'=>'guest:admin','prefix'=>'admin'],function (){

        Route::get('/login',[LoginController::class,'login'])->name('admin.login');
        Route::post('/login',[LoginController::class,'postLogin'])->name('admin.post.login');

    });

});




