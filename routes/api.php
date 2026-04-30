<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\MidtransController;

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\Api\Admin\PackageImageController as AdminPackageImageController;
use App\Http\Controllers\Api\Admin\EventController as AdminEventController;
use App\Http\Controllers\Api\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Api\Admin\GalleryController as AdminGalleryController;

// PUBLIC ROUTES
Route::get('/packages', [PackageController::class, 'index']);
Route::get('/packages/{id}', [PackageController::class, 'show']);
Route::get('/events', [EventController::class, 'index']);
Route::get('/galleries', [GalleryController::class, 'index']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/{code}', [BookingController::class, 'show']);
Route::post('/midtrans/callback', [MidtransController::class, 'callback']);

// ADMIN AUTH
Route::post('/auth/login', [AuthController::class, 'login']);

// PROTECTED ROUTES
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    
    Route::apiResource('/admin/packages', AdminPackageController::class)->names([
        'index'   => 'admin.packages.index',
        'store'   => 'admin.packages.store',
        'show'    => 'admin.packages.show',
        'update'  => 'admin.packages.update',
        'destroy' => 'admin.packages.destroy',
    ]);
    Route::post('/admin/packages/{id}/images', [AdminPackageImageController::class, 'store']);
    Route::delete('/admin/package-images/{id}', [AdminPackageImageController::class, 'destroy']);
    
    Route::apiResource('/admin/events', AdminEventController::class)->names([
        'index'   => 'admin.events.index',
        'store'   => 'admin.events.store',
        'show'    => 'admin.events.show',
        'update'  => 'admin.events.update',
        'destroy' => 'admin.events.destroy',
    ]);
    
    Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/admin/bookings/{id}', [AdminBookingController::class, 'show'])->name('admin.bookings.show');
    
    Route::apiResource('/admin/galleries', AdminGalleryController::class)->except(['show', 'update'])->names([
        'index'   => 'admin.galleries.index',
        'store'   => 'admin.galleries.store',
        'destroy' => 'admin.galleries.destroy',
    ]);
});
