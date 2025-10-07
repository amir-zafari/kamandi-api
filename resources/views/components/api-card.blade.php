@php
    $methodColor = match(strtoupper($method)) {
        'GET' => 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100',
        'POST' => 'bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100',
        'PUT', 'PATCH' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100',
        'DELETE' => 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100',
        default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100',
    };
@endphp

<div id="{{ $id ?? '' }}" class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 shadow rounded-lg p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition space-y-6">

    <!-- عنوان -->
    <h3 class="font-semibold text-lg text-indigo-700 dark:text-indigo-300">{{ $title }}</h3>

    <!-- متد و URL -->
    <div dir="ltr" class="flex items-center gap-2 mb-2">
        <span class="px-3 py-1 rounded font-bold {{ $methodColor }}">{{ strtoupper($method) }}</span>
        <code class="bg-gray-100 dark:bg-gray-700 dark:text-gray-100 px-3 py-1 rounded">{{ $url }}</code>
    </div>

    <!-- توضیح -->
    <p class="text-gray-600 dark:text-gray-300">{{ $desc }}</p>

    <!-- درخواست -->
    @if(isset($slot) && trim($slot) !== '')
        <div>
            <h4 class="font-semibold text-gray-700 dark:text-gray-200 mb-2">🔹 درخواست (Request):</h4>
            <pre dir="ltr" class="bg-gray-100 dark:bg-gray-900 dark:text-green-400 text-sm p-4 rounded overflow-x-auto text-left">{{ $slot }}</pre>
        </div>
    @endif

    <!-- پاسخ -->
    @if(isset($response))
        <div>
            <h4 class="font-semibold text-gray-700 dark:text-gray-200 mb-2">✅ پاسخ (Response):</h4>
            <pre dir="ltr" class="bg-gray-100 dark:bg-gray-900 dark:text-blue-400 text-sm p-4 rounded overflow-x-auto text-left">{{ $response }}</pre>
        </div>
    @endif

    <!-- خطاها -->
    @if(isset($errors))
        <div>
            <h4 class="font-semibold text-gray-700 dark:text-gray-200 mb-2">⚠️ خطاها (Errors):</h4>
            <pre dir="ltr" class="bg-gray-100 dark:bg-gray-900 dark:text-red-400 text-sm p-4 rounded overflow-x-auto text-left">{{ $errors }}</pre>
        </div>
    @endif
</div>
