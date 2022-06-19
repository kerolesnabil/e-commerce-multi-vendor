<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LoginController;
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

Route::group(['namespace'=>'Dashboard', 'middleware'=>'auth:admin'],function (){

    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');


});

Route::group(['namespace'=>'Dashboard','middleware'=>'guest:admin'],function (){

    Route::get('/login',[LoginController::class,'login'])->name('admin.login');
    Route::post('/login',[LoginController::class,'postLogin'])->name('admin.post.login');

});

