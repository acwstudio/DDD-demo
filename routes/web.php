<?php

use App\Http\Shop\Customers\Controllers\ShopLoginController;
use App\Http\Shop\Customers\Controllers\ShopLogoutController;
use App\Http\Shop\Customers\Controllers\ShopRegisterController;
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

Route::get('/', function () {
    return view('shop.pages.shop');
});

/**************************************
 ******* Authentication Routes ********
 **************************************/

//Login Routes
Route::get('/login', [ShopLoginController::class, 'showLoginForm'])->name('shop.login');
Route::post('/login', [ShopLoginController::class, 'login'])->name('shop');

//Logout Routes
Route::post('/logout', [ShopLogoutController::class, 'logout'])->name('shop.logout');

//Register Routes
Route::get('/register', [ShopRegisterController::class, 'showRegisterForm'])->name('shop.register');
Route::post('/register', [ShopRegisterController::class, 'register']);
