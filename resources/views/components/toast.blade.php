@props(['type' => 'success', 'message' => ''])

@php
    $config = [
        'success' => [
            'bg' => 'text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200',
            'icon' => '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>',
        ],
        'error' => [
            'bg' => 'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200',
            'icon' => '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>',
        ],
        'warning' => [
            'bg' => 'text-orange-500 bg-orange-100 dark:bg-orange-700 dark:text-orange-200',
            'icon' => '<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>',
        ],
        'info' => [
        'bg' => 'text-blue-500 bg-blue-100 dark:bg-blue-800 dark:text-blue-200',
        'icon' => '<path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-3.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm-1 3a1 1 0 0 1 1-1h.01a1 1 0 0 1 .99 1v4a1 1 0 1 1-2 0v-4Z" clip-rule="evenodd"/>',],

    ];

    $style = $config[$type] ?? $config['success'];
@endphp

<div class="flex items-center w-80 p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg dark:text-gray-400 dark:bg-gray-800" role="alert">
    <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 {{ $style['bg'] }} rounded-lg">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">{!! $style['icon'] !!}</svg>
    </div>
    <div class="ms-3 text-sm font-normal">{{ $message }}</div>
    <button @click="show = false" type="button" class="ms-auto -mx-1.5 -my-1.5 p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>
