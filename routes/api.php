<?php

use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CaptchaController;
use App\Http\Controllers\API\CurrencyConverterController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\DoctorShiftController;
use App\Http\Controllers\API\CaseMedicalController;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\PrescriptionController;
use App\Http\Controllers\Api\RevisionLogController;
use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CaseMedicalVisitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::post('/register', [AuthController::class, 'register']);

//Route::middleware(['check.submit.token'])->group(function () {
Route::prefix('auth')->group(function () {
    Route::get('/captcha/generate', [CaptchaController::class, 'generate']);
    Route::post('/send-otp', [AuthController::class, 'sendOTP']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOTP']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/logoutall', [AuthController::class, 'logoutAll']);
    });
});
//    });


Route::middleware('auth:sanctum')->group(function () {


    Route::middleware(['check.roll:doctor,superadmin'])->group(function () {
        Route::prefix('users')->group(function () {
            // profile
            Route::get('/profile', [UserController::class, 'profile']); //برای ساید بار که اطلاعات کاربر لاگین کرده نمایش بده
            Route::get('/', [UserController::class, 'index']);          // گرفتن همه یوزر ها
            Route::post('/', [UserController::class, 'store']); // ایجاد یوزر
            Route::get('/{id}', [UserController::class, 'show']); // نمایش جزئیات یوزر
            Route::put('/{id}', [UserController::class, 'update']); //ویرایش یوزر
            Route::delete('/{id}', [UserController::class, 'destroy']); //حذف یوزر
        });
        Route::prefix('doctors')->group(function () {
            Route::get('/', [DoctorController::class, 'index']);          // لیست همه پزشکان
            Route::post('/', [DoctorController::class, 'store']);         // ایجاد پزشک جدید
            Route::get('/{id}', [DoctorController::class, 'show']);       // نمایش جزئیات پزشک
            Route::put('/{id}', [DoctorController::class, 'update']);     // ویرایش پزشک
            Route::delete('/{id}', [DoctorController::class, 'destroy']); // حذف پزشک
        });
        Route::prefix('shifts')->group(function () {
            Route::get('/{doctor_id}', [DoctorShiftController::class, 'index']);    // لیست شیفت‌های یک پزشک
            Route::post('/', [DoctorShiftController::class, 'store']);              // ایجاد شیفت جدید
            Route::get('/{id}/{day}', [DoctorShiftController::class, 'show']);      // نمایش جزئیات شیفت
            Route::put('/{id}', [DoctorShiftController::class, 'update']);          // ویرایش شیفت
            Route::delete('/{id}', [DoctorShiftController::class, 'destroy']);       // حذف شیفت
        });
        Route::prefix('patients')->group(function () {
            Route::get('/search', [PatientController::class, 'search']);
            Route::get('/', [PatientController::class, 'index']);          // لیست بیماران
            Route::post('/', [PatientController::class, 'store']);         // ایجاد بیمار جدید
            Route::get('/{id}', [PatientController::class, 'show']);       // نمایش جزئیات بیمار
            Route::put('/{id}', [PatientController::class, 'update']);     // ویرایش بیمار
            Route::delete('/{id}', [PatientController::class, 'destroy']); // حذف بیمار


        });
        Route::prefix('appointments')->group(function () {
            Route::get('/', [AppointmentController::class, 'index']);               // لیست نوبت‌ها
            Route::post('/', [AppointmentController::class, 'store']);              // ثبت نوبت جدید
            Route::get('/{doctor_id}/{date}', [AppointmentController::class, 'show_day']);  //نمایش نوبت های یک پزشک در یک روز
            Route::get('/{id}', [AppointmentController::class, 'show']); //نمایش جزعیات یک نوبت
            Route::put('/{id}', [AppointmentController::class, 'update']);    // ویرایش نوبت
            Route::patch('/attended/{id}', [AppointmentController::class, 'toggleAttended']);
            Route::delete('/{id}', [AppointmentController::class, 'destroy']);      // حذف نوبت
        });
        Route::prefix('visits')->group(function () {
            Route::post('/', [CaseMedicalVisitController::class, 'store']);
            Route::get('/{record_id?}', [CaseMedicalVisitController::class, 'index']);
            Route::get('/{id}', [CaseMedicalVisitController::class, 'show']);
            Route::put('/{id}', [CaseMedicalVisitController::class, 'update']);
            Route::delete('/{id}', [CaseMedicalVisitController::class, 'destroy']);
        });
        Route::prefix('prescriptions')->group(function () {
            Route::post('/', [PrescriptionController::class, 'store']);
            Route::get('/{record_id?}', [PrescriptionController::class, 'index']);
            Route::get('/{id}', [PrescriptionController::class, 'show']);
            Route::put('/{id}', [PrescriptionController::class, 'update']);
            Route::delete('/{id}', [PrescriptionController::class, 'destroy']);
        });
        Route::prefix('medicaldocument')->group(function () {
            Route::post('/', [CaseMedicalController::class, 'store']);
            Route::get('/{doctor_id}/{patient_id}', [CaseMedicalController::class, 'show']);
            Route::put('/{id}', [CaseMedicalController::class, 'update']);
            Route::patch('/pin/{id}', [CaseMedicalController::class, 'togglePin']);
            Route::delete('/{id}', [CaseMedicalController::class, 'destroy']);
            Route::delete('/file/{id}', [CaseMedicalController::class, 'deleteFile']);

        });
        Route::prefix('currency')->group(function () {
            Route::post('/convert', [CurrencyConverterController::class, 'convertUsdToIrt']);
        });

        Route::prefix('logs')->group(function () {
            Route::get('/', [RevisionLogController::class, 'index']);
            Route::get('/statistics', [RevisionLogController::class, 'statistics']);
            Route::get('/recent-activity', [RevisionLogController::class, 'recentActivity']);
            Route::get('/user/{userId}', [RevisionLogController::class, 'userLogs']);
            Route::get('/model', [RevisionLogController::class, 'modelLogs']);
            Route::get('/{id}', [RevisionLogController::class, 'show']);
            Route::post('/compare', [RevisionLogController::class, 'compare']);
            Route::delete('/cleanup', [RevisionLogController::class, 'cleanup']);
        });
    });

    Route::middleware(['check.roll:patient,superadmin'])->group(function () {
        Route::prefix('patient')->group(function () {

            // profile
            Route::get('/profile', [UserController::class, 'profile']); //برای ساید بار که اطلاعات کاربر لاگین کرده نمایش بده

            // patients CRUD
            Route::prefix('patients')->group(function () {
                Route::get('/', [PatientController::class, 'listmypatient']);    // برای بادی صففحه اصلی که بیمار های که اضافه کرده رو ببینه
                Route::post('/', [PatientController::class, 'store']);           //اضافه کردن بیمار اگه میخواست پرونده خودشو کامل کنه یا برای خودش نوبت بگیره باید for 1 باشه
                Route::get('/{id}', [PatientController::class, 'show']);         // دیدن اطلاعات بیمار
                Route::put('/{id}', [PatientController::class, 'update']);       // اپدیت کردن اطلاعات بیمار
                Route::delete('/{id}', [PatientController::class, 'destroy']);   //پاک کردن بیمار
            });
            // doctors
            Route::prefix('doctors')->group(function () {
                Route::get('/', [DoctorController::class, 'index']);
                Route::get('/{id}', [DoctorController::class, 'show']);
            });
            // shifts
            Route::prefix('shifts')->group(function () {
                Route::get('/{doctor_id}', [DoctorShiftController::class, 'index']); // لیست شیفت‌های یک پزشک
                Route::get('/{id}/{day}', [DoctorShiftController::class, 'show']);                // نمایش جزئیات شیفت
            });
            // appointments
            Route::prefix('appointments')->group(function () {
                Route::post('/', [AppointmentController::class, 'store']);// گرفتن نوبت
                Route::get('/{doctor_id}/{date}', [AppointmentController::class, 'show_day']); // دیدن صف نوبت ها
                Route::get('/{patient_id}', [AppointmentController::class, 'show_patient_appointments']); //دیدن نوبت های گذشته
                Route::put('/{id}', [AppointmentController::class, 'update']); // ادیت نوبت
                Route::delete('/{id}', [AppointmentController::class, 'destroy']); // حذذف نوبت
            });
        });
    });
});


//Route::middleware('check.submit.token')->prefix('patient')->group(function () {
//    Route::post('/patients', [PatientController::class, 'store']);
//    Route::post('/appointments', [AppointmentController::class, 'store']);
//    Route::get('/doctors', [DoctorController::class, 'index']);
//});
