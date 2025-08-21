<div class="p-4">
    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <label class="block">Title</label>
            <input type="text" wire:model="title" class="w-full border rounded p-2">
            @error('title') <span class="text-red-500">{{$message}}</span> @enderror
        </div>
        <div>
            <label class="block">Description</label>
            <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
        </div>
        <div>
            <label class="block">Status *</label>
            <select wire:model="status" class="w-full border rounded p-2">
                <option>-- Select --</option>
                <option value="pending">Pending</option>
                <option value="in_progress">In progress</option>
                <option value="completed">Completed</option>
            </select>
            @error('status') <span class="text-red-500">{{$message}}</span> @enderror
        </div>
        <div>
            <label class="block">Due Date *</label>
            <input type="date" wire:model="due_date" class="w-full border rounded p-2">
            @error('due_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>
</div>
