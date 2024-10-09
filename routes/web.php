<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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
});

// User profile route
Route::view('/userprofile', 'userprofile.userprofile')->name('userprofile');

// Profile resource route (limited to update only)
Route::resource('profile', ProfileController::class)->only('update');
