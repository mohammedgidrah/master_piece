<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForgetPasswordManeger;
use App\Http\Controllers\HomeCategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('shsmo/{id}', function ($id) {
//     $target = User::find($id);
//     $total = 0;
//     foreach ($target->orders as $value) {
//         # code...
//         if ($value->status == 'Pending') {
//             $total += $value->total_price;
//         }
//     }
//     return $total;
// });
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

    // Order management routes
    route::get('/trashed/orders', [OrderDashboardController::class, 'trashed'])->name('ordersdash.trashed');
    Route::post('/orders/restore/{id}', [OrderDashboardController::class, 'restore'])->name('ordersdash.restore');
    Route::delete('/orders/forceDelete/{id}', [OrderDashboardController::class, 'forceDelete'])->name('ordersdash.forceDelete');

    Route::get('/ordersdash', [OrderDashboardController::class, 'index'])->name('ordersdash.index');
    // Inside the admin dashboard middleware group
    Route::get('/ordersdash/{id}/edit', [OrderDashboardController::class, 'edit'])->name('ordersdash.edit');
    Route::put('/ordersdash/{id}/update-status', [OrderDashboardController::class, 'update'])->name('ordersdash.update');
    Route::delete('/orders/{orderId}', [OrderDashboardController::class, 'destroy'])->name('ordersdash.destroy');

    Route::get('/orders/{id}', [OrderDashboardController::class, 'show'])->name('ordersdash.show');
    Route::delete('/orders/product/{id}', [OrderDashboardController::class, 'deleteProduct'])->name('ordersdash.deleteProduct');

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

Route::get('verify-email/{token}', [RegisterController::class, 'verifyAcount'])->name('verify.email');

 