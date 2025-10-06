<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\DoctorShiftController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('doctors')->group(function () {
        Route::post('store', [DoctorController::class, 'store']);
        Route::post('index', [DoctorController::class, 'index']);
        Route::post('show/{id}', [DoctorController::class, 'show']);
        Route::post('update/{id}', [DoctorController::class, 'update']);
        Route::post('delete/{id}', [DoctorController::class, 'destroy']);

    });
    Route::prefix('shifts')->group(function () {
        Route::post('store', [DoctorShiftController::class, 'store']);
        Route::post('index/{doctor_id}', [DoctorShiftController::class, 'index']);
        Route::post('show', [DoctorShiftController::class, 'show']);
        Route::post('update/{id}', [DoctorShiftController::class, 'update']);
        Route::post('delete/{id}', [DoctorShiftController::class, 'destroy']);
    });
});
