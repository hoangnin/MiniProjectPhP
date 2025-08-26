<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskForm extends Component
{
    public $title, $description, $status = '', $due_date, $taskId = null;
    public $modalName;
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:pending,in_progress,completed',
        'due_date' => 'required|date|after_or_equal:today'
    ];

    public function mount($taskId = null)
    {
        if ($taskId) {
            $task = Task::findOrFail($taskId);
            $this->taskId = $task->id;
            $this->title = $task->title;
            $this->description = $task->description;
            $this->status = $task->status;
            $this->due_date = $task->due_date
                ? $task->due_date->format('Y-m-d')
                : null;
        }
    }

    public function submit()
    {
        $this->validate();
        if ($this->taskId) {
            // Update
            $task = Task::findOrFail($this->taskId);
            $task->update([
                'title' => $this->title,
                'description' => $this->description,
                'status' => $this->status,
                'due_date' => $this->due_date ? \Carbon\Carbon::parse($this->due_date) : null,
            ]);
        } else {
//            create
            Task::create([
                'user_id' => Auth::id(),
                'title' => $this->title,
                'description' => $this->description,
                'status' => $this->status,
                'due_date' => $this->due_date ? \Carbon\Carbon::parse($this->due_date) : null,
            ]);
        }
        // In TaskForm.php
        $this->dispatch('toast',
            type: $this->taskId ? 'success' : 'success',
            message: $this->taskId ? 'Task updated successfully!' : 'Task created successfully!',
            toBrowser: true
        );
        $this->reset();
        $this->dispatch('taskAdded');
        $this->dispatch('modal-close', name: $this->modalName);
    }
    public function cancel()
    {
        $this->dispatch('modal-close', name: $this->modalName);
        $this->dispatch('toast', type: 'info', message: $this->taskId? 'Task update was cancelled.' : 'Task creation was cancelled');
    }
    public function render()
    {
        return view('livewire.task-form');
    }
}
