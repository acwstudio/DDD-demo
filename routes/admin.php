<?php

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

use App\Http\AdminPanel\Admins\Controllers\AdminBanController;
use App\Http\AdminPanel\Admins\Controllers\AdminListController;
use App\Http\AdminPanel\Admins\Controllers\AdminLoginController;
use App\Http\AdminPanel\Admins\Controllers\AdminLogoutController;
use App\Http\AdminPanel\Admins\Controllers\AdminRegisterController;
use App\Http\AdminPanel\Admins\Controllers\AdminResetPasswordController;
use App\Http\AdminPanel\Customers\Controllers\CustomerBanController;
use App\Http\AdminPanel\Customers\Controllers\CustomerListController;
use App\Http\AdminPanel\Dashboard\Controllers\DashboardHomeController;
use App\Http\AdminPanel\Products\Controllers\ProductListController;

Route::get('/', [DashboardHomeController::class, 'showHomePage'])->name('dashboard.home');
Route::get('admins', [AdminListController::class, 'showList'])->name('admin.list');

/**************************************
 ******* Authentication Routes ********
 **************************************/

// Login Routes
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminLoginController::class, 'login'])->name('admin');

// Logout Routes
Route::post('/logout', [AdminLogoutController::class, 'logout'])->name('admin.logout');

// Register Routes
Route::get('/register', [AdminRegisterController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/register', [AdminRegisterController::class, 'register']);

// Reset Password Routes
Route::get('/password/reset/show/{id}', [AdminResetPasswordController::class, 'showResetForm'])
    ->name('admin.password.reset');
Route::put('/password/reset/{id}', [AdminResetPasswordController::class, 'reset'])
    ->name('admin.password.update');

// Ban routes
Route::get('/ban/show/{id}', [AdminBanController::class, 'showBanForm'])->name('admin.ban.show');
Route::put('/ban/reset/{id}', [AdminBanController::class, 'ban'])->name('admin.ban.update');

/************************************************************************************************/

/**************************************
 ******* Customers Routes ********
 **************************************/
// Customers list Routes
Route::get('customers', [CustomerListController::class, 'showList'])->name('customer.list');

// Bun Rotes
Route::get('customer/ban/show/{id}', [CustomerBanController::class, 'showBanForm'])->name('customer.ban.show');
Route::put('customer/ban/reset/{id}', [CustomerBanController::class, 'ban'])->name('customer.ban.update');

/************************************************************************************************/

/**************************************
 ******* Products Routes ********
 **************************************/
// Products list Routes
Route::get('products', [ProductListController::class, 'showList'])->name('product.list');

// Archived Rotes
//Route::get('customer/ban/show/{id}', [CustomerBanController::class, 'showBanForm'])->name('customer.ban.show');
//Route::put('customer/ban/reset/{id}', [CustomerBanController::class, 'ban'])->name('customer.ban.update');

/************************************************************************************************/
