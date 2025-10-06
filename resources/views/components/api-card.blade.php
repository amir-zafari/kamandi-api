<div id="{{ $id ?? '' }}" class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 shadow rounded-lg p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition space-y-6">
    <h3 class="font-semibold text-lg text-indigo-700 dark:text-indigo-300">{{ $title }}</h3>
    <div dir="ltr" class="flex items-center gap-2 mb-2">
        <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded font-bold dark:bg-indigo-800 dark:text-indigo-100">{{ $method }}</span>
        <code class="bg-gray-100 dark:bg-gray-700 dark:text-gray-100 px-3 py-1 rounded">{{ $url }}</code>
    </div>
    <p class="text-gray-600 dark:text-gray-300">{{ $desc }}</p>
    @if(isset($slot) && trim($slot) !== '')
        <div>
            <h4 class="font-semibold text-gray-700 dark:text-gray-200 mb-2">🔹 درخواست (Request):</h4>
            <pre dir="ltr" class="bg-gray-100 dark:bg-gray-900 dark:text-green-400 text-sm p-4 rounded overflow-x-auto text-left">{{ $slot }}</pre>
        </div>
    @endif
    @if(isset($response))
        <div>
            <h4 class="font-semibold text-gray-700 dark:text-gray-200 mb-2">✅ پاسخ (Response):</h4>
            <pre dir="ltr" class="bg-gray-100 dark:bg-gray-900 dark:text-blue-400 text-sm p-4 rounded overflow-x-auto text-left">{{ $response }}</pre>
        </div>
    @endif
    @if(isset($errors))
        <div>
            <h4 class="font-semibold text-gray-700 dark:text-gray-200 mb-2">⚠️ خطاها (Errors):</h4>
            <pre dir="ltr" class="bg-gray-100 dark:bg-gray-900 dark:text-red-400 text-sm p-4 rounded overflow-x-auto text-left">{{ $errors }}</pre>
        </div>
    @endif
</div>
