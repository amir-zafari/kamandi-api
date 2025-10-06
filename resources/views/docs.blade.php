<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مستندات API | پروژه دکتر کمندی</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- فونت وزیر -->
    <link href="https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            font-family: Vazir, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex">

<!-- محتوای اصلی -->
<main class="flex-1 p-10 space-y-10 mr-64"> <!-- اینجا mr-64 اضافه شد -->
    <h1 class="text-4xl font-bold text-indigo-700 mb-10">📘 مستندات API</h1>

    <!-- دسته: Auth -->
    <section id="auth" class="space-y-10">
        <h2 class="text-2xl font-semibold text-indigo-600 ">🔐 احراز هویت</h2>
        <x-api-card
            id="register"
            method="POST"
            url="/api/register"
            title="ثبت‌نام کاربر"
            desc="کاربر جدید را ثبت می‌کند"
            :response='json_encode([
                "status" => "success",
                "user" => ["id" => 1, "name" => "Ali", "email" => "ali@example.com"],
                "token" => "abcdef123456"
            ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
                "error" => "ایمیل تکراری است",
                "code" => 422
            ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE),'
        >
{
    "name": "Ali",
    "email": "ali@example.com",
    "password": "12345678"
}
        </x-api-card>
        <x-api-card
            method="POST"
            url="/api/register"
            title="ثبت‌نام کاربر"
            desc="کاربر جدید را ثبت می‌کند"
            :response='json_encode([
                "status" => "success",
                "user" => ["id" => 1, "name" => "Ali", "email" => "ali@example.com"],
                "token" => "abcdef123456"
            ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
            :errors='json_encode([
                "error" => "ایمیل تکراری است",
                "code" => 422
            ], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)'
        >
            {
            "name": "Ali",
            "email": "ali@example.com",
            "password": "12345678"
            }
        </x-api-card>
    </section>

    <!-- دسته: Doctors -->
    <section id="doctors" class="space-y-6">
        <h2 class="text-2xl font-semibold text-indigo-600">👨‍⚕️ دکترها</h2>

        <div class="bg-white shadow rounded-lg p-6 border hover:shadow-lg transition">
            <h3 class="font-semibold text-lg">ثبت دکتر</h3>
            <div class="flex items-center gap-2 mb-2">
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded font-bold">POST</span>
                <code class="bg-gray-100 px-3 py-1 rounded">/api/doctors/store</code>
            </div>
            <p class="text-gray-600 mb-3">یک دکتر جدید ثبت می‌شود.</p>
        </div>
    </section>
</main>

<!-- سایدبار سمت راست -->
<aside class="w-64 h-screen bg-white shadow-lg border-l border-gray-200 fixed right-0 top-0">
    <div class="p-6">
        <h2 class="text-xl font-bold text-indigo-700 mb-6">📑 دسته‌بندی API</h2>
        <nav class="space-y-4 text-gray-700">

            <!-- بخش احراز هویت -->
            <div>
                <a href="#auth" class="block hover:text-indigo-600 transition font-semibold">🔐 احراز هویت</a>
                <ul class="ml-6 mt-2 space-y-2 text-sm text-gray-600">
                    <li><a href="#login" class="block hover:text-indigo-500">ورود</a></li>
                    <li><a href="#register" class="block hover:text-indigo-500">ثبت‌نام</a></li>
                    <li><a href="#logout" class="block hover:text-indigo-500">خروج</a></li>
                </ul>
            </div>

            <!-- بخش دکترها -->
            <div>
                <a href="#doctors" class="block hover:text-indigo-600 transition font-semibold">👨‍⚕️ دکترها</a>
                <ul class="ml-6 mt-2 space-y-2 text-sm text-gray-600">
                    <li><a href="#doctors-index" class="block hover:text-indigo-500">لیست دکترها</a></li>
                    <li><a href="#doctors-store" class="block hover:text-indigo-500">ثبت دکتر جدید</a></li>
                    <li><a href="#doctors-update" class="block hover:text-indigo-500">ویرایش دکتر</a></li>
                    <li><a href="#doctors-delete" class="block hover:text-indigo-500">حذف دکتر</a></li>
                </ul>
            </div>

            <!-- بخش شیفت‌ها -->
            <div>
                <a href="#shifts" class="block hover:text-indigo-600 transition font-semibold">🕒 شیفت‌ها</a>
                <ul class="ml-6 mt-2 space-y-2 text-sm text-gray-600">
                    <li><a href="#shifts-index" class="block hover:text-indigo-500">لیست شیفت‌ها</a></li>
                    <li><a href="#shifts-store" class="block hover:text-indigo-500">ثبت شیفت</a></li>
                    <li><a href="#shifts-show" class="block hover:text-indigo-500">نمایش نوبت‌ها</a></li>
                    <li><a href="#shifts-delete" class="block hover:text-indigo-500">حذف شیفت</a></li>
                </ul>
            </div>

        </nav>
    </div>

</aside>
</body>
</html>
