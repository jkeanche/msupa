<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\Vendor\ProductController as VendorProductController;
use App\Http\Controllers\Vendor\OrderController as VendorOrderController;
use App\Http\Controllers\Vendor\CouponController as VendorCouponController;
use App\Http\Controllers\Vendor\WithdrawalController as VendorWithdrawalController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\WalletController;
use App\Http\Controllers\User\OrderController as UserOrderController;
// use App\Http\Controllers\StoreController;
// use App\Http\Controllers\CategoryController;


// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::resource('categories', 'CategoryController')->only(['index', 'show']);
// Route::resource('stores', 'StoreController')->only(['index', 'show']);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
// Route::get('/stores/featured', [StoreController::class, 'featured'])->name('stores.featured');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon.apply');
Route::delete('/cart/coupon', [CartController::class, 'removeCoupon'])->name('cart.coupon.remove');

// Authentication Routes
// Auth::routes(['verify' => true]);

// Custom Authentication Routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Password Reset Routes
Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

// Email Verification Routes
Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

// Protected routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Home route (redirect after login)
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    
    // User routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/orders', [UserOrderController::class, 'index'])->name('orders');
        Route::get('/orders/{id}', [UserOrderController::class, 'show'])->name('orders.show');
        Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');
        Route::post('/wallet/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');
    });
    
    // Vendor routes
    Route::prefix('vendor')->name('vendor.')->middleware('role:supermarket_owner')->group(function () {
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', VendorProductController::class);
        Route::resource('orders', VendorOrderController::class);
        Route::resource('coupons', VendorCouponController::class);
        Route::get('/withdrawals', [VendorWithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::post('/withdrawals', [VendorWithdrawalController::class, 'store'])->name('withdrawals.store');
    });
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

        Route::resource('users', 'UserController');
        Route::resource('stores', 'StoreController'); 
        Route::resource('products', 'ProductController');
        Route::resource('orders', 'OrderController');
        Route::resource('coupons', 'CouponController');
        Route::resource('withdrawals', 'WithdrawalController');
        Route::resource('categories', 'CategoryController');
        Route::resource('settings', 'SettingsController');
        Route::resource('reports', 'ReportController');
        Route::resource('notifications', 'NotificationController');
        Route::resource('roles', 'RoleController');
        Route::resource('banners', 'BannerController');
        // Add other admin routes as needed
    });
});