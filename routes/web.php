<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\OrderController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Redirect authenticated users away from login/register
Route::middleware('auth')->group(function () {
    Route::get('/login', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/register', function () {
        return redirect()->route('admin.dashboard');
    });
});

// Logout Route (Authenticated only)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (Authenticated only)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Placeholder routes for future modules
    Route::get('/paket-tour', function () {
        return view('admin.paket-tour');
    })->name('paket-tour');

    Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan');

    // Order Routes
    Route::get('/pesanan/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/pesanan', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/pesanan/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/pesanan/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/pesanan/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/pesanan/{order}/invoice', [OrderController::class, 'showInvoice'])->name('orders.invoice');
    Route::get('/pesanan/{order}/kwitansi', [OrderController::class, 'showKwitansi'])->name('orders.kwitansi');

    Route::get('/invoice', function () {
        return view('admin.invoice');
    })->name('invoice');

    Route::get('/biaya', function () {
        return view('admin.biaya');
    })->name('biaya');

    Route::get('/laporan', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('laporan');
    Route::get('/laporan/print', [\App\Http\Controllers\Admin\ReportController::class, 'print'])->name('laporan.print');

    // Database Routes
    Route::get('/database/download', [\App\Http\Controllers\Admin\DatabaseController::class, 'download'])->name('database.download');

    // Settings Routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/welcome/edit', [\App\Http\Controllers\Admin\SettingsController::class, 'editWelcome'])->name('edit-welcome');
        Route::put('/welcome', [\App\Http\Controllers\Admin\SettingsController::class, 'updateWelcome'])->name('update-welcome');
        Route::get('/logo/edit', [\App\Http\Controllers\Admin\SettingsController::class, 'editLogo'])->name('edit-logo');
        Route::put('/logo', [\App\Http\Controllers\Admin\SettingsController::class, 'updateLogo'])->name('update-logo');
    });
});
