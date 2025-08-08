<?php

use Illuminate\Support\Facades\Route;

// Public admin routes (no auth)
// Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');


Route::get('/', function () {
    dd('This is admin panel');
});
