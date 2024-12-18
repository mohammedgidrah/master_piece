<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\ForgetPasswordManeger;
use App\Http\Controllers\HomeCategoryController;
use App\Http\Controllers\OrderDashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

 
// Home page route
Route::view('/', 'homepage.home')->name('home');

// Login routes
Route::view('/login', 'login.login')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Register route
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Unauthorized page route
Route::view('/unauthorized', 'unauthorized.unauthorized')->name('unauthorized');

// Route group for the dashboard, protected by the 'admin' middleware
Route::middleware(['admin'])->group(function () {

    // Dashboard main route (for admins)
    Route::get('/dashboard', [AdminController::class, 'mainDashboard'])->name('dashboard.maindasboard'); // Correct spelling

    // Status page route
    Route::get('/status', [DashboardController::class, 'index'])->name('status');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.maindasboard');


    // Admin profile page route
    Route::view('/adminprofile', 'dashboard.profile')->name('adminprofile');

    // User management routes
    Route::resource('users', UserController::class);

    // category management routes

    // User management routes

    Route::post('/users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/forceDelete/{id}', [UserController::class, 'forceDelete'])->name('users.forceDelete');
    Route::get('/trashed', [UserController::class, 'trashed'])->name('users.trashed');

    // Product management routes
    route::get('/trashed/products', [ProductController::class, 'trashed'])->name('products.trashed');
    Route::post('/products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/forceDelete/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');

    // Category management routes
    route::get('/trashed/categories', [CategoryController::class, 'trashed'])->name('categories.trashed');
    Route::post('/categories/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/forceDelete/{id}', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

    // Order management routes
    route::get('/trashed/orders', [OrderDashboardController::class, 'trashed'])->name('ordersdash.trashed');
    Route::post('/orders/restore/{id}', [OrderDashboardController::class, 'restore'])->name('ordersdash.restore');
    Route::delete('/orders/forceDelete/{id}', [OrderDashboardController::class, 'forceDelete'])->name('ordersdash.forceDelete');

    Route::get('/ordersdash', [OrderDashboardController::class, 'index'])->name('ordersdash.index');
    // Inside the admin dashboard middleware group
    Route::get('/ordersdash/{id}/edit', [OrderDashboardController::class, 'edit'])->name('ordersdash.edit');
    Route::put('/ordersdash/{id}/update-status', [OrderDashboardController::class, 'update'])->name('ordersdash.update');
    Route::delete('/php /{orderId}', [OrderDashboardController::class, 'destroy'])->name('ordersdash.destroy');

    Route::get('/ordersdash/{id}', [OrderDashboardController::class, 'show'])->name('ordersdash.show');
    Route::delete('/ordersdash/product/{id}', [OrderDashboardController::class, 'deleteProduct'])->name('ordersdash.deleteProduct');

    Route::post('/checkout', [OrderDashboardController::class, 'checkout'])->name('checkout');

    Route::put('/orderItems/{orderItem}', [OrderDashboardController::class, 'update'])->name('orderItems.update');


});
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/store/{id}', [OrderController::class, 'store'])->name('orders.store');
    Route::put('/orders/{id}/update-status', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::post('/checkout/{orderId}', [BillingController::class, 'store'])->name('checkout.store');
    Route::get('/billing/{orderId}/{productId}', [BillingController::class, 'showBillingForm'])->name('billing.create');
    
});
Route::middleware(['web'])->group(function () {
    // Your other routes go here

    // This route will catch all invalid URLs and return the custom 404 page
    Route::fallback(function () {
        return view('errors.404');  // The custom 404 view you created
    });
});
// User profile route
Route::view('/userprofile', 'userprofile.userprofile')->name('userprofile');

// Profile resource route (limited to update only)
Route::resource('profile', ProfileController::class)->only('update');

Route::get('/', [HomeCategoryController::class, 'index'])->name('home');

Route::resource('categories', CategoryController::class);

// Product management routes
Route::resource('products', ProductController::class);

// routes/web.php

Route::get('/categories/{id}', [CategoryController::class, 'showCategoryProducts'])->name('category.products'); // Ensure no middleware is blocking access

// routes/web.php

Route::get('/products/{id}', [ProductController::class, 'show'])->name('show.product');

Route::get('forgot-password', [ForgetPasswordManeger::class, 'forgetPassword'])->name('forget.password');
Route::post('forgot-password', [ForgetPasswordManeger::class, 'forgetPasswordpost'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgetPasswordManeger::class, 'resetPassword'])->name('reset.password');
Route::post('reset-password', [ForgetPasswordManeger::class, 'resetPasswordpost'])->name('reset.password.post');

Route::get('verify-email/{token}', [RegisterController::class, 'verifyAccount'])->name('verify.email');

    
Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

// routes/web.php
// web.php
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
// Route::post('/notifications/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.markRead');
Route::get('/usersnotifications/{id}/{user_id}', [NotificationController::class, 'handleUserProfile'])->name('users.handle');
Route::get('/ordernotifications/{id}/{order_id}', [NotificationController::class, 'handleorder'])->name('orders.handle');
 

Route::get('/navbar', [NavController::class, 'index'])->name('navbar');

Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

