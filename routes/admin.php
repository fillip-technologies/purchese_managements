<?php

use App\Http\Controllers\Admin\Purchese\PurchesManageController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/add/vendors', [HomeController::class, 'vendors'])->name('add.vendors');
    Route::get('/add/clients', [HomeController::class, 'clients'])->name('add.clients');
    Route::get('/add/product', [HomeController::class, 'add_product'])->name('add.addproduct');
    Route::get('/add/vendor/product', [HomeController::class, 'vendor_product'])->name('add.vendor.product');
    Route::get('/list/requisition', [PurchesManageController::class, 'listRequisition'])->name('list.requisition');
    Route::get('/list/bills', [PurchesManageController::class, 'listingBill'])->name('list.bills');
    Route::post('/approve/requisition', [PurchesManageController::class, 'approve'])->name('approve.status');
    Route::get('/list/delivery',[PurchesManageController::class,'deliverylist'])->name('list.delivery');
     Route::get('/list/dispatch',[PurchesManageController::class,'dsplist'])->name('list.dispatch');
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/users', [HomeController::class, 'users'])->name('users');

    Route::get('/settings', function () {
        return 'Admin settings page';
    })->name('settings');

});
