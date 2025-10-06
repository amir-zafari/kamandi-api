<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مستندات API | پروژه دکتر کمندی</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <!-- فونت وزیر -->
    <link href="https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            font-family: Vazir, sans-serif;
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.12);
        }
    </style>
</head>
<body class="flex transition-colors duration-500 bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100">

<!-- سایدبار -->
<aside class="w-64 h-screen bg-white shadow-lg border-l border-gray-200 dark:bg-gray-800 dark:border-gray-700 fixed right-0 top-0 transition-colors duration-500">
    <div class="p-6 flex flex-col h-full justify-between">
        <div>
            <h2 class="text-xl font-bold text-indigo-700 dark:text-indigo-400 mb-4">📑 دسته‌بندی API</h2>
            <nav class="space-y-2 text-gray-700 dark:text-gray-300">
                <!-- Accordion -->
                <div class="accordion">
                    <button class="w-full flex justify-between items-center font-semibold hover:text-indigo-600 dark:hover:text-indigo-400 transition p-2" onclick="toggleAccordion(this)">
                        🔐 احراز هویت
                        <span class="transform transition-transform duration-300">▸</span>
                    </button>
                    <ul class="ml-6 mt-2 space-y-2 text-sm hidden">
                        <li><a href="#login" class="block hover:text-indigo-500 dark:hover:text-indigo-300">ورود</a></li>
                        <li><a href="#register" class="block hover:text-indigo-500 dark:hover:text-indigo-300">ثبت‌نام</a></li>
{{--                        <li><a href="#logout" class="block hover:text-indigo-500 dark:hover:text-indigo-300">خروج</a></li>--}}
                    </ul>
                </div>
                <div class="accordion">
                    <button class="w-full flex justify-between items-center font-semibold hover:text-indigo-600 dark:hover:text-indigo-400 transition p-2" onclick="toggleAccordion(this)">
                        👨‍⚕️ دکترها
                        <span class="transform transition-transform duration-300">▸</span>
                    </button>
                    <ul class="ml-6 mt-2 space-y-2 text-sm hidden">
                        <li><a href="#doctors-index" class="block hover:text-indigo-500 dark:hover:text-indigo-300">لیست دکترها</a></li>
                        <li><a href="#doctors-store" class="block hover:text-indigo-500 dark:hover:text-indigo-300">ثبت دکتر جدید</a></li>
                        <li><a href="#doctors-show" class="block hover:text-indigo-500 dark:hover:text-indigo-300">نمایش دکتر</a></li>
                        <li><a href="#doctors-update" class="block hover:text-indigo-500 dark:hover:text-indigo-300">ویرایش دکتر</a></li>
                        <li><a href="#doctors-delete" class="block hover:text-indigo-500 dark:hover:text-indigo-300">حذف دکتر</a></li>
                    </ul>
                </div>
                <div class="accordion">
                    <button class="w-full flex justify-between items-center font-semibold hover:text-indigo-600 dark:hover:text-indigo-400 transition p-2" onclick="toggleAccordion(this)">
                        🕒 شیفت‌ها
                        <span class="transform transition-transform duration-300">▸</span>
                    </button>
                    <ul class="ml-6 mt-2 space-y-2 text-sm hidden">
                        <li><a href="#shifts-index" class="block hover:text-indigo-500 dark:hover:text-indigo-300">لیست شیفت‌ها</a></li>
                        <li><a href="#shifts-store" class="block hover:text-indigo-500 dark:hover:text-indigo-300">ثبت شیفت</a></li>
                        <li><a href="#shifts-show" class="block hover:text-indigo-500 dark:hover:text-indigo-300">نمایش نوبت‌ها</a></li>
                        <li><a href="#shifts-update" class="block hover:text-indigo-500 dark:hover:text-indigo-300">ویرایش شیفت</a></li>
                        <li><a href="#shifts-delete" class="block hover:text-indigo-500 dark:hover:text-indigo-300">حذف شیفت</a></li>
                    </ul>
                </div>
                <div class="accordion">
                    <button class="w-full flex justify-between items-center font-semibold hover:text-indigo-600 dark:hover:text-indigo-400 transition p-2" onclick="toggleAccordion(this)">
                        🤕 بیمار
                        <span class="transform transition-transform duration-300">▸</span>
                    </button>
                    <ul class="ml-6 mt-2 space-y-2 text-sm hidden">
                        <li><a href="#patients-index" class="block hover:text-indigo-500 dark:hover:text-indigo-300">لیست بیمارها</a></li>
                        <li><a href="#patients-store" class="block hover:text-indigo-500 dark:hover:text-indigo-300">ثبت بیمار</a></li>
                        <li><a href="#patients-show" class="block hover:text-indigo-500 dark:hover:text-indigo-300">نمایش اطلاعات بیمار</a></li>
                        <li><a href="#patients-update" class="block hover:text-indigo-500 dark:hover:text-indigo-300">ویرایش بیمار</a></li>
                        <li><a href="#patients-delete" class="block hover:text-indigo-500 dark:hover:text-indigo-300">حذف بیمار</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- دکمه تغییر حالت -->
        <button id="themeToggle" class="mt-6 w-full py-2 px-4 bg-indigo-600 text-white rounded hover:bg-indigo-500 transition">🌙 تغییر حالت روز/شب</button>
    </div>
</aside>

<!-- محتوای اصلی -->
<main class="flex-1 p-10 space-y-10 mr-64 bg-white text-gray-800 dark:bg-gray-800 dark:text-gray-100 duration-500">
    <h1 class="text-4xl font-bold text-indigo-700 dark:text-indigo-400 mb-10">📘 مستندات API</h1>

    <!-- احراز هویت -->
    <section id="doctors" class="space-y-6">
        <h2 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-300">🔐 احراز هویت</h2>
        <x-api-card
            id="login"
            method="POST"
            url="/api/login"
            title="ورود کاربر"
            desc="ورود کاربر و دریافت توکن احراز هویت"
            :response='json_encode([
            "access_token" => "abcdef123456",
            "token_type" => "Bearer"
        ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
            "message" => "اطلاعات ورود نامعتبر است"
        ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{
    "email": "ali@example.com",
    "password": "12345678"
}
        </x-api-card>
        <x-api-card
            id="register"
            method="POST"
            url="/api/register"
            title="ثبت‌نام کاربر"
            desc="ایجاد کاربر جدید و دریافت توکن احراز هویت"
            :response='json_encode([
            "access_token" => "abcdef123456",
            "token_type" => "Bearer"
        ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
            "name" => ["فیلد نام الزامی است"],
            "email" => ["ایمیل معتبر نیست یا تکراری است"],
            "password" => ["رمز عبور معتبر نیست یا مطابقت ندارد"],
            "phone" => ["شماره موبایل معتبر نیست یا تکراری است"],
            "national_id" => ["کد ملی تکراری است"]
        ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{
    "name": "Ali",
    "email": "ali@example.com",
    "password": "12345678",
    "password_confirmation": "12345678",
    "phone": "09123456789",
    "national_id": "0012345678"
}
        </x-api-card>
    </section>
    <!-- دکترها -->
    <section id="doctors" class="space-y-6">
        <h2 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-300">👨‍⚕️ دکترها</h2>
        <x-api-card
            id="doctors-index"
            method="POST"
            url="/api/doctors/index"
            title="لیست دکترها"
            desc="دریافت لیست همه دکترها همراه با نام و تخصص"
            :response='json_encode([
        "status" => "success",
        "doctors" => [
            [
                "id" => 1,
                "name" => "Ali",
                "specialty" => "Cardiology"
            ]
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{}
        </x-api-card>
        <x-api-card
            id="doctors-store"
            method="POST"
            url="/api/doctors/store"
            title="ایجاد دکتر"
            desc="ثبت یک دکتر جدید و اختصاص دادن اطلاعات کاربری"
            :response='json_encode([
        "status" => "success"
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "errors" => [
            "user_id" => ["کاربر یافت نشد یا الزامی است"],
            "code_nzam" => ["کد نظام پزشکی تکراری است"],
            "national_id" => ["کد ملی تکراری است"]
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{
    "user_id": 1,
    "specialty": "Cardiology",
    "code_nzam": "123456",
    "work_experience": "5 سال",
    "national_id": "0012345678"
}
        </x-api-card>
        <x-api-card
            id="doctors-show"
            method="POST"
            url="/api/doctors/show/{id}"
            title="نمایش دکتر"
            desc="نمایش اطلاعات یک دکتر مشخص همراه با اطلاعات کاربری"
            :response='json_encode([
        "status" => "success",
        "doctor" => [
            "user" => [
                "id" => 1,
                "name" => "Ali",
                "email" => "ali@example.com",
                "phone" => "09123456789",
                "national_id" => "0012345678"
            ],
            "doctor" => [
                "id" => 1,
                "specialty" => "Cardiology",
                "code_nzam" => "123456",
                "work_experience" => "5 سال"
            ]
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "message" => "Doctor not found."
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{}
        </x-api-card>
        <x-api-card
            id="doctors-update"
            method="POST"
            url="/api/doctors/update/{id}"
            title="ویرایش دکتر"
            desc="ویرایش اطلاعات دکتر و اطلاعات کاربری مرتبط"
            :response='json_encode([
        "status" => "success",
        "doctor" => [
            "id" => 1,
            "user_id" => 1,
            "specialty" => "Cardiology",
            "code_nzam" => "123456",
            "work_experience" => "6 سال"
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "message" => "Doctor not found",
        "errors" => [
            "code_nzam" => ["کد نظام پزشکی تکراری است"],
            "national_id" => ["کد ملی تکراری است"]
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{
    "specialty": "Cardiology",
    "code_nzam": "123456",
    "work_experience": "6 سال",
    "national_id": "0012345678",
    "phone": "09123456789",
    "name": "Ali Updated",
    "email": "ali@example.com"
}
        </x-api-card>
        <x-api-card
            id="doctors-delete"
            method="POST"
            url="/api/doctors/delete/{id}"
            title="حذف دکتر"
            desc="حذف دکتر مشخص و تغییر رول کاربری مرتبط"
            :response='json_encode([
        "status" => "success"
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "message" => "Doctor not found."
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{}
        </x-api-card>
    </section>
    <section id="shifts" class="space-y-6">
        <h2 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-300">🕒 شیفت‌ها</h2>
        <x-api-card
            id="shifts-index"
            method="POST"
            url="/api/shifts/index/{doctor_id}"
            title="لیست شیفت‌ها"
            desc="دریافت همه شیفت‌های یک دکتر مشخص به همراه تعداد اسلات‌ها"
            :response='json_encode([
        "status" => "success",
        "shifts" => [
            [
                "id" => 1,
                "day" => 0,
                "start_time" => "09:00",
                "end_time" => "12:00",
                "duration" => 30,
                "slots" => 6
            ]
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "message" => "Doctor not found."
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{}
        </x-api-card>
        <x-api-card
            id="shifts-store"
            method="POST"
            url="/api/shifts/store"
            title="ایجاد شیفت"
            desc="ثبت یک شیفت جدید برای دکتر مشخص"
            :response='json_encode([
        "status" => "success",
        "shift" => [
            "id" => 1,
            "doctor_id" => 1,
            "day" => 0,
            "start_time" => "09:00",
            "end_time" => "12:00",
            "duration" => 30
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "errors" => [
            "doctor_id" => ["دکتر یافت نشد یا الزامی است"],
            "day" => ["روز باید عدد بین 0 تا 6 باشد"],
            "start_time" => ["فرمت زمان شروع معتبر نیست"],
            "end_time" => ["زمان پایان باید بعد از زمان شروع باشد"],
            "duration" => ["مدت زمان باید بین 1 تا 60 دقیقه باشد"]
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{
    "doctor_id": 1,
    "day": 0,
    "start_time": "09:00",
    "end_time": "12:00",
    "duration": 30
}
        </x-api-card>
        <x-api-card
            id="shifts-show"
            method="POST"
            url="/api/shifts/show"
            title="نمایش شیفت روز مشخص"
            desc="دریافت همه شیفت‌های یک دکتر در یک روز مشخص به همراه اسلات‌ها"
            :response='json_encode([
        "status" => "success",
        "shifts" => [
            [
                "shift_id" => 1,
                "start_time" => "09:00",
                "end_time" => "12:00",
                "duration" => 30,
                "slots" => ["09:00","09:30","10:00","10:30","11:00","11:30"]
            ]
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "message" => "No shifts found for this doctor on the specified day.",
        "errors" => [
            "doctor_id" => ["دکتر یافت نشد یا الزامی است"],
            "day" => ["روز باید عدد بین 0 تا 6 باشد"]
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{
    "doctor_id": 1,
    "day": 0
}
        </x-api-card>
        <x-api-card
            id="shifts-update"
            method="POST"
            url="/api/shifts/update/{id}"
            title="ویرایش شیفت"
            desc="ویرایش اطلاعات شیفت مشخص"
            :response='json_encode([
        "status" => "success",
        "shift" => [
            "id" => 1,
            "doctor_id" => 1,
            "day" => 0,
            "start_time" => "10:00",
            "end_time" => "13:00",
            "duration" => 30
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "message" => "Shift not found",
        "errors" => [
            "day" => ["روز باید عدد بین 0 تا 6 باشد"],
            "start_time" => ["فرمت زمان شروع معتبر نیست"],
            "end_time" => ["زمان پایان باید بعد از زمان شروع باشد"],
            "duration" => ["مدت زمان باید بین 1 تا 60 دقیقه باشد"]
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{
    "day": 0,
    "start_time": "10:00",
    "end_time": "13:00",
    "duration": 30
}
        </x-api-card>
        <x-api-card
            id="shifts-delete"
            method="POST"
            url="/api/shifts/delete/{id}"
            title="حذف شیفت"
            desc="حذف یک شیفت مشخص"
            :response='json_encode([
        "status" => "success",
        "message" => "Shift deleted successfully."
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "message" => "Shift not found."
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{}
        </x-api-card>
    </section>
    <section id="patients" class="space-y-6">
        <h2 class="text-2xl font-semibold text-indigo-600 dark:text-indigo-300">🤕 بیمار</h2>
        <x-api-card
            id="patients-index"
            method="POST"
            url="/api/patients/index"
            title="لیست بیماران"
            desc="دریافت لیست همه بیماران"
            :response='json_encode([
        "status" => "success",
        "patients" => [
            [
                "id" => 1,
                "first_name" => "Ali",
                "last_name" => "Ahmadi",
                "national_id" => "0012345678",
                "phone" => "09123456789",
                "birth_date" => "1990-01-01",
                "gender" => "male"
            ]
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{}
        </x-api-card>
        <x-api-card
            id="patients-store"
            method="POST"
            url="/api/patients/store"
            title="ایجاد بیمار"
            desc="ثبت یک بیمار جدید"
            :response='json_encode([
        "status" => "success",
        "patient" => [
            "id" => 1,
            "first_name" => "Ali",
            "last_name" => "Ahmadi",
            "national_id" => "0012345678",
            "phone" => "09123456789",
            "birth_date" => "1990-01-01",
            "gender" => "male"
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "errors" => [
            "first_name" => ["نام الزامی است"],
            "last_name" => ["نام خانوادگی الزامی است"],
            "national_id" => ["کد ملی تکراری است یا الزامی است"],
            "phone" => ["شماره موبایل تکراری است یا الزامی است"],
            "birth_date" => ["تاریخ تولد الزامی است"],
            "gender" => ["جنسیت باید male یا female باشد"]
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{
    "first_name": "Ali",
    "last_name": "Ahmadi",
    "national_id": "0012345678",
    "phone": "09123456789",
    "birth_date": "1990-01-01",
    "gender": "male"
}
        </x-api-card>
        <x-api-card
            id="patients-show"
            method="POST"
            url="/api/patients/show/{id}"
            title="نمایش بیمار"
            desc="نمایش اطلاعات یک بیمار مشخص"
            :response='json_encode([
        "status" => "success",
        "patient" => [
            "id" => 1,
            "first_name" => "Ali",
            "last_name" => "Ahmadi",
            "national_id" => "0012345678",
            "phone" => "09123456789",
            "birth_date" => "1990-01-01",
            "gender" => "male"
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "message" => "Patient not found"
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{}
        </x-api-card>
        <x-api-card
            id="patients-update"
            method="POST"
            url="/api/patients/update/{id}"
            title="ویرایش بیمار"
            desc="ویرایش اطلاعات بیمار مشخص"
            :response='json_encode([
        "status" => "success",
        "patient" => [
            "id" => 1,
            "first_name" => "Ali Updated",
            "last_name" => "Ahmadi",
            "national_id" => "0012345678",
            "phone" => "09123456789",
            "birth_date" => "1990-01-01",
            "gender" => "male"
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "message" => "Patient not found",
        "errors" => [
            "first_name" => ["نام معتبر نیست"],
            "last_name" => ["نام خانوادگی معتبر نیست"],
            "national_id" => ["کد ملی تکراری است"],
            "phone" => ["شماره موبایل تکراری است"],
            "birth_date" => ["تاریخ تولد معتبر نیست"],
            "gender" => ["جنسیت باید male یا female باشد"]
        ]
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{
    "first_name": "Ali Updated",
    "last_name": "Ahmadi",
    "national_id": "0012345678",
    "phone": "09123456789",
    "birth_date": "1990-01-01",
    "gender": "male"
}
        </x-api-card>
        <x-api-card
            id="patients-delete"
            method="POST"
            url="/api/patients/delete/{id}"
            title="حذف بیمار"
            desc="حذف بیمار مشخص"
            :response='json_encode([
        "status" => "success",
        "message" => "Patient deleted successfully"
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
        "status" => "error",
        "message" => "Patient not found"
    ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
{}
        </x-api-card>
    </section>
</main>

<script>
    function toggleAccordion(button) {
        const ul = button.nextElementSibling;
        const icon = button.querySelector('span');
        ul.classList.toggle('hidden');
        icon.classList.toggle('rotate-90');
    }

    document.getElementById('themeToggle').addEventListener('click', () => {
        document.body.classList.toggle('dark');
    });
</script>
</body>
</html>
