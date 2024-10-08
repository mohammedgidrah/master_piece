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

// Dashboard route handled by AdminController
// This route shows the main dashboard for an admin
Route::get('/dashboard', [AdminController::class, 'mainDashboard'])->name('dashboard.maindasboard');

// Logout route
// This route handles the POST request to logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Login routes
// This route shows the login form
Route::view('/login', 'login.login')->name('login');
// This route handles the POST request to login
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Register route
// This route handles the POST request to register
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Home page route
// This route shows the homepage
Route::view('/', 'homepage.home')->name('home');

// Table route
// This route shows the tables page
// Route::view('/tables', 'dashboard.table')->name('tables');

// Status route (the correct naming for this route)
// This route shows the status page
Route::view('/status', 'dashboard.statestic')->name('status');
// This route shows the admin profile page
Route::view('/adminprofile', 'dashboard.profile')->name('adminprofile');
// This route shows the user profile page
Route::view('/userprofile', 'userprofile.userprofile')->name('userprofile');
 


Route::resource('users', UserController::class);

Route::resource('profile', ProfileController::class)->only('update');

