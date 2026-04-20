<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\AdminDesa\DashboardController as AdminDesaDashboardController;
use App\Http\Controllers\AdminDesa\ReportController as AdminDesaReportController; // TAMBAHKAN INI

// ROUTE ADMIN KECAMATAN
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::patch('/reports/{id}/status', [AdminReportController::class, 'updateStatus'])->name('admin.reports.updateStatus');
    Route::get('/reports/{id}', [AdminReportController::class, 'show'])->name('admin.reports.show');
});

// ROUTE ADMIN DESA
Route::prefix('admin-desa')->middleware(['auth', 'admin_desa'])->group(function () {
    Route::get('/dashboard', [AdminDesaDashboardController::class, 'index'])->name('admin-desa.dashboard');
    Route::get('/reports/{id}', [AdminDesaReportController::class, 'show'])->name('admin-desa.reports.show');
    Route::patch('/reports/{id}/status', [AdminDesaReportController::class, 'updateStatus'])->name('admin-desa.reports.updateStatus'); // TAMBAHKAN INI
});
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/beranda', function () {
    return redirect('/');
});

Route::get('/layanan', function () {
    return redirect('/');
});

Route::get('/tentang', function () {
    return redirect('/');
});

Route::get('/dashboard', [App\Http\Controllers\ReportController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/reports/success/{id}', [ReportController::class, 'success'])
    ->name('reports.success');

// REPORT
Route::middleware(['auth'])->group(function () {
    Route::resource('reports', ReportController::class);
});

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';