<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Thank You
Route::get('/thankyou', [CheckoutController::class, 'thankyou'])->name('thankyou');

// Contact
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/signin', [AuthController::class, 'showSignin'])->name('signin');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin', [AuthController::class, 'adminLogin'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');

// Admin Routes (authentication handled in AdminController constructor)
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
Route::get('/admin/products/{id}', [AdminController::class, 'getProduct'])->name('admin.products.get');
Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
Route::delete('/admin/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
Route::get('/admin/menus/{id}', [AdminController::class, 'getMenu'])->name('admin.menus.get');
Route::put('/admin/menus/{id}', [AdminController::class, 'updateMenu'])->name('admin.menus.update');
Route::delete('/admin/menus/{id}', [AdminController::class, 'deleteMenu'])->name('admin.menus.delete');
Route::post('/admin/orders/{id}/complete', [AdminController::class, 'completeOrder'])->name('admin.orders.complete');
Route::get('/admin/orders/{id}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');