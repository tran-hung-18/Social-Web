<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
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
Route::prefix('auth')->middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('view.login');
    Route::post('/login', [AuthController::class, 'login'])->name('post.login');
    Route::get('/register', [AuthController::class, 'viewRegister'])->name('view.register');
    Route::post('/register', [AuthController::class, 'register'])->name('post.register');
    Route::get('/formForgotPassword', [AuthController::class, 'formForgotPassword'])->name('view.forgot.password');
    Route::post('/forgotPassword', [AuthController::class, 'forgotPassword'])->name('post.forgot.password');
    Route::get('/getPassword/{token}', [AuthController::class, 'getPassword'])->name('get.password');
    Route::get('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [PostController::class, 'allBlogPublic'])->name('blogs.home');
Route::post('likes/{idBlog}', [LikeController::class, 'interactive'])->name('interactive');

Route::group(['as' => 'blog.', 'prefix' => 'blogs'],function () {
    Route::get('/search', [PostController::class, 'allBlogPublic'])->name('search');
    Route::get('/category', [PostController::class, 'allBlogPublic'])->name('category');
    Route::get('/{blog}/details', [PostController::class, 'detail'])->name('detail');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::get('/{blog}/edit', [PostController::class, 'edit'])->name('edit');
    Route::put('/{blog}/update', [PostController::class, 'update'])->name('update');
    Route::delete('/{blog}/delete', [PostController::class, 'destroy'])->name('delete');    
});

Route::group(['as' => 'comment.', 'prefix' => 'comments'],function () {
    Route::post('{blog}/comment', [CommentController::class, 'create'])->name('store');
    Route::put('{comment}/update', [CommentController::class, 'update'])->name('update');
    Route::delete('{comment}/delete', [CommentController::class, 'destroy'])->name('delete');
});
