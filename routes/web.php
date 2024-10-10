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
    Route::resource('categories', CategoryController::class);

    // Product management routes
    Route::resource('products', ProductController::class);
    
    Route::post('/users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/forceDelete/{id}', [UserController::class, 'forceDelete'])->name('users.forceDelete');
    Route::get('/trashed', [UserController::class, 'trashed'])->name('users.trashed');
});

// User profile route
Route::view('/userprofile', 'userprofile.userprofile')->name('userprofile');

// Profile resource route (limited to update only)
Route::resource('profile', ProfileController::class)->only('update');

Route::get('/', [HomeCategoryController::class, 'index'])->name('home');

// routes/web.php

Route::get('/categories/{id}', [ProductController::class, 'showCategoryProducts'])->name('category.products');

// routes/web.php

Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

