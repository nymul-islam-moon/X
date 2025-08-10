<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\Auth\AuthenticateAdminController;
use Illuminate\Support\Facades\Route;

// Public admin routes (login)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthenticateAdminController::class, 'showLoginPage'])->name('login.index');
    Route::post('/login', [AuthenticateAdminController::class, 'login'])->name('login.submit');
});

// Protected admin routes (all other admin routes)
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::post('/logout', [AuthenticateAdminController::class, 'logOut'])->name('logout.submit');

    Route::resource('dashboard', DashboardController::class);
    Route::resource('users', AdminController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubCategoryController::class);
    Route::resource('childcategories', ChildCategoryController::class);
});
