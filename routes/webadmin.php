<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\webAdmin\CustomAuthController;
use App\Http\Controllers\webAdmin\PopupController;
use App\Http\Controllers\webAdmin\BannerController;
use App\Http\Controllers\webAdmin\FooterSectionController;
use App\Http\Controllers\webAdmin\NewsOffersController;

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


//Popup Section
Route::resource('popup', PopupController::class);
Route::get('popup/change-status/{id}', [PopupController::class,'changeStatus']);


//Banner Section
Route::resource('banner', BannerController::class);
Route::get('banner/change-status/{id}', [BannerController::class,'changeStatus']);


//Footer Section
Route::resource('footer-section', FooterSectionController::class);
Route::get('footer-section/change-status/{id}', [FooterSectionController::class,'changeStatus']);

// News & Offers
Route::resource('news-offers', NewsOffersController::class);
Route::get('news-offers/change-status/{id}', [NewsOffersController::class,'changeStatus']);