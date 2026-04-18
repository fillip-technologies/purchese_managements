<?php

use App\Http\Controllers\Admin\Purchese\PurchesManageController;
use App\Http\Controllers\Users\UserManageController;
use Illuminate\Support\Facades\Route;

Route::prefix('app/users')->middleware('user')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('user.dashboard');
    Route::get('pdf/item/list/{id}', [PurchesManageController::class, 'purchasePdf'])->name('pdf.item.list');
    Route::get('/logout', [UserManageController::class, 'Userlogout'])->name('user.logout');
    Route::get('/index/purchese', [PurchesManageController::class, 'indexPurcherReq'])->name('index.purches');
    Route::post('/store/purchese', [PurchesManageController::class, 'storeReq'])->name('store.purches');
    Route::get('/billUpload/form',[PurchesManageController::class, 'billUpload'])->name('billUpload.index');
     Route::post('/store/bills', [PurchesManageController::class, 'storeBill'])->name('store.bills');
});
