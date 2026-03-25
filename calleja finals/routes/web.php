<?php

use App\Http\Controllers\BuyerAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Seller\AuthController as SellerAuthController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Seller\InventoryController as SellerInventoryController;
use App\Http\Controllers\Seller\ReportController as SellerReportController;
use App\Http\Controllers\Seller\StorefrontController as SellerStorefrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/storefront', [ShopController::class, 'storefront'])->name('shop.storefront');
Route::get('/products', [ShopController::class, 'products'])->name('shop.products');

Route::middleware('guest')->group(function () {
    Route::get('/login', [BuyerAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [BuyerAuthController::class, 'login']);
    Route::get('/register', [BuyerAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [BuyerAuthController::class, 'register']);
});

Route::post('/logout', [BuyerAuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'buyer'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/items/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/items/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::prefix('seller')->name('seller.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [SellerAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [SellerAuthController::class, 'login']);
    });

    Route::middleware(['auth', 'seller'])->group(function () {
        Route::post('/logout', [SellerAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');
        Route::get('/storefront', [SellerStorefrontController::class, 'edit'])->name('storefront.edit');
        Route::put('/storefront', [SellerStorefrontController::class, 'update'])->name('storefront.update');
        Route::get('/reports', [SellerReportController::class, 'index'])->name('reports.index');
        Route::resource('inventory', SellerInventoryController::class)->except(['show'])->parameters(['inventory' => 'product']);
    });
});
