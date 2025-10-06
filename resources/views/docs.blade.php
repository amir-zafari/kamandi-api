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
<main class="flex-1 p-10 space-y-10">
    <h1 class="text-4xl font-bold text-indigo-700 mb-10">📘 مستندات API</h1>

    <!-- دسته: Auth -->
    <section id="auth" class="space-y-6">
        <h2 class="text-2xl font-semibold text-indigo-600">🔐 احراز هویت</h2>

        <div class="bg-white shadow rounded-lg p-6 border hover:shadow-lg transition">
            <h3 class="font-semibold text-lg">ثبت‌نام کاربر</h3>
            <div class="flex items-center gap-2 mb-2">
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded font-bold">POST</span>
                <code class="bg-gray-100 px-3 py-1 rounded">/api/register</code>
            </div>
            <p class="text-gray-600 mb-3">کاربر جدید را ثبت می‌کند.</p>
            <pre class="bg-gray-900 text-green-400 text-sm p-4 rounded overflow-x-auto">
{
  "name": "Ali Reza",
  "email": "ali@example.com",
  "password": "12345678"
}
                </pre>
        </div>
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
            <a href="#auth" class="block hover:text-indigo-600 transition">🔐 احراز هویت</a>
            <a href="#doctors" class="block hover:text-indigo-600 transition">👨‍⚕️ دکترها</a>
            <a href="#shifts" class="block hover:text-indigo-600 transition">🕒 شیفت‌ها</a>
        </nav>
    </div>
</aside>
</body>
</html>
