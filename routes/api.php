<?php

use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CaptchaController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\DoctorShiftController;
use App\Http\Controllers\API\LabTestController;
use App\Http\Controllers\API\MedicalRecordController;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\PrescriptionController;
use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VisitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/send-code', [AuthController::class, 'sendCode']);
Route::post('/verify-code', [AuthController::class, 'verifyCode']);


Route::middleware('auth:sanctum')->group(function () {
    Route::middleware(['check.role:0'])->group(function () {
        Route::prefix('users')->group(function () {
            Route::post('/', [UserController::class, 'store']);
            Route::get('/', [UserController::class, 'index']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::delete('/{id}', [UserController::class, 'destroy']);
        });
        Route::prefix('doctors')->group(function () {
            Route::get('/', [DoctorController::class, 'index']);          // لیست همه پزشکان
            Route::post('/', [DoctorController::class, 'store']);         // ایجاد پزشک جدید
            Route::get('/{id}', [DoctorController::class, 'show']);       // نمایش جزئیات پزشک
            Route::put('/{id}', [DoctorController::class, 'update']);     // ویرایش پزشک
            Route::delete('/{id}', [DoctorController::class, 'destroy']); // حذف پزشک
        });
        Route::prefix('shifts')->group(function () {
            Route::get('/{doctor_id}', [DoctorShiftController::class, 'index']); // لیست شیفت‌های یک پزشک
            Route::post('/', [DoctorShiftController::class, 'store']);                  // ایجاد شیفت جدید
            Route::get('/{id}/{day}', [DoctorShiftController::class, 'show']);                // نمایش جزئیات شیفت
            Route::put('/{id}', [DoctorShiftController::class, 'update']);              // ویرایش شیفت
            Route::delete('/{id}', [DoctorShiftController::class, 'destroy']);          // حذف شیفت
        });
        Route::prefix('patients')->group(function () {
            Route::get('/', [PatientController::class, 'index']);          // لیست بیماران
            Route::post('/', [PatientController::class, 'store']);         // ایجاد بیمار جدید
            Route::get('/{id}', [PatientController::class, 'show']);       // نمایش جزئیات بیمار
            Route::put('/{id}', [PatientController::class, 'update']);     // ویرایش بیمار
            Route::delete('/{id}', [PatientController::class, 'destroy']); // حذف بیمار
        });
        Route::prefix('appointments')->group(function () {
            Route::get('/', [AppointmentController::class, 'index']);         // لیست نوبت‌ها
            Route::post('/', [AppointmentController::class, 'store']);        // ثبت نوبت جدید
            Route::get('/{id}', [AppointmentController::class, 'show']);      // نمایش جزئیات نوبت
            Route::put('/{id}', [AppointmentController::class, 'update']);    // ویرایش نوبت
            Route::delete('/{id}', [AppointmentController::class, 'destroy']); // حذف نوبت
        });
        Route::prefix('medical-records')->group(function () {
            Route::post('/', [MedicalRecordController::class, 'store']);
            Route::get('/', [MedicalRecordController::class, 'index']);
            Route::get('/{id}', [MedicalRecordController::class, 'show']);
            Route::put('/{id}', [MedicalRecordController::class, 'update']);
            Route::delete('/{id}', [MedicalRecordController::class, 'destroy']);
        });
        Route::prefix('visits')->group(function () {
            Route::post('/', [VisitController::class, 'store']);
            Route::get('/{record_id?}', [VisitController::class, 'index']);
            Route::get('/{id}', [VisitController::class, 'show']);
            Route::put('/{id}', [VisitController::class, 'update']);
            Route::delete('/{id}', [VisitController::class, 'destroy']);
        });
        Route::prefix('prescriptions')->group(function () {
            Route::post('/', [PrescriptionController::class, 'store']);
            Route::get('/{record_id?}', [PrescriptionController::class, 'index']);
            Route::get('/{id}', [PrescriptionController::class, 'show']);
            Route::put('/{id}', [PrescriptionController::class, 'update']);
            Route::delete('/{id}', [PrescriptionController::class, 'destroy']);
        });
        Route::prefix('lab-tests')->group(function () {
            Route::post('/', [LabTestController::class, 'store']);
            Route::get('/{record_id?}', [LabTestController::class, 'index']);
            Route::get('/{id}', [LabTestController::class, 'show']);
            Route::put('/{id}', [LabTestController::class, 'update']);
            Route::delete('/{id}', [LabTestController::class, 'destroy']);
        });
    });
    Route::middleware(['check.role:0'])->group(function () {
        Route::prefix('patient')->group(function () {
            Route::prefix('user')->group(function () {
                Route::put('/', [UserController::class, 'patient_update']);
                Route::get('/', [UserController::class, 'patient_show']);
                Route::post('/', [PatientController::class, 'store']);
                Route::get('/patient', [PatientController::class, 'patient_index']);
            });
            Route::prefix('doctors')->group(function () {
                Route::get('/', [DoctorController::class, 'index']);
                Route::get('/{id}', [DoctorController::class, 'show']);
            });
            Route::prefix('shifts')->group(function () {
                Route::get('/{doctor_id}', [DoctorShiftController::class, 'index']); // لیست شیفت‌های یک پزشک
                Route::get('/{id}/{day}', [DoctorShiftController::class, 'show']);                // نمایش جزئیات شیفت
            });
            Route::prefix('appointments')->group(function () {
                Route::post('/', [AppointmentController::class, 'store']);        // ثبت نوبت جدید
            });
        });
    });
});

Route::get('/captcha/generate', [CaptchaController::class, 'generate']);
Route::post('/token/request', [TokenController::class, 'create']);

//Route::middleware('check.submit.token')->prefix('patient')->group(function () {
//    Route::post('/patients', [PatientController::class, 'store']);
//    Route::post('/appointments', [AppointmentController::class, 'store']);
//    Route::get('/doctors', [DoctorController::class, 'index']);
//});
