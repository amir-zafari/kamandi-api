# 📚 Kamandi API - راهنمای کامل توسعه‌دهندگان

## 🌐 اطلاعات کلی

**Base URL:** `https://your-domain.com/api`  
**Authentication:** Bearer Token (Sanctum)  
**Content-Type:** `application/json` (برای درخواست‌های JSON)  
**Content-Type:** `multipart/form-data` (برای آپلود فایل)

## 📋 فهرست کامل API ها

### 🔐 Authentication (احراز هویت)
- [Login](#login) - ورود با رمز عبور
- [Send OTP](#send-otp) - ارسال کد تأیید
- [Verify OTP](#verify-otp) - تأیید کد OTP
- [Logout](#logout) - خروج از دستگاه فعلی
- [Logout All](#logout-all) - خروج از همه دستگاه‌ها
- [Generate Captcha](#generate-captcha) - ایجاد کپتچا

### 👥 User Management (مدیریت کاربران)
- [Get Users](#get-users) - لیست کاربران
- [Create User](#create-user) - ایجاد کاربر جدید
- [Get User](#get-user) - نمایش کاربر
- [Update User](#update-user) - ویرایش کاربر
- [Delete User](#delete-user) - حذف کاربر

### 👨‍⚕️ Doctor Management (مدیریت پزشکان)
- [Get Doctors](#get-doctors) - لیست پزشکان
- [Create Doctor](#create-doctor) - ایجاد پزشک جدید
- [Get Doctor](#get-doctor) - نمایش پزشک
- [Update Doctor](#update-doctor) - ویرایش پزشک
- [Delete Doctor](#delete-doctor) - حذف پزشک

### 🏥 Doctor Shifts (شیفت‌های پزشکان)
- [Get Shifts](#get-shifts) - لیست شیفت‌ها
- [Create Shift](#create-shift) - ایجاد شیفت جدید
- [Update Shift](#update-shift) - ویرایش شیفت
- [Delete Shift](#delete-shift) - حذف شیفت
- [Get Available Slots](#get-available-slots) - دریافت اسلات‌های خالی

### 👤 Patient Management (مدیریت بیماران)
- [Get Patients](#get-patients) - لیست بیماران
- [Create Patient](#create-patient) - ایجاد بیمار جدید
- [Get Patient](#get-patient) - نمایش بیمار
- [Update Patient](#update-patient) - ویرایش بیمار
- [Delete Patient](#delete-patient) - حذف بیمار

### 📅 Appointments (نوبت‌دهی)
- [Get Appointments](#get-appointments) - لیست نوبت‌ها
- [Create Appointment](#create-appointment) - ایجاد نوبت جدید
- [Get Appointment](#get-appointment) - نمایش نوبت
- [Update Appointment](#update-appointment) - ویرایش نوبت
- [Cancel Appointment](#cancel-appointment) - لغو نوبت
- [Mark Arrived](#mark-arrived) - ثبت ورود بیمار
- [Start Visit](#start-visit) - شروع ویزیت
- [Get Patient Appointments](#get-patient-appointments) - نوبت‌های یک بیمار
- [Get Day Appointments](#get-day-appointments) - نوبت‌های یک روز
- [Attendance Statistics](#attendance-statistics) - آمار حضور

### 📁 Case Medical Records (پرونده‌های پزشکی)
- [Text Records](#text-records) - پرونده‌های متنی
- [Handwritten Records](#handwritten-records) - پرونده‌های دست‌نویس
- [Document Records](#document-records) - پرونده‌های اسناد
- [Visit Reports](#visit-reports) - گزارش‌های ویزیت

### 💊 Prescriptions (نسخه‌ها)
- [Get Prescriptions](#get-prescriptions) - لیست نسخه‌ها
- [Create Prescription](#create-prescription) - ایجاد نسخه
- [Update Prescription](#update-prescription) - ویرایش نسخه
- [Delete Prescription](#delete-prescription) - حذف نسخه

### 💱 Currency Converter (تبدیل ارز)
- [USD to IRT](#usd-to-irt) - تبدیل دلار به تومان

### 📜 Revision Logs (تاریخچه تغییرات)
- [Get Revisions](#get-revisions) - لیست تغییرات
- [Rollback](#rollback) - بازگردانی تغییرات
- [Compare](#compare) - مقایسه تغییرات

---

## 🔐 Authentication APIs

### Generate Captcha
**URL:** `GET /captcha/generate`  
**Auth:** ❌ غیرضروری  
**توضیح:** ایجاد کپتچا برای احراز هویت

**درخواست:**
```http
GET /api/captcha/generate
```

**پاسخ موفق (200):**
```json
{
    "status": "success",
    "captcha_id": "a1b2c3d4-e5f6-7g8h-9i0j-k1l2m3n4o5p6",
    "image": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAA8CA...",
    "expires_in": 120
}
```

---

### Login
**URL:** `POST /auth/login`  
**Auth:** ❌ غیرضروری  
**توضیح:** ورود کاربر با موبایل/ایمیل و رمز عبور

**درخواست:**
```json
{
    "mobile": "09123456789",  // یا email: "user@example.com"
    "password": "123456789",
    "captcha_id": "a1b2c3d4-e5f6-7g8h-9i0j-k1l2m3n4o5p6",
    "answer": "ABC12"
}
```

**پاسخ موفق (200):**
```json
{
    "access_token": "1|abc123def456...",
    "token_type": "Bearer",
    "user": {
        "id": 1,
        "first_name": "احمد",
        "last_name": "محمدی",
        "roll": "doctor",
        "mobile": "09123456789"
    }
}
```

**خطاهای ممکن:**
- **400** - کپتچا نامعتبر یا منقضی
- **401** - اطلاعات ورود نادرست
- **422** - فرمت شماره موبایل/ایمیل نامعتبر

---

### Send OTP
**URL:** `POST /auth/send-otp`  
**Auth:** ❌ غیرضروری  
**توضیح:** ارسال کد تأیید به شماره موبایل

**درخواست:**
```json
{
    "mobile": "09123456789"
}
```

**پاسخ موفق (200):**
```json
{
    "message": "کد تأیید ارسال شد",
    "otp": 123456
}
```

**خطاهای ممکن:**
- **422** - فرمت شماره موبایل نامعتبر (باید 09xxxxxxxxx باشد)

---

### Verify OTP
**URL:** `POST /auth/verify-otp`  
**Auth:** ❌ غیرضروری  
**توضیح:** تأیید کد OTP و دریافت توکن

**درخواست:**
```json
{
    "mobile": "09123456789",
    "otp": 123456
}
```

**پاسخ موفق (200):**
```json
{
    "access_token": "1|abc123def456...",
    "token_type": "Bearer",
    "user": {
        "id": 1,
        "first_name": "کاربر",
        "last_name": "",
        "roll": "patient"
    }
}
```

**خطاهای ممکن:**
- **400** - کد تأیید نامعتبر یا منقضی شده
- **422** - فرمت ورودی نامعتبر

---

### Logout
**URL:** `POST /auth/logout`  
**Auth:** ✅ ضروری  
**توضیح:** خروج از دستگاه فعلی

**درخواست:**
```http
POST /api/auth/logout
Authorization: Bearer 1|abc123def456...
```

**پاسخ موفق (200):**
```json
{
    "message": "Logged out successfully."
}
```

---

### Logout All
**URL:** `POST /auth/logout-all`  
**Auth:** ✅ ضروری  
**توضیح:** خروج از همه دستگاه‌ها

**درخواست:**
```http
POST /api/auth/logout-all
Authorization: Bearer 1|abc123def456...
```

**پاسخ موفق (200):**
```json
{
    "message": "Logged out from all devices."
}
```

---

## 👥 User Management APIs

### Get Users
**URL:** `GET /users`  
**Auth:** ✅ ضروری  
**توضیح:** دریافت لیست کاربران با امکان فیلتر

**درخواست:**
```http
GET /api/users?role=doctor&status=active&search=احمد
Authorization: Bearer 1|abc123def456...
```

**پارامترهای اختیاری:**
- `role`: doctor, patient, nurse, superadmin
- `status`: active, inactive
- `search`: جستجو در نام و نام خانوادگی

**پاسخ موفق (200):**
```json
{
    "status": "success",
    "users": [
        {
            "id": 1,
            "first_name": "احمد",
            "last_name": "محمدی",
            "email": "ahmad@example.com",
            "mobile": "09123456789",
            "roll": "doctor",
            "status": "active",
            "created_at": "2025-01-01T10:00:00.000000Z"
        }
    ],
    "total": 1
}
```

---

### Create User
**URL:** `POST /users`  
**Auth:** ✅ ضروری (فقط superadmin)  
**توضیح:** ایجاد کاربر جدید

**درخواست:**
```json
{
    "first_name": "احمد",
    "last_name": "محمدی",
    "email": "ahmad@example.com",
    "mobile": "09123456789",
    "password": "123456789",
    "password_confirmation": "123456789",
    "roll": "doctor"
}
```

**پاسخ موفق (201):**
```json
{
    "status": "success",
    "message": "User created successfully",
    "user": {
        "id": 2,
        "first_name": "احمد",
        "last_name": "محمدی",
        "email": "ahmad@example.com",
        "mobile": "09123456789",
        "roll": "doctor",
        "status": "active"
    }
}
```

**خطاهای ممکن:**
- **422** - اطلاعات نامعتبر (ایمیل تکراری، رمز عبور ضعیف، ...)
- **403** - عدم دسترسی

---

## 👨‍⚕️ Doctor Management APIs

### Get Doctors
**URL:** `GET /doctors`  
**Auth:** ✅ ضروری  
**توضیح:** لیست پزشکان با جزئیات کامل

**درخواست:**
```http
GET /api/doctors?specialty=قلب&status=active
Authorization: Bearer 1|abc123def456...
```

**پارامترهای اختیاری:**
- `specialty`: تخصص پزشک
- `status`: active, inactive
- `search`: جستجو در نام

**پاسخ موفق (200):**
```json
{
    "status": "success",
    "doctors": [
        {
            "id": 1,
            "user": {
                "id": 2,
                "first_name": "دکتر احمد",
                "last_name": "کریمی",
                "email": "dr.karimi@example.com",
                "mobile": "09123456789"
            },
            "medical_license": "12345",
            "specialty": "قلب و عروق",
            "bio": "متخصص قلب و عروق با 10 سال تجربه",
            "fee": 500000,
            "status": "active",
            "shifts": [
                {
                    "day": 1,
                    "start_time": "08:00",
                    "end_time": "12:00",
                    "duration": 30
                }
            ]
        }
    ]
}
```

---

### Create Doctor
**URL:** `POST /doctors`  
**Auth:** ✅ ضروری (superadmin یا doctor)  
**توضیح:** ایجاد پروفایل پزشک جدید

**درخواست:**
```json
{
    "user_id": 2,
    "medical_license": "12345",
    "specialty": "قلب و عروق",
    "bio": "متخصص قلب و عروق با 10 سال تجربه",
    "fee": 500000
}
```

**پاسخ موفق (201):**
```json
{
    "status": "success",
    "message": "Doctor created successfully",
    "doctor": {
        "id": 1,
        "user_id": 2,
        "medical_license": "12345",
        "specialty": "قلب و عروق",
        "bio": "متخصص قلب و عروق با 10 سال تجربه",
        "fee": 500000,
        "status": "active"
    }
}
```

---

## 🏥 Doctor Shifts APIs

### Get Available Slots
**URL:** `GET /doctor-shifts/{doctor_id}/available-slots/{date}`  
**Auth:** ✅ ضروری  
**توضیح:** دریافت اسلات‌های خالی یک پزشک در روز مشخص

**درخواست:**
```http
GET /api/doctor-shifts/1/available-slots/2025-12-10
Authorization: Bearer 1|abc123def456...
```

**پاسخ موفق (200):**
```json
{
    "status": "success",
    "doctor_id": 1,
    "date": "2025-12-10",
    "day_name": "یکشنبه",
    "shift": {
        "start_time": "08:00",
        "end_time": "12:00",
        "duration": 30
    },
    "available_slots": [
        "08:00",
        "08:30",
        "09:00",
        "09:30",
        "11:00",
        "11:30"
    ],
    "occupied_slots": [
        "10:00",
        "10:30"
    ],
    "total_slots": 8,
    "available_count": 6,
    "occupied_count": 2
}
```

---

## 👤 Patient Management APIs

### Get Patients
**URL:** `GET /patients`  
**Auth:** ✅ ضروری  
**توضیح:** لیست بیماران (برای بیماران، فقط خودشان)

**درخواست:**
```http
GET /api/patients?search=احمد&blood_type=A+
Authorization: Bearer 1|abc123def456...
```

**پاسخ موفق (200):**
```json
{
    "status": "success",
    "patients": [
        {
            "id": 1,
            "first_name": "احمد",
            "last_name": "احمدی",
            "national_id": "1234567890",
            "date_of_birth": "1990-05-15",
            "blood_type": "A+",
            "phone": "09123456789",
            "address": "تهران، خیابان ولیعصر",
            "emergency_contact": "09187654321",
            "allergies": "پنی سیلین",
            "medical_history": "سابقه فشار خون",
            "users": [
                {
                    "id": 3,
                    "first_name": "احمد",
                    "last_name": "احمدی",
                    "mobile": "09123456789"
                }
            ]
        }
    ]
}
```

---

## 📅 Appointments APIs

### Create Appointment
**URL:** `POST /appointments`  
**Auth:** ✅ ضروری  
**توضیح:** ایجاد نوبت جدید برای بیمار

**درخواست:**
```json
{
    "doctor_id": 1,
    "patient_id": 1,
    "date": "2025-12-10",
    "start_time": "10:00",
    "appointment_type": "in_person",
    "service_type": "doctor"
}
```

**فیلدهای اختیاری:**
- `appointment_type`: online, phone, in_person, referral (پیش‌فرض: online)
- `service_type`: doctor, injection (پیش‌فرض: doctor)

**پاسخ موفق (201):**
```json
{
    "status": "success",
    "message": "Appointment booked successfully.",
    "appointment": {
        "id": 1,
        "doctor_id": 1,
        "patient_id": 1,
        "date": "2025-12-10",
        "start_time": "10:00:00",
        "status": "waiting",
        "attended": "not_arrived",
        "appointment_type": "in_person",
        "service_type": "doctor",
        "doctor": {
            "id": 1,
            "specialty": "قلب و عروق",
            "user": {
                "first_name": "دکتر احمد",
                "last_name": "کریمی"
            }
        },
        "patient": {
            "id": 1,
            "first_name": "احمد",
            "last_name": "احمدی"
        }
    }
}
```

**خطاهای ممکن:**
- **400** - تاریخ در گذشته، پزشک در این روز شیفت ندارد
- **409** - تداخل زمانی (بیمار یا پزشک نوبت دارد)
- **422** - فرمت اطلاعات نامعتبر

---

### Mark Arrived
**URL:** `POST /appointments/{id}/mark-arrived`  
**Auth:** ✅ ضروری (doctor, nurse, superadmin)  
**توضیح:** ثبت ورود بیمار (مرحله اول حضور)

**درخواست:**
```json
{
    "attendance_notes": "بیمار به موقع آمده"
}
```

**پاسخ موفق (200):**
```json
{
    "status": "success",
    "message": "Patient marked as arrived successfully.",
    "appointment": {
        "id": 1,
        "attended": "arrived",
        "arrival_time": "2025-12-10T10:05:00.000000Z",
        "attendance_notes": "بیمار به موقع آمده"
    },
    "marked_by": {
        "id": 2,
        "name": "پرستار علی",
        "role": "nurse"
    }
}
```

---

### Start Visit
**URL:** `POST /appointments/{id}/start-visit`  
**Auth:** ✅ ضروری (فقط doctor یا superadmin)  
**توضیح:** شروع و تکمیل ویزیت (مرحله دوم)

**درخواست:**
```json
{
    "visit_notes": "ویزیت عادی، بیمار حال عمومی خوبی دارد"
}
```

**پاسخ موفق (200):**
```json
{
    "status": "success",
    "message": "Visit completed successfully.",
    "appointment": {
        "id": 1,
        "attended": "completed",
        "status": "visited",
        "visit_start_time": "2025-12-10T10:15:00.000000Z",
        "waiting_time": 10
    },
    "waiting_time_minutes": 10
}
```

---

## 📁 Case Medical Records APIs

### Text Records

#### Create Text Record
**URL:** `POST /text-records`  
**Auth:** ✅ ضروری  
**توضیح:** ایجاد پرونده متنی (Type ID: 1)

**درخواست:**
```json
{
    "doctor_id": 1,
    "patient_id": 1,
    "title": "یادداشت درمان",
    "case_date": "2025-12-10",
    "notes": "بیمار پیشرفت خوبی در درمان داشته است"
}
```

**پاسخ موفق (201):**
```json
{
    "status": "success",
    "text_record": {
        "id": 1,
        "title": "یادداشت درمان",
        "case_medical_type_id": 1,
        "case_date": "2025-12-10",
        "notes": "بیمار پیشرفت خوبی در درمان داشته است",
        "type": {
            "id": 1,
            "name": "متن"
        }
    }
}
```

---

### Handwritten Records

#### Create Handwritten Record
**URL:** `POST /handwritten-records`  
**Auth:** ✅ ضروری  
**Content-Type:** `multipart/form-data`  
**توضیح:** ایجاد پرونده دست‌نویس با فایل‌ها (Type ID: 2)

**درخواست:**
```http
POST /api/handwritten-records
Content-Type: multipart/form-data
Authorization: Bearer 1|abc123def456...

doctor_id: 1
patient_id: 1
title: یادداشت دست‌نویس
case_date: 2025-12-10
files[]: image1.jpg
files[]: image2.png
notes: اسکن یادداشت‌های درمان
```

**فایل‌های مجاز:** jpg, png, pdf (حداکثر 20MB)

**پاسخ موفق (201):**
```json
{
    "status": "success",
    "handwritten_record": {
        "id": 2,
        "title": "یادداشت دست‌نویس",
        "case_medical_type_id": 2,
        "files": [
            {
                "id": 1,
                "file_name": "image1.jpg",
                "file_path": "case_medicals/abc123.jpg",
                "size": 245760
            }
        ]
    }
}
```

---

### Visit Reports

#### Create Visit Report
**URL:** `POST /visit-reports`  
**Auth:** ✅ ضروری  
**توضیح:** ایجاد گزارش ویزیت کامل (CaseMedical + Visit)

**درخواست:**
```json
{
    "doctor_id": 1,
    "patient_id": 1,
    "title": "گزارش ویزیت اول",
    "case_date": "2025-12-10",
    "notes": "ویزیت معمولی",
    
    // فیلدهای Visit
    "visit_reason": "سردرد و تهوع",
    "symptoms": "سردرد شدید، تهوع، تب خفیف",
    "diagnosis": "میگرن احتمالی",
    "prescribed_medications": "پاراسیتامول 500mg سه بار در روز، کوزان یک قرص شب",
    "follow_up_date": "2025-12-17"
}
```

**پاسخ موفق (201):**
```json
{
    "status": "success",
    "message": "Visit report created successfully",
    "visit_report": {
        "id": 3,
        "title": "گزارش ویزیت اول",
        "case_medical_type_id": 4,
        "case_date": "2025-12-10",
        "notes": "ویزیت معمولی",
        "visit": {
            "id": 1,
            "case_medical_id": 3,
            "visit_reason": "سردرد و تهوع",
            "symptoms": "سردرد شدید، تهوع، تب خفیف",
            "diagnosis": "میگرن احتمالی",
            "prescribed_medications": "پاراسیتامول 500mg سه بار در روز، کوزان یک قرص شب",
            "follow_up_date": "2025-12-17"
        }
    }
}
```

---

## 💊 Prescriptions APIs

### Create Prescription
**URL:** `POST /prescriptions`  
**Auth:** ✅ ضروری  
**توضیح:** ایجاد نسخه دارویی

**درخواست:**
```json
{
    "medical_record_id": 1,
    "visit_id": 1,
    "medication_name": "پاراسیتامول 500mg",
    "dosage": "یک قرص",
    "instructions": "سه بار در روز با غذا",
    "duration_days": 7
}
```

**پاسخ موفق (201):**
```json
{
    "status": "success",
    "prescription": {
        "id": 1,
        "medical_record_id": 1,
        "visit_id": 1,
        "medication_name": "پاراسیتامول 500mg",
        "dosage": "یک قرص",
        "instructions": "سه بار در روز با غذا",
        "duration_days": 7,
        "created_at": "2025-12-10T10:30:00.000000Z"
    }
}
```

---

## 💱 Currency Converter APIs

### USD to IRT
**URL:** `POST /currency/usd-to-irt`  
**Auth:** ✅ ضروری  
**توضیح:** تبدیل دلار به تومان با نرخ لحظه‌ای

**درخواست:**
```json
{
    "amount": 100.50
}
```

**پاسخ موفق (200):**
```json
{
    "status": "success",
    "data": {
        "usd_amount": 100.5,
        "usd_amount_formatted": "100.50",
        "exchange_rate": 42500,
        "exchange_rate_formatted": "42,500",
        "irt_amount": 4271250,
        "irt_amount_formatted": "4,271,250",
        "currency": "IRT",
        "source": "Nobitex",
        "timestamp": "2025-12-10T10:35:00.000000Z",
        "last_update": "2025-12-10 10:34:15"
    }
}
```

**خطاهای ممکن:**
- **422** - مقدار نامعتبر (باید عدد مثبت باشد)
- **500** - خطا در دریافت نرخ از منبع خارجی

---

## 🚫 خطاهای عمومی

### 401 Unauthorized
```json
{
    "message": "Unauthenticated."
}
```

### 403 Forbidden
```json
{
    "status": "error",
    "message": "You do not have permission to perform this action."
}
```

### 404 Not Found
```json
{
    "status": "error",
    "message": "Resource not found."
}
```

### 422 Validation Error
```json
{
    "status": "error",
    "errors": {
        "email": ["The email field is required."],
        "mobile": ["شماره موبایل باید 11 رقم باشد"]
    }
}
```

### 500 Server Error
```json
{
    "status": "error",
    "message": "An error occurred while processing your request"
}
```

---

## 📝 نکات مهم برای توسعه‌دهندگان

### 🔑 استفاده از Token
```javascript
// نمونه درخواست با JavaScript
fetch('/api/doctors', {
    method: 'GET',
    headers: {
        'Authorization': 'Bearer ' + token,
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
})
```

### 📤 آپلود فایل
```javascript
// نمونه آپلود فایل
const formData = new FormData();
formData.append('doctor_id', '1');
formData.append('patient_id', '1');
formData.append('title', 'اسکن آزمایش');
formData.append('files[]', file1);
formData.append('files[]', file2);

fetch('/api/handwritten-records', {
    method: 'POST',
    headers: {
        'Authorization': 'Bearer ' + token
        // Content-Type را تنظیم نکنید - مرورگر خودکار تنظیم می‌کند
    },
    body: formData
})
```

### 📊 فیلترها و جستجو
```javascript
// نمونه استفاده از فیلترها
const params = new URLSearchParams({
    status: 'active',
    specialty: 'قلب',
    search: 'احمد'
});

fetch(`/api/doctors?${params}`)
```

### ⏰ مدیریت زمان
- همه زمان‌ها به فرمت ISO 8601 ارسال می‌شوند
- تاریخ‌ها به فرمت Y-m-d (مثال: 2025-12-10)
- ساعت‌ها به فرمت H:i (مثال: 14:30)

### 🔒 سطوح دسترسی
- **superadmin**: دسترسی کامل به همه بخش‌ها
- **doctor**: مدیریت بیماران، نوبت‌ها، پرونده‌ها
- **nurse**: کمک در مدیریت نوبت‌ها و حضور
- **patient**: مشاهده و مدیریت نوبت‌های شخصی

---

## 🧪 نمونه‌های تست

### Test Authentication Flow
```bash
# 1. دریافت کپتچا
curl -X GET http://localhost:8000/api/captcha/generate

# 2. ورود
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"mobile":"09123456789","password":"password","captcha_id":"uuid","answer":"ABC12"}'

# 3. استفاده از API
curl -X GET http://localhost:8000/api/doctors \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Test Appointment Flow
```bash
# 1. بررسی اسلات‌های خالی
curl -X GET http://localhost:8000/api/doctor-shifts/1/available-slots/2025-12-10 \
  -H "Authorization: Bearer YOUR_TOKEN"

# 2. ایجاد نوبت
curl -X POST http://localhost:8000/api/appointments \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"doctor_id":1,"patient_id":1,"date":"2025-12-10","start_time":"10:00"}'

# 3. ثبت ورود بیمار
curl -X POST http://localhost:8000/api/appointments/1/mark-arrived \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -d '{"attendance_notes":"به موقع آمد"}'
```

---

**تاریخ به‌روزرسانی:** 2025-12-10  
**نسخه API:** 1.0  
**پشتیبانی:** برای سوالات به تیم توسعه مراجعه کنید
