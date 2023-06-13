<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::view('/home', '/welcome')->name('home');

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('view-login');
    Route::get('/register', [AuthController::class, 'viewRegister'])->name('view-register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/formForgotPassword', [AuthController::class, 'formForgotPassword'])->name('forgot-password');
    Route::post('/forgotPassword', [AuthController::class, 'forgotPassword'])->name('send-email-forgot-password');
    Route::get('/getPassword/{token}', [AuthController::class, 'getPassword'])->name('get-password');

    Route::post('/login', [AuthController::class, 'login'])->name('post-login');
    Route::post('/register', [AuthController::class, 'register'])->name('post-register');
    Route::get('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify-email');

    Route::get('/check', [AuthController::class, 'check'])->name('check');
});
