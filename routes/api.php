<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DoctorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('doctors')->group(function () {
        Route::post('add', [DoctorController::class, 'add']);
        Route::post('index', [DoctorController::class, 'index']);
        Route::post('update/{id}', [DoctorController::class, 'update']);
        Route::post('delete/{id}', [DoctorController::class, 'destroy']);
        Route::post('show/{id}', [DoctorController::class, 'show']);
    });
});
