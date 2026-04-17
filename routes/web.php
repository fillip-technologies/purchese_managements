<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::post('login', [LoginController::class, 'login'])->name('login.admin');
Route::get('admin/store', [LoginController::class, 'store'])->name('login.store');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::get('/', [AdminController::class, 'login_admin'])->name('admin');
Route::post('/login_user', [HomeController::class, 'login_user'])->name('login.user');
Route::get('login', [HomeController::class, 'loginPage'])->name('login');
Route::get('logout', [HomeController::class, 'logout']);
Route::get('register', [HomeController::class, 'registerPage'])->name('register');




