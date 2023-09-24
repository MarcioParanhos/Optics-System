<?php

use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrameController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DailyCashierController;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    // Auth
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Frames
    Route::get('/frames', [FrameController::class, 'index'])->name('frames.show');
    //Brands
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.show');
    Route::post('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::get('/brands/destroy/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
    Route::get('/brands/select/{id}', [BrandController::class, 'select'])->name('brands.select');
    Route::post('/brands/update', [BrandController::class, 'update'])->name('brands.update');
    // Daily cashiers
    Route::get('/daily_cashiers', [DailyCashierController::class, 'index'])->name('daily_cashiers.show');

});

require __DIR__ . '/auth.php';
