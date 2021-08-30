<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

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





Route::group(['prefix' => 'admin'], function (){
    
    Route::get('/', function () {
        return view('admin.login');
    });


    Route::get('login', function () { return view('admin.login'); });
    Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
    
    });