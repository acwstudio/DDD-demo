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


use App\Http\AdminPanel\AdminMenuController;
use App\Http\AdminPanel\Admins\Controllers\AdminListController;
use App\Http\AdminPanel\Admins\Controllers\AdminLoginController;
use App\Http\AdminPanel\Admins\Controllers\AdminLogoutController;
use App\Http\AdminPanel\Admins\Controllers\AdminRegisterController;
use App\Http\AdminPanel\Admins\Controllers\AdminResetPasswordController;
use App\Http\AdminPanel\Dashboard\Controllers\DashboardHomeController;

Route::get('/', [DashboardHomeController::class, 'showHomePage'])->name('dashboard.home');
Route::get('admins', [AdminListController::class, 'showList'])->name('admin.list');

/**************************************
 ******* Authentication Routes ********
 **************************************/

//Login Routes
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminLoginController::class, 'login'])->name('admin');

//Logout Routes
Route::post('/logout', [AdminLogoutController::class, 'logout'])->name('admin.logout');

//Register Routes
Route::get('/register', [AdminRegisterController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/register', [AdminRegisterController::class, 'register']);

//Reset Password Routes
Route::get('/password/reset/show/{id}', [AdminResetPasswordController::class, 'showResetForm'])
    ->name('admin.password.reset');
Route::put('/password/reset/{id}', [AdminResetPasswordController::class, 'reset'])
    ->name('admin.password.update');
