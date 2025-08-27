<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $project->name }}
            </h2>
            <a href="{{ route('projects.index') }}" class="text-blue-600 hover:underline text-sm">
                &larr; Back to Projects
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        <div class="mb-6 p-4 bg-white rounded-lg shadow">
            <h3 class="text-lg font-medium">Description</h3>
            <p class="mt-2">{{ $project->description }}</p>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-medium mb-4">Project Tasks</h3>
            <livewire:task-list :projectId="$project->id" />
        </div>
    </div>
</x-app-layout>
