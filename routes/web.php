<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\OrderController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

// Packages
Route::get('/packages', [PackageController::class, 'index'])->name('packages');
Route::get('/packages/{id}', [PackageController::class, 'show'])->name('packages.show');

// Orders / Booking
Route::get('/booking', [OrderController::class, 'create'])->name('orders.create');
Route::post('/booking', [OrderController::class, 'store'])->name('orders.store');
Route::get('/booking/status', [OrderController::class, 'status'])->name('orders.status');