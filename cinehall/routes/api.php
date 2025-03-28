<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    MovieController,
    ShowtimeController,
    BookingController,
    PaymentController,
    AuthController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Auth routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public routes
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/popular', [MovieController::class, 'popular']);
Route::get('/movies/upcoming', [MovieController::class, 'upcoming']);
Route::get('/movies/{id}', [MovieController::class, 'show']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // User profile
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Bookings
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
    
    // Showtimes
    Route::get('/showtimes', [ShowtimeController::class, 'index']);
    Route::get('/showtimes/{id}', [ShowtimeController::class, 'show']);
    Route::get('/showtimes/{id}/seats', [ShowtimeController::class, 'availableSeats']);
    
    // Payments
    Route::post('/payments/intent', [PaymentController::class, 'createIntent']);
    Route::post('/payments/confirm', [PaymentController::class, 'confirm']);
});

// Admin routes
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('movies', MovieController::class)->except(['index', 'show']);
    Route::apiResource('showtimes', ShowtimeController::class)->except(['index', 'show']);
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/statistics', [AdminController::class, 'statistics']);
});