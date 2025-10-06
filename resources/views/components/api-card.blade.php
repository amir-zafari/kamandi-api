<div id="{{ $id ?? '' }}" class="bg-white shadow rounded-lg p-6 border hover:shadow-lg transition space-y-6">    <!-- عنوان -->
    <h3 class="font-semibold text-lg text-indigo-700">{{ $title }}</h3>

    <!-- متد و URL -->
    <div dir="ltr" class="flex items-center gap-2 mb-2">
        <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded font-bold">{{ $method }}</span>
        <code class="bg-gray-100 px-3 py-1 rounded">{{ $url }}</code>
    </div>

    <!-- توضیح -->
    <p class="text-gray-600">{{ $desc }}</p>

    <!-- ورودی -->
    @if(isset($slot) && trim($slot) !== '')
        <div>
            <h4 class="font-semibold text-gray-700 mb-2">🔹 درخواست (Request):</h4>
            <pre dir="ltr" class="bg-gray-900 text-green-400 text-sm p-4 rounded overflow-x-auto text-left">{{ $slot }}</pre>
        </div>
    @endif

    <!-- خروجی -->
    @if(isset($response))
        <div>
            <h4 class="font-semibold text-gray-700 mb-2">✅ پاسخ (Response):</h4>
            <pre dir="ltr" class="bg-gray-900 text-blue-400 text-sm p-4 rounded overflow-x-auto text-left">{{ $response }}</pre>
        </div>
    @endif

    <!-- ارورها -->
    @if(isset($errors))
        <div>
            <h4 class="font-semibold text-gray-700 mb-2">⚠️ خطاها (Errors):</h4>
            <pre dir="ltr" class="bg-gray-900 text-red-400 text-sm p-4 rounded overflow-x-auto text-left">{{ $errors }}</pre>
        </div>
    @endif

</div>
