<?php

use App\Http\Shop\Customers\Controllers\ShopForgotPasswordController;
use App\Http\Shop\Customers\Controllers\ShopLoginController;
use App\Http\Shop\Customers\Controllers\ShopLogoutController;
use App\Http\Shop\Customers\Controllers\ShopRegisterController;
use App\Http\Shop\Customers\Controllers\ShopResetPasswordController;
use App\Http\Shop\Customers\Controllers\ShopVerifyController;
use App\Http\Shop\ShopHomeController;
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

Route::get('/', [ShopHomeController::class, 'showHomePage'])->name('home');

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

// Email Verification Routes
Route::get('email/verify', [ShopVerifyController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [ShopVerifyController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [ShopVerifyController::class, 'resend'])->name('verification.resend');

//Forgot Password Routes
Route::get('/password/reset', [ShopForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('/password/email', [ShopForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

//Reset Password Routes
Route::get('/password/reset/{token}', [ShopResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('/password/reset', [ShopResetPasswordController::class, 'reset'])
    ->name('password.update');

