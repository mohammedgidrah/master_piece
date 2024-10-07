<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

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

// Dashboard route handled by AdminController
Route::get('/dashboard', [AdminController::class, 'mainDashboard'])->name('dashboard.maindasboard');

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Login routes
Route::view('/login', 'login.login')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit'); // Handle login submission

// Register route
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Home page route
Route::view('/', 'homepage.home')->name('home');

// Table route
Route::view('/tables', 'dashboard.table')->name('tables');

// Status route (the correct naming for this route)
Route::view('/status', 'dashboard.statestic')->name('status');
Route::view('/adminprofile', 'dashboard.profile')->name('adminprofile');
Route::view('/userprofile', 'userprofile.userprofile')->name('userprofile');

Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
