<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskForm extends Component
{
    public $title, $description, $status = '', $due_date, $taskId = null;
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
        $this->reset();
        $this->dispatch('taskAdded');
        $this->dispatch('closeModal');
    }
    public function cancel()
    {
        // đúng event mà Flux modal đang lắng nghe
        $this->dispatch('modal-close', name: "createTaskForm");
    }
    public function render()
    {
        return view('livewire.task-form');
    }
}
