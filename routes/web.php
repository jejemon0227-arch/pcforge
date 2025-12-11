<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactMessageController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [UserController::class, 'home'])->name('index');

Route::get('/product_details/{id}', [UserController::class, 'productDetails'])->name('product_details');
Route::get('/allproducts', [UserController::class, 'allProducts'])->name('viewallproducts');
Route::get('/shop', [UserController::class, 'allProducts'])->name('shop');

Route::get('/why-us', [UserController::class, 'whyUs'])->name('whyus');
Route::get('/contact-us', [UserController::class, 'contactForm'])->name('contact.form');
Route::post('/contact-us', [UserController::class, 'submitContact'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/myorders', [UserController::class, 'myOrders'])->name('myorders');

    // CART
    Route::post('/addtocart/{id}', [UserController::class, 'addToCart'])->name('add_to_cart');
    Route::patch('/update-cart-quantity/{cart_id}', [UserController::class, 'updateCartQuantity'])->name('update_cart_quantity');
    Route::get('/cartproducts', [UserController::class, 'cartProducts'])->name('cartproducts');
    Route::get('/removecartproducts/{id}', [UserController::class, 'removeCartProducts'])->name('removecartproducts');
    Route::post('/confirm_order', [UserController::class, 'confirmOrder'])->name('confirm_order');


    

    // STRIPE
    Route::get('/stripe/{price}', [UserController::class, 'stripe'])->name('stripe');
    Route::post('/stripe', [UserController::class, 'stripePost'])->name('stripe.post');
});

/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (NO PREFIX, DEFAULT STYLE)
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    // USERS
    Route::get('/view_users', [AdminController::class, 'viewUsers'])->name('admin.viewusers');
    Route::get('/user_details/{id}', [AdminController::class, 'userDetails'])->name('admin.userdetails');

    // CATEGORY
    Route::get('/add_category', [AdminController::class, 'addCategory'])->name('admin.addcategory');
    Route::post('/add_category', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');

    Route::get('/view_category', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');

    Route::get('/delete_category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categorydelete');
    Route::get('/update_category/{id}', [AdminController::class, 'updateCategory'])->name('admin.categoryupdate');
    Route::post('/update_category/{id}', [AdminController::class, 'postUpdateCategory'])->name('admin.postupdatecategory');

    // PRODUCT
    Route::get('/add_product', [AdminController::class, 'addProduct'])->name('admin.addproduct');
    Route::post('/add_product', [AdminController::class, 'postAddProduct'])->name('admin.postaddproduct');

    Route::get('/view_product', [AdminController::class, 'viewProduct'])->name('admin.viewproduct');
    Route::get('/delete_product/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteproduct');

    Route::get('/updateproduct/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateproduct');
    Route::post('/updateproduct/{id}', [AdminController::class, 'postUpdateProduct'])->name('admin.postupdateproduct');

    Route::any('/searchproduct', [AdminController::class, 'searchProduct'])->name('admin.searchproduct');

    // ORDERS
    Route::get('/vieworders', [AdminController::class, 'viewOrders'])->name('admin.view_orders');
    Route::post('/change_status/{id}', [AdminController::class, 'changeStatus'])->name('admin.change_status');
    Route::get('/downloadpdf/{id}', [AdminController::class, 'downloadPDF'])->name('admin.downloadpdf');
    Route::get('/admin/messages', [AdminController::class, 'messages'])
    ->name('admin.messages');


    Route::get('/contact_messages', [AdminController::class, 'viewContactMessages'])
    ->name('admin.contact_messages');
    Route::post('/contact-messages/reply/{id}', [ContactMessageController::class, 'sendReply'])
    ->name('admin.reply_message');
});

require __DIR__.'/auth.php';
