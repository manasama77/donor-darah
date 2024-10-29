<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PoundfitEventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrantController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::post('/', [WelcomeController::class, 'store'])->name('welcome.store');
Route::get('/success/{hash_id}', [WelcomeController::class, 'success'])->name('welcome.success');
Route::get('/download/{hash_id}', [WelcomeController::class, 'download'])->name('welcome.download');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/registrants', [RegistrantController::class, 'index'])->name('registrants');

    Route::resource('/locations', LocationController::class)->names([
        'index'   => 'locations',
        'create'  => 'locations.create',
        'store'   => 'locations.store',
        'edit'    => 'locations.edit',
        'update'  => 'locations.update',
        'destroy' => 'locations.destroy',
    ]);

    Route::resource('/poundfit-events', PoundfitEventController::class)->names([
        'index'   => 'poundfit-events',
        'create'  => 'poundfit-events.create',
        'store'   => 'poundfit-events.store',
        'edit'    => 'poundfit-events.edit',
        'update'  => 'poundfit-events.update',
        'destroy' => 'poundfit-events.destroy',
    ]);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
