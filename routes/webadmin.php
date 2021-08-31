<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\webAdmin\CustomAuthController;
use App\Http\Controllers\webAdmin\FooterSectionController;

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

//login section
Route::get('/', function () {
    return view('admin.login');
});
Route::post('custom-login', [CustomAuthController::class, 'customLogin']);
Route::get('login', function () { return view('admin.login'); });
Route::get('dashboard', function () {
    return view('admin.dashboard');
});
Route::get('signout', [CustomAuthController::class, 'signOut']);

//Footer Section
Route::resource('footer-section', FooterSectionController::class);