<?php

use App\Http\Controllers\Admin\AdminProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController as ProductsController;
use App\Http\Controllers\Admin\PostController as PostsController;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

## user login routes
Route::resource('users', UserController::class);
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('users/profile/show', [ProfileController::class, 'index'])->name('users.profile');
    Route::post('users/profile/update', [ProfileController::class, 'updateProfile'])->name('users.profile.update');
    Route::resource('documents', DocumentController::class);
});
Auth::routes();
## user login routes


## admin login routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('post.login');

    Route::middleware('admin.auth')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::resource('customers', CustomerController::class);
        Route::get('profile', [AdminProfileController::class, 'show'])->name('profile');
        Route::post('profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::get('customers/{customer}/documents', [CustomerController::class, 'documents'])->name('customers.documents');
        Route::get('customers/export/data', [CustomerController::class, 'export'])->name('customers.export');
        Route::get('export/documents', [CustomerController::class, 'exportDocuments'])->name('export.user.doc');
    });
});
