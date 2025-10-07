<?php

use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CaptchaController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\DoctorShiftController;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\TokenController;
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
    Route::prefix('patients')->group(function () {
        Route::post('store', [PatientController::class, 'store']);
        Route::post('index', [PatientController::class, 'index']);
        Route::post('show/{id}', [PatientController::class, 'show']);
        Route::post('update/{id}', [PatientController::class, 'update']);
        Route::post('delete/{id}', [PatientController::class, 'destroy']);
    });
    Route::prefix('appointments')->group(function () {
        Route::post('index', [AppointmentController::class, 'index']);
        Route::post('store', [AppointmentController::class, 'store']);
        Route::post('show/{id}', [AppointmentController::class, 'show']);
        Route::post('update/{id}', [AppointmentController::class, 'update']);
        Route::post('delete/{id}', [AppointmentController::class, 'destroy']);
    });
});



Route::get('/captcha/generate', [CaptchaController::class, 'generate']);
Route::post('/token/request', [TokenController::class, 'create']);

Route::middleware('check.submit.token')->group(function () {
    Route::prefix('patient')->group(function () {
        Route::post('/patients/store', [PatientController::class, 'store']);
        Route::post('/appointments/store', [AppointmentController::class, 'store']);
        Route::post('/doctors/index', [DoctorController::class, 'index']);
    });
});
