<?php

use App\Http\Controllers\AuthController;
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

Route::view('/home', '/testRole')->name('home');

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('view-login');
    Route::get('/register', [AuthController::class, 'viewRegister'])->name('view-register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/formForgotPassword', [AuthController::class, 'formForgotPassword'])->name('view-forgot-password');
    Route::post('/forgotPassword', [AuthController::class, 'forgotPassword'])->name('post-forgot-password');
    Route::get('/getPassword/{token}', [AuthController::class, 'getPassword'])->name('get-password');
    Route::post('/login', [AuthController::class, 'login'])->name('post-login');
    Route::post('/register', [AuthController::class, 'register'])->name('post-register');
    Route::get('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify-email');
});

Route::prefix('posts')->group(function () {
    Route::get('/', [AuthController::class, 'viewPost'])->name('home-posts');
});

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admin', [AuthController::class, 'viewAdmin'])->name('home-admin');
});

Route::middleware(['isUser'])->group(function () {
    Route::get('user', [AuthController::class, 'viewUser'])->name('home-user');
});
