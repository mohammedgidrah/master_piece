<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeCategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ForgetPasswordManeger;

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
    Route::view('/status', 'dashboard.statestic')->name('status');

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
    
});
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/store/{id}', [OrderController::class, 'store'])->name('orders.store');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    
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
// Route::post('forgotpassword', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route::get('resetpassword/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('resetpassword', [ResetPasswordController::class, 'reset'])->name('password.update');