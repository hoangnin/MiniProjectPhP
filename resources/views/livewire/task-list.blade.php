<div>
    <button wire:click="openForm" class="bg-lime-500 text-black px-4 py-2 rounded">
        + Create Task
    </button>

{{--    use only tailwindcss--}}
{{--    <ul class="mt-4 space-y-2">--}}
{{--        @foreach($tasks as $task)--}}
{{--            <li class="p-2 border rounded">{{$task->title}} - {{$task->status}}</li>--}}
{{--        @endforeach--}}
{{--    </ul>--}}

{{--    use flux component--}}
    <table class="min-w-full border">
        <thead>
        <tr class="bg-gray-200">
            <th class="p-2">Title</th>
            <th class="p-2">Description</th>
            <th class="p-2">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr class="border-t">
                <td class="p-2">{{ $task->title }}</td>
                <td class="p-2">{{ $task->description }}</td>
                <td class="p-2">
                    <span class="@if($task->status==='completed') text-green-600
                                 @elseif($task->status==='pending') text-yellow-600
                                 @else text-gray-600 @endif">
                        {{ $task->status }}
                    </span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>



    <flux:modal wire:model="showTaskForm">
        <livewire:task-form/>
    </flux:modal>
</div>
