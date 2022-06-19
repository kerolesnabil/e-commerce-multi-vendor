<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\LoginController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace'=>'Dashboard', 'middleware'=>'auth:admin'],function (){

    Route::get('/',function (){
        return 'in admin';
    });


});

Route::group(['namespace'=>'Dashboard'],function (){

    Route::get('/login',[LoginController::class,'login'])->name('admin.login');

});

