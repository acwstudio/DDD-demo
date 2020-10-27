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

use App\Http\AdminPanel\AdminHomeController;
use App\Http\AdminPanel\Admins\Controllers\AdminLoginController;

Route::get('/', [AdminHomeController::class, 'showHomePage']);

/**************************************
 ******* Authentication Routes ********
 **************************************/

//Login Routes
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminLoginController::class, 'login'])->name('admin');

