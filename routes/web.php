<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('view.login');
    Route::post('/login', [AuthController::class, 'login'])->name('post.login');
    Route::get('/register', [AuthController::class, 'viewRegister'])->name('view.register');
    Route::post('/register', [AuthController::class, 'register'])->name('post.register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/formForgotPassword', [AuthController::class, 'formForgotPassword'])->name('view.forgot.password');
    Route::post('/forgotPassword', [AuthController::class, 'forgotPassword'])->name('post.forgot.password');
    Route::get('/getPassword/{token}', [AuthController::class, 'getPassword'])->name('get.password');
    Route::get('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');
});

Route::get('/', [PostController::class, 'allBlogPublic'])->name('blogs.home');
Route::get('/search', [PostController::class, 'allBlogPublic'])->name('blogs.search');
Route::get('/category', [PostController::class, 'allBlogPublic'])->name('blogs.category');
Route::get('/blogs/{blog}/details', [PostController::class, 'detail'])->name('blog.detail');
Route::post('/blogs/{blog}/comments', [CommentController::class, 'create'])->name('blog.comment');

Route::prefix('blogs')->group(function () {
    Route::get('create', [PostController::class, 'create'])->name('view.create.blog');
    Route::post('store', [PostController::class, 'store'])->name('post.create.blog');
    Route::get('/{blog}/edit', [PostController::class, 'edit'])->name('view.update.blog');
    Route::put('/{blog}/update', [PostController::class, 'update'])->name('put.update.blog');
    Route::delete('/{blog}/delete', [PostController::class, 'destroy'])->name('delete.blog');
});
