<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class ProjectList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $showProjectForm = false;

    protected $paginationTheme = 'tailwind';

    protected $listeners = [
        'projectUpdated' => '$refresh',
        'projectCreated' => '$refresh',
        'projectDeleted' => '$refresh',
    ];

    public function openForm()
    {
        $this->showProjectForm = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function show(Project $project)
    {
        // Check if the current user has permission to view this project
        if ($project->owner_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('projects.show', compact('project'));
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }


    #[Computed]
    public function projects()
    {
        return Project::query()
            ->where('owner_id', Auth::id())
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);
    }

    // And simplify your render method
    public function render()
    {
        return view('livewire.project-list');
    }
}
