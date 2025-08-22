<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskList extends Component
{
    public $search = '';
    public $showTaskForm = false;
    public $statusFilter = [];
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function openForm()
    {
        $this->showTaskForm = true;
    }

    #[On('closeModal')]
    public function closeForm()
    {
        $this->showTaskForm = false;
    }
    #[On('itemDeleted')]
    #[On('taskAdded')]
    public function refreshList()
    {
        // chỉ cần để trống -> Livewire sẽ re-render component
    }

    #[Computed]
    public function tasks()
    {
        return Task::query()
            ->when($this->search, function ($q) {
                $q->where(function ($w) {
                    $w->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('description', 'like', '%'.$this->search.'%');
                });
            })
            ->latest()
            ->get();
    }



    public function render()
    {
        return view('livewire.task-list');
    }
}
