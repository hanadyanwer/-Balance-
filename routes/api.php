<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WaterTrackingController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    // User profile
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Search endpoints
    Route::get('/search', [SearchController::class, 'global']);
    Route::get('/search/recipes', [SearchController::class, 'recipes']);
    Route::get('/search/workouts', [SearchController::class, 'workouts']);
    Route::get('/search/tips', [SearchController::class, 'tips']);

    // Water tracking endpoints
    Route::get('/water-tracking/stats', [WaterTrackingController::class, 'getStats']);
    Route::post('/water-tracking', [WaterTrackingController::class, 'store']);
    Route::delete('/water-tracking/{id}', [WaterTrackingController::class, 'destroy']);

    // Admin notifications (for authenticated users accessing admin features)
    Route::middleware('admin')->group(function () {
        Route::get('/notifications', [AdminController::class, 'getNotifications']);
        Route::post('/notifications/{id}/read', [AdminController::class, 'markNotificationAsRead']);
        Route::post('/notifications/read-all', [AdminController::class, 'markAllNotificationsAsRead']);
    });
});
