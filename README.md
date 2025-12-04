# Kamandi API

یک سیستم مدیریت نوبت‌دهی پزشکی و مدیریت بیماران مبتنی بر Laravel

## درباره پروژه

Kamandi API یک سیستم جامع مدیریت نوبت‌دهی پزشکی است که برای ارائه‌دهندگان خدمات بهداشتی و درمانی طراحی شده است. این سیستم امکان مدیریت کامل ارتباط پزشک-بیمار، نوبت‌های پزشکی، پرونده‌های بیماران، و نسخه‌های دارویی را فراهم می‌کند.

## ویژگی‌های اصلی

### مدیریت کاربران و نقش‌ها
- احراز هویت با OTP (رمز یکبار مصرف)
- سیستم کپچا برای امنیت بیشتر
- نقش‌های مختلف: بیمار، پزشک، پرستار، مدیر سیستم
- مدیریت توکن‌های API با Laravel Sanctum

### مدیریت پزشکان
- ثبت و مدیریت اطلاعات پزشکان
- تخصص‌ها و سوابق کاری
- مدیریت شیفت‌ها و ساعات کاری
- کد نظام پزشکی

### مدیریت بیماران
- ثبت اطلاعات دموگرافیک بیماران
- کد ملی، گروه خونی، آلرژی‌ها
- بیماری‌های مزمن
- مخاطبین اضطراری
- پرونده‌های پزشکی با امکان پیوست فایل

### سیستم نوبت‌دهی
- رزرو نوبت آنلاین، تلفنی، حضوری و ارجاعی
- پیگیری وضعیت نوبت (منتظر، ویزیت شده، لغو شده، غیبت)
- مدیریت پرداخت‌ها
- تاریخچه کامل نوبت‌ها

### ویزیت و پرونده پزشکی
- ثبت اطلاعات ویزیت
- تشخیص‌ها و درمان‌ها
- نسخه‌های دارویی
- ویزیت‌های مراجعه مجدد
- پین کردن پرونده‌های مهم

## تکنولوژی‌های استفاده شده

### Backend
- **Framework:** Laravel 12
- **زبان برنامه‌نویسی:** PHP 8.2+
- **احراز هویت:** Laravel Sanctum (Token-based)
- **مستندسازی API:** Scribe 5.6
- **پایگاه داده:** SQLite (توسعه) / MySQL / PostgreSQL (پروداکشن)
- **تست:** PHPUnit 11.5.3, Mockery 1.6

### Frontend Build
- **Build Tool:** Vite 7
- **CSS Framework:** Tailwind CSS 4
- **HTTP Client:** Axios 1.11

## پیش‌نیازها

- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite / MySQL / PostgreSQL
- GD Extension (برای کپچا)

## نصب و راه‌اندازی

### 1. کلون کردن پروژه

```bash
git clone <repository-url>
cd kamandi-api
```

### 2. نصب وابستگی‌های PHP

```bash
composer install
```

### 3. نصب وابستگی‌های JavaScript

```bash
npm install
```

### 4. تنظیمات محیطی

```bash
cp .env.example .env
php artisan key:generate
```

### 5. تنظیم پایگاه داده

فایل `.env` را ویرایش کنید و اطلاعات پایگاه داده را تنظیم نمایید:

**برای SQLite (توسعه):**
```env
DB_CONNECTION=sqlite
# DB_DATABASE=/path/to/database.sqlite
```

**برای MySQL (پروداکشن):**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kamandi_db
DB_USERNAME=root
DB_PASSWORD=
```

### 6. اجرای مایگریشن‌ها

```bash
php artisan migrate
```

### 7. (اختیاری) اجرای Seeders

```bash
php artisan db:seed
```

### 8. ایجاد فایل پایگاه داده SQLite (در صورت استفاده)

```bash
touch database/database.sqlite
```

## اجرای پروژه

### حالت توسعه (Development)

**سرور Laravel با Queue و Logs:**
```bash
composer run dev
```
این دستور به طور همزمان موارد زیر را اجرا می‌کند:
- سرور Laravel
- Queue Worker
- Laravel Pail (لاگ‌ها)

**سرور Vite (در ترمینال جدید):**
```bash
npm run dev
```

### حالت پروداکشن (Production)

**بیلد فرانت‌اند:**
```bash
npm run build
```

**اجرای سرور:**
```bash
php artisan serve
```

## مستندات API

### تولید مستندات

```bash
php artisan scribe:generate
```

### مشاهده مستندات

پس از اجرای سرور، مستندات API در آدرس زیر در دسترس است:
```
http://localhost:8000/docs
```

فایل OpenAPI (Swagger):
```
storage/app/private/scribe/openapi.yaml
```

## معماری API

### Endpoints عمومی (بدون احراز هویت)

**Base URL:** `/api/auth`

- `GET /auth/captcha/generate` - تولید کپچا
- `POST /auth/send-otp` - ارسال کد OTP به موبایل
- `POST /auth/verify-otp` - تایید کد OTP و ثبت‌نام/ورود
- `POST /auth/login` - ورود با موبایل/ایمیل و رمز عبور

### Endpoints محافظت شده (نیازمند احراز هویت)

تمام درخواست‌ها نیازمند Bearer Token در هدر Authorization هستند:
```
Authorization: Bearer {your-token}
```

#### پنل پزشکان و مدیران
**Base URL:** `/api`

**Middleware:** `check.roll:doctor,superadmin`

- **Users:** `GET|POST /users`, `GET|PUT|DELETE /users/{id}`
- **Doctors:** `GET|POST /doctors`, `GET|PUT|DELETE /doctors/{id}`
- **Shifts:** `GET|POST /shifts`, `GET|PUT|DELETE /shifts/{id}`
- **Patients:** `GET|POST /patients`, `GET|PUT|DELETE /patients/{id}`, `GET /patients/search`
- **Appointments:** `GET|POST /appointments`, `GET|PUT|DELETE /appointments/{id}`, `PUT /appointments/{id}/toggle-attended`
- **Visits:** `GET|POST /case-medical-visit`, `GET|PUT|DELETE /case-medical-visit/{id}`
- **Prescriptions:** `GET|POST /case-medical-prescription`, `GET|PUT|DELETE /case-medical-prescription/{id}`
- **Medical Cases:** `GET|POST /case-medical`, `GET|PUT|DELETE /case-medical/{id}`, `PUT /case-medical/{id}/pin`, `POST /case-medical/{id}/files`, `DELETE /case-medical/files/{fileId}`

#### پنل بیماران
**Base URL:** `/api/patient`

**Middleware:** `check.roll:patient,superadmin`

- **My Patients:** `GET|POST /patient/patients`, `GET|PUT|DELETE /patient/patients/{id}`
- **Doctors:** `GET /patient/doctors`, `GET /patient/doctors/{id}`
- **Shifts:** `GET /patient/shifts`, `GET /patient/shifts/{id}`
- **Appointments:** `GET|POST /patient/appointments`, `GET|PUT|DELETE /patient/appointments/{id}`, `GET /patient/appointments/view-own`

## ساختار دیتابیس

### جداول اصلی

- `users` - کاربران سیستم
- `patients` - بیماران
- `doctors` - پزشکان
- `shifts` - شیفت‌های کاری پزشکان
- `appointments` - نوبت‌ها
- `visits` - ویزیت‌ها
- `prescriptions` - نسخه‌های دارویی
- `case_medical` - پرونده‌های پزشکی
- `case_medical_files` - فایل‌های پیوست پرونده‌ها
- `case_medical_types` - انواع پرونده‌های پزشکی
- `patient_user` - ارتباط many-to-many بین بیماران و کاربران
- `personal_access_tokens` - توکن‌های Sanctum

## تست

### اجرای تست‌ها

```bash
composer test
```

یا:

```bash
./vendor/bin/phpunit
```

### اجرای تست با Coverage

```bash
./vendor/bin/phpunit --coverage-html coverage
```

## ساختار پروژه

```
kamandi-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/API/    # کنترلرهای API
│   │   ├── Middleware/         # میدلورها
│   │   └── Requests/           # درخواست‌های اعتبارسنجی شده
│   ├── Models/                 # مدل‌های Eloquent
│   └── Providers/              # سرویس پرووایدرها
├── config/                     # فایل‌های پیکربندی
├── database/
│   ├── migrations/             # مایگریشن‌های دیتابیس
│   ├── seeders/                # سیدرها
│   └── factories/              # فکتوری‌های تست
├── resources/
│   ├── views/                  # ویوهای Blade
│   ├── css/                    # فایل‌های CSS
│   └── js/                     # فایل‌های JavaScript
├── routes/
│   ├── api.php                 # روت‌های API
│   ├── web.php                 # روت‌های Web
│   └── console.php             # روت‌های Console
├── storage/                    # فایل‌های ذخیره‌سازی
├── tests/                      # تست‌ها
├── .env.example                # نمونه فایل محیطی
├── composer.json               # وابستگی‌های PHP
├── package.json                # وابستگی‌های JavaScript
└── README.md                   # این فایل
```

## امنیت

### گزارش آسیب‌پذیری‌های امنیتی

اگر آسیب‌پذیری امنیتی در این پروژه کشف کردید، لطفاً از طریق ایمیل با تیم توسعه تماس بگیرید. تمام آسیب‌پذیری‌های امنیتی به سرعت بررسی و رفع خواهند شد.

### نکات امنیتی

- همیشه از HTTPS در محیط پروداکشن استفاده کنید
- کلیدهای API و اطلاعات حساس را در فایل `.env` نگهداری کنید
- فایل `.env` را هرگز در گیت کامیت نکنید
- از رمزهای عبور قوی استفاده کنید
- توکن‌های API را به صورت امن ذخیره کنید

## مشارکت در پروژه

مشارکت‌ها استقبال می‌شوند! برای مشارکت:

1. پروژه را Fork کنید
2. یک Branch جدید بسازید (`git checkout -b feature/AmazingFeature`)
3. تغییرات خود را Commit کنید (`git commit -m 'Add some AmazingFeature'`)
4. Branch خود را Push کنید (`git push origin feature/AmazingFeature`)
5. یک Pull Request باز کنید

## لایسنس

این پروژه تحت لایسنس [MIT](https://opensource.org/licenses/MIT) منتشر شده است.

## پشتیبانی

برای سوالات و پشتیبانی:

- مستندات: `/docs` endpoint
- Issues: GitHub Issues

---

**ساخته شده با Laravel Framework**
