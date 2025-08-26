<?php

    namespace App\Livewire;

    use App\Models\Project;
    use Illuminate\Support\Facades\Auth;
    use Livewire\Attributes\On;
    use Livewire\Attributes\Rule;
    use Livewire\Component;

    class ProjectForm extends Component
    {
        public $projectId = null;
        public $modalName = 'createProjectForm';

        #[Rule('required|min:3|max:255')]
        public $name = '';

        #[Rule('nullable|max:1000')]
        public $description = '';

        public function mount($projectId = null, $modalName = 'createProjectForm')
        {
            $this->projectId = $projectId;
            $this->modalName = $modalName;

            if ($this->projectId) {
                $project = Project::find($this->projectId);
                $this->name = $project->name;
                $this->description = $project->description;
            }
        }

        public function save()
        {
            $this->validate();

            if ($this->projectId) {
                $project = Project::find($this->projectId);
                $project->update([
                    'name' => $this->name,
                    'description' => $this->description,
                ]);

                $message = 'Project updated successfully';
            } else {
                Project::create([
                    'name' => $this->name,
                    'description' => $this->description,
                    'user_id' => Auth::id(),
                ]);

                $message = 'Project created successfully';
            }

            $this->dispatch('closeModal');
            $this->dispatch('toast', type: 'success', message: $message);
            $this->dispatch('projectAdded');
            $this->reset(['name', 'description']);
        }

        public function render()
        {
            return view('livewire.project-form');
        }
    }
