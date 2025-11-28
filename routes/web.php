<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CakeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CakeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Cake routes
Route::resource('cakes', CakeController::class);

require __DIR__.'/auth.php';
