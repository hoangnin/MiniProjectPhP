<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TaskList extends Component
{
    use WithPagination;
    public $search = '';
    public $showTaskForm = false;
    public $statusFilter = [];
    public $sortField = 'due_date';
    public $sortDirection = 'asc';
    public $projectId = null;

    public function mount($projectId = null)
    {
        $this->projectId = $projectId;
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
    #[On('itemDeleted')]
    #[On('taskAdded')]
    public function refreshList()
    {
        // chỉ cần để trống -> Livewire sẽ re-render component
    }
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }


    #[Computed]
    public function tasks()
    {
        return Task::query()
            ->where('user_id', Auth::id())
            ->when($this->projectId, function ($query){
                $query->where('project_id', $this->projectId);
            })
            ->when($this->search, function ($q) {
                $q->where(function ($w) {
                    $w->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('description', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);
    }

    public function updatedSearch($value)
    {
        if (trim($value) !== '' && $this->tasks()->isEmpty()) {
            $this->dispatch(
                'toast',
                type: 'error',
                message: "No tasks found for keyword: {$value}",
                toBrowser: true
            );
        }
    }




    public function render()
    {
        return view('livewire.task-list');
    }
}
