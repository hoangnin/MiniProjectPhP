<div class="p-6">
    <h2 class="text-lg font-medium text-gray-900">
        {{ $projectId ? 'Update Project' : 'Create New Project' }}
    </h2>

    <form wire:submit="save" class="mt-6">
        <div class="mt-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" wire:model="name"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" wire:model="description" rows="4"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
            @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6 flex justify-end">
            <flux:button type="button" wire:click="$dispatch('closeModal')" variant="outline" class="mr-3">
                Cancel
            </flux:button>
            <flux:button type="submit">
                {{ $projectId ? 'Update' : 'Create' }}
            </flux:button>
        </div>
    </form>
</div>
