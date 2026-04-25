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
    Route::get('/profile', [UserManageController::class, 'profile'])->name('user.profile');
    Route::post('/profile/update', [UserManageController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/profile/password', [UserManageController::class, 'updatePassword'])->name('user.profile.password.update');
    Route::get('/index/purchese', [PurchesManageController::class, 'indexPurcherReq'])->name('index.purches');
    Route::post('/store/purchese', [PurchesManageController::class, 'storeReq'])->name('store.purches');
    Route::get('/billUpload/form', [PurchesManageController::class, 'billUpload'])->name('billUpload.index');
    Route::get('/edit/bill/{id}', [PurchesManageController::class, 'billedit'])->name('edit.bill');
    Route::get('/delete/bill/{id}', [PurchesManageController::class, 'billdelete'])->name('delete.bill');
    Route::post('/update/bill/{id}', [PurchesManageController::class, 'updateBill'])->name('update.bill');
    Route::post('/store/bills', [PurchesManageController::class, 'storeBill'])->name('store.bills');
    Route::post('/store/dispatch', [PurchesManageController::class, 'Dispatchstore'])->name('store.dispatch');
    Route::post('/store/delivery', [PurchesManageController::class, 'store_Delivery'])->name('store.delivery');
    Route::post('/update/delivery/{id}', [PurchesManageController::class, 'update_Delivery'])->name('update.delivery');
      Route::get('/edit/dilevery/{id}', [PurchesManageController::class, 'edit_Delivery'])->name('edit.delivery');
    Route::get('/dispatch/form', [PurchesManageController::class, 'indexDispatch'])->name('dispatch.index');
    Route::get('/edit/dispatch/{id}',[PurchesManageController::class, 'editdispatch'])->name('edit.dispatche');
    Route::delete('/delete/dispatch/{id}',[PurchesManageController::class, 'deletedispatch'])->name('delete.dispatch');
    Route::delete('/delete/delivery/{id}',[PurchesManageController::class, 'deletedelivery'])->name('delete.delivery');
    Route::post('/updated/dispatch/{id}',[PurchesManageController::class, 'updatedispach'])->name('dispatch.update');
    Route::get('/add/delivery', [PurchesManageController::class, 'add_Delivery'])->name('add.delivery');
});
