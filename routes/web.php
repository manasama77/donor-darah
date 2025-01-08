<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrantController;
use App\Http\Controllers\DonorDarahEventController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::post('/', [WelcomeController::class, 'store'])->name('welcome.store');
Route::get('/success/{hash_id}', [WelcomeController::class, 'success'])->name('welcome.success');
Route::get('/download/{hash_id}', [WelcomeController::class, 'download'])->name('welcome.download');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/registrants', [RegistrantController::class, 'index'])->name('registrants');
    Route::delete('/registrants/{registrant}', [RegistrantController::class, 'destroy'])->name('registrants.destroy');

    Route::resource('/locations', LocationController::class)->names([
        'index'   => 'locations',
        'create'  => 'locations.create',
        'store'   => 'locations.store',
        'edit'    => 'locations.edit',
        'update'  => 'locations.update',
        'destroy' => 'locations.destroy',
    ]);

    Route::resource('/donor-darah-events', DonorDarahEventController::class)->names([
        'index'   => 'donor-darah-events',
        'create'  => 'donor-darah-events.create',
        'store'   => 'donor-darah-events.store',
        'edit'    => 'donor-darah-events.edit',
        'update'  => 'donor-darah-events.update',
        'destroy' => 'donor-darah-events.destroy',
    ]);

    Route::get('/scan', [ScanController::class, 'index'])->name('scan');
    Route::post('/scan/proses', [ScanController::class, 'cek'])->name('scan.proses');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
