<?php

use App\Http\Controllers\Admin\Auth\AuthenticateAdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

// Public admin routes (no auth)
Route::get('/login', [AuthenticateAdminController::class, 'showLoginPage'])->name('login');
Route::post('/login', [AuthenticateAdminController::class, 'login'])->name('login.submit');

Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', [AuthenticateAdminController::class, 'logOut'])->name('logout.submit');
    Route::resource('dashboard', DashboardController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubCategoryController::class);
    Route::resource('childcategories', ChildCategoryController::class);
});
