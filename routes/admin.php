<?php

use App\Http\Controllers\Admin\Auth\AuthenticateAdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

// Public admin routes (no auth)
Route::get('/login', [AuthenticateAdminController::class, 'showLoginPage'])->name('login');
// Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');


Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubCategoryController::class);
Route::resource('childcategories', ChildCategoryController::class);