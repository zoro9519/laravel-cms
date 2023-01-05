<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// FrontEnd Routes
Route::get('/', [HomeController::class, 'index'])->name('webhome');
Route::get('/post/{slug}', [HomeController::class, 'getPostBySlug'])->name('post.show');
Route::get('/category/{slug}', [HomeController::class, 'getCategoryBySlug'])->name('category.show');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::name('admin.')->prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/category/slug-get', [CategoryController::class, 'getSlug'])->name('category.getslug');
    Route::resource('/category', CategoryController::class);
    Route::get('/post/slug-get', [PostController::class, 'getSlug'])->name('post.getslug');
    Route::resource('/post', PostController::class);
});

require __DIR__ . '/auth.php';
