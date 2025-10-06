<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Project Kamandi') }}</title>

    <!-- فونت و استایل -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-50 text-gray-800">
<div class="relative min-h-screen flex flex-col items-center justify-center px-6">
    <div class="text-center max-w-2xl">
        <!-- لوگوی فرضی -->
        <div class="mb-6">
            <!-- لوگوی وسط‌چین -->
            <div class="  w-full h-full flex items-center justify-center pointer-events-none z-0">
                <svg width="600" height="600" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="titleDesc">
                    <title id="titleDesc">Illustration of a doctor</title>

                    <!-- Coat -->
                    <g id="coat" transform="translate(0,90)">
                        <path d="M120 420 C120 340,160 300,300 300 C440 300,480 340,480 420 L480 520 L120 520 Z"
                              fill="#ffffff" stroke="#e6e6e6" stroke-width="4" />
                        <!-- coat collars -->
                        <path d="M210 330 L270 360 L300 340 L270 320 Z" fill="#ffffff" stroke="#dcdcdc" stroke-width="3"/>
                        <path d="M390 330 L330 360 L300 340 L330 320 Z" fill="#ffffff" stroke="#dcdcdc" stroke-width="3"/>
                        <!-- Name badge -->
                        <rect x="380" y="360" width="70" height="40" rx="6" fill="#f8f9fb" stroke="#d1d5db" stroke-width="2"/>
                        <rect x="388" y="368" width="50" height="8" rx="3" fill="#dbe8ff"/>
                        <rect x="388" y="380" width="35" height="6" rx="3" fill="#bcd0f5"/>
                    </g>

                    <!-- Shirt -->
                    <g id="shirt" transform="translate(0,90)">
                        <path d="M260 330 L300 360 L340 330 L340 420 L260 420 Z" fill="#cfe8ff"/>
                    </g>

                    <!-- Tie (روی یقه) -->
                    <g id="tie" transform="translate(0,90)">
                        <!-- knot -->
                        <polygon points="290,340 310,340 300,360" fill="#1c2f4a"/>
                        <!-- body -->
                        <polygon points="290,360 310,360 320,420 280,420" fill="#1c2f4a"/>
                    </g>

                    <!-- Neck -->
                    <rect x="270" y="240" width="60" height="28" rx="8" fill="#f0be9a" />

                    <!-- Head -->
                    <g id="head" transform="translate(0,70)">
                        <ellipse cx="300" cy="200" rx="85" ry="100" fill="#f9cda9" />
                        <!-- ears -->
                        <ellipse cx="215" cy="205" rx="14" ry="20" fill="#f9cda9"/>
                        <ellipse cx="385" cy="205" rx="14" ry="20" fill="#f9cda9"/>
                        <!-- hair -->
                        <path d="M215 170 C230 120,270 100,300 100 C340 100,380 120,390 170 C360 150,320 140,300 140 C270 140,240 150,215 170 Z"
                              fill="#2f3640"/>
                        <!-- eyebrows -->
                        <path d="M250 200 q18 -10 36 0" stroke="#2f3640" stroke-width="6" stroke-linecap="round" fill="none"/>
                        <path d="M330 200 q18 -10 36 0" stroke="#2f3640" stroke-width="6" stroke-linecap="round" fill="none"/>
                        <!-- eyes -->
                        <circle cx="270" cy="215" r="8" fill="#222"/>
                        <circle cx="330" cy="215" r="8" fill="#222"/>
                        <!-- nose -->
                        <path d="M300 220 q8 18 -6 28" stroke="#e09a74" stroke-width="3" stroke-linecap="round" fill="none"/>
                        <!-- smile -->
                        <path d="M275 250 q25 18 50 0" stroke="#cc8b66" stroke-width="4" stroke-linecap="round" fill="none"/>
                        <!-- cheeks -->
                        <ellipse cx="250" cy="240" rx="8" ry="5" fill="#ffd8c0" opacity="0.6"/>
                        <ellipse cx="350" cy="240" rx="8" ry="5" fill="#ffd8c0" opacity="0.6"/>
                    </g>

                    <!-- Stethoscope -->
                    <g id="stethoscope" transform="translate(0,90)">
                        <!-- Tubes -->
                        <path d="M235 315 C240 360,260 380,290 390" stroke="#2b2f36" stroke-width="8" stroke-linecap="round" fill="none"/>
                        <path d="M365 315 C360 360,340 380,310 390" stroke="#2b2f36" stroke-width="8" stroke-linecap="round" fill="none"/>
                        <!-- connector -->
                        <path d="M290 390 C300 392,310 392,320 390" stroke="#2b2f36" stroke-width="6" stroke-linecap="round" fill="none"/>
                        <!-- diaphragm (گوشی) متصل به لوله -->
                        <circle cx="305" cy="395" r="10" fill="#2b2f36"/>
                        <circle cx="305" cy="395" r="6" fill="#ecf0f2" stroke="#61666b" stroke-width="3"/>
                        <!-- main chest piece -->
                        <circle cx="340" cy="420" r="26" fill="#ecf0f2" stroke="#61666b" stroke-width="6"/>
                        <circle cx="340" cy="420" r="10" fill="#d7dbe0"/>
                        <!-- connection line to diaphragm -->
                        <line x1="305" y1="395" x2="340" y2="420" stroke="#2b2f36" stroke-width="5" stroke-linecap="round"/>
                    </g>
                </svg>


            </div>

        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-4">
            پروژه دکتر کمندی
        </h1>

        <p class="text-lg leading-relaxed text-gray-600 mb-8">
            این وبسایت صرفاً یک درگاه برای استفاده از <span class="font-semibold text-indigo-600">APIهای رسمی</span> پروژه است.
            <br> لطفاً برای دسترسی به داده‌ها یا سرویس‌ها، از کلیدها و مسیرهای امن ارائه شده استفاده کنید.
        </p>

        <!-- دکمه مستندات -->
        <a href="{{ route('docs') }}"
           class="inline-block px-6 py-3 bg-indigo-600 text-white font-medium rounded-lg shadow hover:bg-indigo-700 transition">
            مشاهده مستندات API
        </a>
    </div>

    <!-- فوتر -->
    <footer class="absolute bottom-4 text-sm text-gray-500">
        &copy; {{ date('Y') }} پروژه دکتر کمندی – همه حقوق محفوظ است.
    </footer>
</div>
</body>
</html>
