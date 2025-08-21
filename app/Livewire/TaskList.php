<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskList extends Component
{
    public $tasks;
    public $showTaskForm = false;

    public function mount()
    {
        $this->refreshTask();
    }
    public function openForm()
    {
        $this->showTaskForm = true;
    }
    #[On('closeModal')]
    public function closeForm()
    {
        $this->showTaskForm = false;
    }
    #[On('taskAdded')]
    public function refreshTask()
    {
        $this->tasks = Task::latest()->get();
    }
    public function render()
    {
        return view('livewire.task-list');
    }
}
