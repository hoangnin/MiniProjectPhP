<div class="flex justify-center w-full">
    <div class="w-[65%]">
        <div class="flex items-center justify-between py-4 px-8 bg-white">
            <button wire:click="openForm"
                    class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                <flux:icon name="clipboard-plus" class="w-5 h-5"/>
                <span>Create Task</span>
            </button>

            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>

                <input type="text"
                       wire:model.live.debounce.300ms="search"
                       class="block ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Search for tasks">

                {{-- loader khi đang search --}}
                <div class="absolute inset-y-0 right-3 flex items-center" wire:loading.delay.shortest
                     wire:target="search">
                    <svg class="animate-spin h-4 w-4 text-gray-400" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" fill="none" stroke-width="4"
                                opacity=".25"/>
                        <path d="M22 12a10 10 0 0 1-10 10" fill="currentColor"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all" type="checkbox"
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="checkbox-all" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Due Date</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($this->tasks as $task)
                    <tr class="bg-white border-b hover:bg-gray-50" wire:key="task-{{ $task->id }}">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-{{ $task->id }}" type="checkbox"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="checkbox-{{ $task->id }}" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $task->title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ Str::limit($task->description, 50) }}
                        </td>
                        <td class="px-6 py-4">
                            @if($task->status === 'completed')
                                <flux:badge variant="solid" color="green">Completed</flux:badge>
                            @elseif($task->status === 'in_progress')
                                <flux:badge variant="solid" color="blue">In Progress</flux:badge>
                            @else
                                <flux:badge variant="solid" color="yellow">Pending</flux:badge>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{--task form--}}
                            <flux:modal.trigger name="update-task-{{$task->id}}">
                                <flux:button variant="ghost" size="sm">
                                    <flux:icon name="square-pen" color="green" class="w-4 h-4" />
                                </flux:button>
                            </flux:modal.trigger>
                            <flux:modal name="update-task-{{$task->id}}" class="md:w-screen" container-class="w-full">
                                <livewire:task-form :taskId="$task->id" :modalName="'update-task-'.$task->id" :key="'task-form-'.$task->id"/>
                            </flux:modal>

                            {{--confirm model--}}
                            <flux:modal.trigger name="delete-task-{{$task->id}}">
                                <flux:button variant="ghost" size="sm">
                                    <flux:icon name="trash-2" color="red" class="w-4 h-4" />
                                </flux:button>
                            </flux:modal.trigger>
                            <livewire:confirm-modal
                                :key="'delete-task-'.$task->id"
                                name="delete-task-{{$task->id}}"
                                model="App\Models\Task"
                                :modelId="$task->id"
                                title="Delete Task?"
                                :message="'<p>Are you sure want to delete <strong>'.$task->title.'</strong>?<p>'"
                                confirmText="Delete"
                            />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <flux:modal wire:model="showTaskForm" name="createTaskForm" class="md:w-screen" container-class="w-full">
            <livewire:task-form/>
        </flux:modal>
    </div>
</div>
