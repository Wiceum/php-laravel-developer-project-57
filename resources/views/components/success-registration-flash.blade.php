@if(session()->has('success'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         class="fixed bottom-5 right-5 bg-blue-500 text-white font-bold py-2 px-4 rounded text-lg">
        <p>{{ session('success') }}</p>
    </div>
@endif
