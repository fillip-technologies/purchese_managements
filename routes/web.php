<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FormDataController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderCancelController;
use App\Http\Controllers\OrderSupportController;
use App\Http\Controllers\PriceSettingController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\WishListController;
use Illuminate\Support\Facades\Route;

Route::get('admin', [AdminController::class, 'login_admin'])->name('admin');
Route::post('login', [LoginController::class, 'login'])->name('login.admin');
Route::get('admin/store', [LoginController::class, 'store'])->name('login.store');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware(['admin'])->group(function () {
     Route::get('/add/vendors', [HomeController::class, 'vendors'])->name('add.vendors');
      Route::get('/add/clients', [HomeController::class, 'clients'])->name('add.clients');
      Route::get('/add/product', [HomeController::class, 'add_product'])->name('add.addproduct');
      Route::get('/add/vendor/product', [HomeController::class, 'vendor_product'])->name('add.vendor.product');
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/users', [HomeController::class, 'users'])->name('users');


    Route::get('category', [ProductController::class, 'show_cate'])->name('category');
    Route::delete('category/delete/{id}', [ProductController::class, 'category_delete'])->name('category.delete');
    Route::get('category/edit/{id}', [ProductController::class, 'category_edit'])->name('category.edit');
    Route::post('category/update/{id}', [ProductController::class, 'category_update'])->name('category.update');
    Route::get('list/category', [ProductController::class, 'category_list'])->name('category.listing');
    Route::post('add/product/category', [ProductController::class, 'category_add'])->name('admin.categories.store');
    Route::get('products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('products/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::post('products/update/{id}', [ProductController::class, 'product_update'])->name('admin.product.update');
    Route::get('/product/list', [ProductController::class, 'product_list'])->name('poducts.listing');
    Route::get('/products/add', [ProductController::class, 'create'])->name('admin.venue.add');
    Route::get('product/edit/{id}', [ProductController::class, 'edit_product'])->name('product.edit');
    Route::delete('product/delete/{id}', [ProductController::class, 'delete_product'])->name('product.delete');
    Route::get('/venue/{id}/edit', [VenueController::class, 'edit'])->name('admin.venue.edit');
    Route::put('/venue/{id}', [VenueController::class, 'update'])->name('admin.update');
    Route::delete('/venue/{id}', [VenueController::class, 'destroy'])->name('admin.venue.destroy');
    Route::get('/vendors/create', [VendorController::class, 'create'])->name('admin.vendors.create');
    Route::post('/vendors/add', [VendorController::class, 'store'])->name('admin.vendors.store');
    Route::get('/vendors', [VendorController::class, 'index'])->name('admin.vendors.index');
    Route::get('/vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('admin.vendors.edit');
    Route::put('/vendors/{vendors}', [VendorController::class, 'update'])->name('admin.vendors.update');
    Route::get('/vendorsRegistration', [FormDataController::class, 'indexVendors'])->name('admin.vendorsreg.index');
    Route::get('/contacts', [FormDataController::class, 'indexContacts'])->name('admin.contacts.index');
    Route::get('/meetings', [FormDataController::class, 'indexMeetings'])->name('admin.meetings.index');
    Route::get('/list/users', [ProductController::class, 'listUsers']);
    Route::get('/list/order', [ProductController::class, 'listOrder']);
    Route::get('/get-subcategories/{category_id}', [ProductController::class, 'getSubcategories']);
    Route::get('users/get-message', [MessageController::class, 'getadminmsg'])->name('admin.getmessage');

    Route::get('offer', [ProductController::class, 'offer']);
    Route::get('offer/list', [ProductController::class, 'offer_list'])->name('cupon.list');
    Route::post('add/offer', [HomeController::class, 'addOffer'])->name('admin.coupons.store');
    Route::get('admin/productCustomoze', [LoginController::class, 'allproductCustomoze']);
    Route::post('admin/store/message', [MessageController::class, 'adminStoreMsg'])->name('admin.store.message');
    // Route::get('/users', function () {
    //     return 'This is the admin users list';
    // })->name('users');

    Route::get('/settings', function () {
        return 'Admin settings page';
    })->name('settings');

});

Route::get('/', [HomeController::class, 'homePage'])->name('home');
Route::post('/login_user', [HomeController::class, 'login_user'])->name('login.user');
Route::get('login', [HomeController::class, 'loginPage'])->name('login');
Route::get('logout', [HomeController::class, 'logout']);
Route::get('register', [HomeController::class, 'registerPage'])->name('register');

Route::get('product-details/{slugs}', [HomeController::class, 'productDescriptionPage'])->name('product-details');

Route::get('wishlist', [HomeController::class, 'wishlistPage'])->name('wishlist');

Route::get('cart', [HomeController::class, 'cartPage'])->name('cart');

Route::get('checkout', [HomeController::class, 'checkout'])->name('checkout');

Route::get('complete-order', [HomeController::class, 'completeOrderPage'])->name('complete-order');

Route::get('view-product', [HomeController::class, 'viewProductPage'])->name('view-product');

Route::get('account-overview', [HomeController::class, 'accountOverviewPage'])->name('account-overview');

Route::get('about', [HomeController::class, 'aboutPage'])->name('about');
Route::post('store/user', [HomeController::class, 'store_users'])->name('store.user');
Route::get('shipping', [ShippingController::class, 'index']);
Route::delete('shipping/{id}', [ShippingController::class, 'shipping_delete'])->name('delete_shipping');
Route::post('add/shipping', [ShippingController::class, 'shipping_store'])->name('admin.shipping.store');
Route::get('shipping/list', [ShippingController::class, 'Shipping_list']);
Route::post('shipping/update/{id}', [ShippingController::class, 'update_shipping'])->name('shipping.update');
Route::get('edit/shipoing/{id}', [ShippingController::class, 'shiping_edit'])->name('shipping.edit');
Route::get('/subcat', [ProductController::class, 'subcategory']);
Route::post('add/subcategory', [ProductController::class, 'addSubCate'])->name('add.subcate');
Route::get('list/subcate', [ProductController::class, 'list_subcategory']);
Route::delete('subcate_delete/{id}', [ProductController::class, 'subcate_delete'])->name('delete.subcate');
Route::get('edir_subCate/{id}', [ProductController::class, 'edit_subCate'])->name('edit.subcate');
Route::put('update_subCate/{id}', [ProductController::class, 'update_subCate'])->name('update.subcate');
Route::get('price/create', [PriceSettingController::class, 'price_index']);
Route::post('price/store', [PriceSettingController::class, 'price_store'])->name('price.store');
Route::get('price/list', [PriceSettingController::class, 'price_list'])->name('price.lists');
Route::put('price/update/{id}', [PriceSettingController::class, 'price_update'])->name('price.update');
Route::delete('price/delete/{id}', [PriceSettingController::class, 'price_delete'])->name('price.delete');
Route::get('prices/edit/{id}', [PriceSettingController::class, 'price_edit'])->name('price.edit');
Route::post('add/customise/form', [PriceSettingController::class, 'customization_form'])->name('add.Customization');
Route::get('custom/list', [PriceSettingController::class, 'custom_list'])->name('custom.list');
Route::get('calculate', [PriceSettingController::class, 'calculate'])->name('calculate.price');
Route::get('search/category', [HomeController::class, 'search_category'])->name('search.category');
Route::post('store/wish', [WishListController::class, 'store_wishlist'])->name('store.wishlist');
Route::delete('/wishlist/remove', [WishListController::class, 'remove'])->name('wishlist.remove');
Route::get('forget-pass', [HomeController::class, 'forgetpassword_email'])->name('forget.password');
Route::get('get_forgetpass', [HomeController::class, 'get_forget'])->name('get.forget.pass');
Route::post('reset/password', [HomeController::class, 'resetPassword'])->name('reset.password');
Route::put('/admin/orders/{id}', [HomeController::class, 'paymentupdate'])->name('admin.orders.update');
Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [HomeController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart/delete/{id}', [HomeController::class, 'delete'])->name('cart.delete');
Route::post('buy/now', [HomeController::class, 'BuyNow'])->name('buy.now');
Route::post('order/confirm', [HomeController::class, 'orderConfirm'])->name('order.confirm');
Route::post('/productCustomoze', [LoginController::class, 'productCustomoze'])->name('product.customize');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/searchByCategory', [HomeController::class, 'searchByCategory'])->name('searchByCategory');
Route::post('user/update/address', [HomeController::class, 'updateAddress'])->name('user.update.address');
Route::get('cancel/order', [OrderCancelController::class, 'get_cancel_order'])->name('oreder.cencel');
Route::get('/getsubcateid/{id}', [HomeController::class, 'getBySubcategory']);
Route::get('subcatid/{id}/{slug}', [SubCategoryController::class, 'subcateProduct'])->name('subcategory.show');
Route::post('/order/cancel', [OrderCancelController::class, 'cancelOrder'])->name('order.cancel.submit');
Route::post('store/message', [MessageController::class, 'UerssendMessage'])->name('store.message');
Route::get('/get-messages/{order_id}', [MessageController::class, 'getMessages'])->name('get.messages');

// support

Route::get('/get/sms', [OrderSupportController::class, 'get_msg']);
