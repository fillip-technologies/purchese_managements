<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Users\UserManageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/', [AdminController::class, 'login_admin'])->name('admin');
Route::get('app/user/log',[UserManageController::class, 'UserLog'])->name('user.log');
Route::post('/app/user/login',[UserManageController::class, 'UserLogin'])->name('login.user');
Route::post('login', [LoginController::class, 'login'])->name('login.admin');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('logout', [HomeController::class, 'logout']);

Route::get('/forgot-password', function () {
    return view('reset_password');
})->name('forgot.password');

Route::post('/forgot-password', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
    ]);

    return back()->with('success', 'If an account exists with that email, we have sent a reset link.');
})->name('reset.password');
