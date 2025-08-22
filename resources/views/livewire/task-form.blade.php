<div class="p-4">
    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <flux:input type="text" label="Title" wire:model="title"/>
            {{--            @error('title') <span class="text-red-500">{{$message}}</span> @enderror--}}
        </div>
        <div>
            <flux:textarea wire:model="description" label="Description"
                           placeholder="Describe you task here"></flux:textarea>
        </div>
        <div>
            <flux:select wire:model="status" label="Status" placeholder="Choose an option status">
                <flux:select.option value="pending">Pending</flux:select.option>
                <flux:select.option value="in_progress">In progress</flux:select.option>
                <flux:select.option value="completed">Completed</flux:select.option>
            </flux:select>
            {{--            @error('status') <span class="text-red-500">{{$message}}</span> @enderror--}}
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Due Date *</label>
            <input
                type="date"
                wire:model="due_date"
                class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            >
            @error('due_date') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

{{--        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">--}}
{{--            Save--}}
{{--        </button>--}}
        <div class="flex gap-2">
            <flux:spacer/>
            <flux:modal.close>
                <flux:button wire:click="cancel" class="hover:bg-red-500">Cancel</flux:button>
            </flux:modal.close>

            <flux:button type="submit" class="bg-green-400 text-white hover:bg-green-600">
                Save
            </flux:button>

        </div>
    </form>
</div>

