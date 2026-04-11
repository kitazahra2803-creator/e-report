<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Semua halaman diarahkan ke welcome (one page)
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/beranda', function () {
    return redirect('/');
});

Route::get('/layanan', function () {
    return redirect('/#layanan');
});

Route::get('/tentang', function () {
    return redirect('/#tentang');
});

// REPORT (WAJIB LOGIN)
Route::middleware(['auth'])->group(function () {
    Route::resource('reports', ReportController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';