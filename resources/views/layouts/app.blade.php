<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    <livewire:layout.navigation/>

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

{{-- Toast Container --}}
<div id="toast-container" class="fixed bottom-4 right-4 z-50"
     x-data="{
        show: false,
        type: 'success',
        message: '',
        showToast(type, message) {
            this.type = type;
            this.message = message;
            this.show = true;
            setTimeout(() => { this.show = false }, 5000);
        }
     }"
     @toast.window="
        console.log('Toast event received:', $event.detail);
        showToast($event.detail.type || 'success', $event.detail.message || '');
     ">
    <div x-show="show"
         x-transition:enter="transform ease-out duration-300"
         x-transition:enter-start="translate-x-20 opacity-0"
         x-transition:enter-end="translate-x-0 opacity-100"
         x-transition:leave="transform ease-in duration-300"
         x-transition:leave-start="translate-x-0 opacity-100"
         x-transition:leave-end="translate-x-20 opacity-0">
        <div class="flex items-center w-80 p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg" role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 rounded-lg"
                 :class="{
                    'text-green-500 bg-green-100': type === 'success',
                    'text-red-500 bg-red-100': type === 'error',
                    'text-orange-500 bg-orange-100': type === 'warning'
                 }">
                <template x-if="type === 'success'">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                </template>
                <template x-if="type === 'error'">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                    </svg>
                </template>
                <template x-if="type === 'warning'">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                    </svg>
                </template>
            </div>
            <div class="ms-3 text-sm font-normal" x-text="message"></div>
            <button @click="show = false" type="button" class="ms-auto -mx-1.5 -my-1.5 p-1.5 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>
</div>
@fluxScripts
</body>
</html>
