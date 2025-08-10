<?php

use App\Http\Controllers\Frontend\Auth\AuthenticateFrontController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('frontend.home.index');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticateFrontController::class, 'login'])->name('frontend.login.index');
    Route::get('/register', [AuthenticateFrontController::class, 'register'])->name('frontend.register.index');
    Route::post('/register/store', [AuthenticateFrontController::class, 'register_store'])->name('frontend.register.store');
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__ . '/auth.php';
