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
     x-data="{ show: false, type: 'success', message: '' }"
     x-init="
        window.addEventListener('toast', (event) => {
            type = event.detail.type;
            message = event.detail.message;
            show = true;
            setTimeout(() => { show = false }, 5000);
        })
     ">
    <div x-show="show"
         x-transition:enter="transform ease-out duration-300"
         x-transition:enter-start="translate-x-20 opacity-0"
         x-transition:enter-end="translate-x-0 opacity-100"
         x-transition:leave="transform ease-in duration-300"
         x-transition:leave-start="translate-x-0 opacity-100"
         x-transition:leave-end="translate-x-20 opacity-0">
        <x-toast :type="'x-text: type'" :message="'x-text: message'"/>
    </div>
</div>

@fluxScripts
</body>
</html>
