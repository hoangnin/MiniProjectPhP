<div class="flex justify-center w-full">
    <div class="w-[65%]">
        <div class="flex items-center justify-between py-4 px-8 bg-white">
            <button wire:click="openForm"
                    class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                <flux:icon name="clipboard-plus" class="w-5 h-5"/>
                <span>Create Project</span>
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
                       class="block ps-10 pe-8 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Search for projects">

                <div class="absolute top-1/2 right-4 transform -translate-y-1/2" wire:loading.delay.shortest
                     wire:target="search">
                    <div role="status">
                        <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin fill-blue-600"
                             viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
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
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center cursor-pointer" wire:click="sortBy('name')">
                            Name
                            @if($sortField === 'name')
                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="{{ $sortDirection === 'asc' ? '...' : '...' }}"/>
                                </svg>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($this->projects as $project)
                    <tr class="bg-white border-b hover:bg-gray-50" wire:key="project-{{ $project->id }}">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-{{ $project->id }}" type="checkbox"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="checkbox-{{ $project->id }}" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <a href="{{ route('projects.show', $project->id) }}" class="hover:text-blue-600 hover:underline">
                                {{ $project->name }}
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            {{ Str::limit($project->description, 50) }}
                        </td>
                        <td class="px-6 py-4">
                            {{-- edit modal --}}
                            <flux:modal.trigger name="update-project-{{$project->id}}">
                                <flux:button variant="ghost" size="sm">
                                    <flux:icon name="square-pen" color="green" class="w-4 h-4" />
                                </flux:button>
                            </flux:modal.trigger>
                            <flux:modal name="update-project-{{$project->id}}" class="md:w-screen" container-class="w-full">
                                <livewire:project-form :projectId="$project->id" :modalName="'update-project-'.$project->id" :key="'project-form-'.$project->id"/>
                            </flux:modal>

                            {{-- delete modal --}}
                            <livewire:confirm-modal
                                :key="'delete-project-'.$project->id"
                                name="delete-project-{{$project->id}}"
                                model="App\Models\Project"
                                :modelId="$project->id"
                                title="Delete Project?"
                                :message="'<p>Are you sure want to delete <strong>'.$project->name.'</strong>?<p>'"
                                confirmText="Delete"
                            />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4 px-6">
                {{ $this->projects->links('vendor.pagination.tailwind') }}
            </div>
        </div>

        {{-- create project modal --}}
        <flux:modal wire:model="showProjectForm" name="createProjectForm" class="md:w-screen" container-class="w-full">
            <livewire:project-form/>
        </flux:modal>
    </div>
</div>
