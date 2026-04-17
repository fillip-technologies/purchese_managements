<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Users\UserManageController;
use Illuminate\Support\Facades\Route;



Route::get('/', [AdminController::class, 'login_admin'])->name('admin');
Route::get('app/user/log',[UserManageController::class, 'UserLog'])->name('user.log');
Route::post('/app/user/login',[UserManageController::class, 'UserLogin'])->name('login.user');
Route::post('login', [LoginController::class, 'login'])->name('login.admin');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('logout', [HomeController::class, 'logout']);
