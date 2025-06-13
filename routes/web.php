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
use App\Http\Controllers\Vendor\InventoryController as VendorInventoryController;
use App\Http\Controllers\Vendor\CategoryController as VendorCategoryController;
use App\Http\Controllers\Vendor\CustomerController as VendorCustomerController;
use App\Http\Controllers\Vendor\DeliveryController as VendorDeliveryController;
use App\Http\Controllers\Vendor\PromotionController as VendorPromotionController;
use App\Http\Controllers\Vendor\FeaturedController as VendorFeaturedController;
use App\Http\Controllers\Vendor\PaymentController as VendorPaymentController;
use App\Http\Controllers\Vendor\SubscriptionController as VendorSubscriptionController;
use App\Http\Controllers\Vendor\ReportController as VendorReportController;
use App\Http\Controllers\Vendor\SettingController as VendorSettingController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\WalletController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StoreController as AdminStoreController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\WithdrawalController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\FeaturedController as AdminFeaturedController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\AnalyticsController as AdminAnalyticsController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('categories', CategoryController::class)->only(['index', 'show']);
Route::resource('stores', StoreController::class)->only(['index', 'show']);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/skiza-tunes', [App\Http\Controllers\SkizaTuneController::class, 'index'])->name('skiza-tunes.index');
Route::get('/skiza-tunes/{id}', [App\Http\Controllers\SkizaTuneController::class, 'show'])->name('skiza-tunes.show');

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
        Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/orders', [UserOrderController::class, 'index'])->name('orders');
        Route::get('/orders/{id}', [UserOrderController::class, 'show'])->name('orders.show');
        Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');
        Route::post('/wallet/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');
    });
    
    // Vendor routes
    Route::prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', VendorProductController::class);
        Route::resource('orders', VendorOrderController::class);
        
        // Order status routes
        Route::get('/orders/status/{status}', [VendorOrderController::class, 'index'])->name('orders.status');
        Route::get('/orders/status/pending', [VendorOrderController::class, 'index'])->name('orders.pending')->defaults('status', 'pending');
        Route::get('/orders/status/processing', [VendorOrderController::class, 'index'])->name('orders.processing')->defaults('status', 'processing');
        Route::get('/orders/status/shipped', [VendorOrderController::class, 'index'])->name('orders.shipped')->defaults('status', 'shipped');
        Route::get('/orders/status/delivered', [VendorOrderController::class, 'index'])->name('orders.delivered')->defaults('status', 'delivered');
        Route::get('/orders/status/cancelled', [VendorOrderController::class, 'index'])->name('orders.cancelled')->defaults('status', 'cancelled');
        
        Route::patch('/orders/{order}/update-status', [VendorOrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::get('/orders/{order}/invoice', [VendorOrderController::class, 'invoice'])->name('orders.invoice');
        Route::resource('coupons', VendorCouponController::class);
        Route::resource('withdrawals', VendorWithdrawalController::class);
        Route::resource('inventory', VendorInventoryController::class);
        Route::resource('categories', VendorCategoryController::class);
        Route::resource('customers', VendorCustomerController::class);
        Route::resource('deliveries', VendorDeliveryController::class);
        Route::patch('/deliveries/{delivery}/update-status', [VendorDeliveryController::class, 'updateStatus'])->name('deliveries.update_status');
        Route::resource('promotions', VendorPromotionController::class);
        Route::resource('featured', VendorFeaturedController::class);
        Route::resource('payments', VendorPaymentController::class);
        Route::resource('subscription', VendorSubscriptionController::class);
        Route::resource('reports', VendorReportController::class);
        Route::resource('settings', VendorSettingController::class);
    });
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('stores', AdminStoreController::class); 
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);
        Route::get('/orders/export', [OrderController::class, 'export'])->name('orders.export');
        Route::resource('coupons', CouponController::class);
        Route::resource('withdrawals', WithdrawalController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('settings', SettingsController::class);
        Route::resource('reports', ReportController::class);
        Route::resource('notifications', NotificationController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('featured', AdminFeaturedController::class);
        Route::resource('promotions', AdminPromotionController::class);
        Route::resource('analytics', AdminAnalyticsController::class);
        Route::resource('payments', AdminPaymentController::class);
        Route::resource('subscriptions', AdminSubscriptionController::class);
        Route::get('/subscriptions/export', [AdminSubscriptionController::class, 'export'])->name('subscriptions.export');
        Route::resource('skiza-tunes', App\Http\Controllers\Admin\SkizaTuneController::class);
        // Add other admin routes as needed
    });
});

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    // Admin Routes
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });

    // Vendor Routes
    Route::group(['prefix' => 'vendor', 'as' => 'vendor.'], function () {
        Route::get('/dashboard', function () {
            return view('vendor.dashboard');
        })->name('dashboard');
    });

    // User Routes
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('orders', OrderController::class);
});