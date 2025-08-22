<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskForm extends Component
{
    public $title, $description, $status='', $due_date;
    protected $rules = [
        'title' => 'required|string|max:255',
        'status' => 'required|in:pending,in_progress,completed',
        'due_date' => 'required|date'
    ];
    public function submit()
    {
        $this->validate();
        Task::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'due_date' => $this->due_date
        ]);
        $this->reset();
        $this->dispatch('taskAdded');
        $this->dispatch('closeModal');
    }
    public function render()
    {
        return view('livewire.task-form');
    }
}
