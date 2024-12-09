<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FareController;
use App\Http\Controllers\Api\FareLocationController;
use App\Http\Controllers\Api\FareCollectionController;
use App\Http\Controllers\Api\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    // Authenticated routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // User routes
    Route::apiResource('/users', UserController::class);

    // Fare-related routes
    Route::apiResource('/fares', FareController::class);
    Route::apiResource('/fare-locations', FareLocationController::class);
    Route::apiResource('/fare-collections', FareCollectionController::class);

    // Report routes
    Route::apiResource('/reports', ReportController::class);
});

// Public routes
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
