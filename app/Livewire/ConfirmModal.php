<?php

namespace App\Livewire;

use Livewire\Component;

class ConfirmModal extends Component
{
    public $name;   // modal name
    public $model;  // class model (App\models\Task)
    public $modelId;
    public $title = 'Confirm';
    public $message = 'Are you sure?';
    public $confirmText = 'Delete';
    public $confirmVariant = 'danger';

    public function confirm()
    {
        if ($this->model &&$this->modelId){
            $modelClass = $this->model;
            $item = $modelClass::find($this->modelId);

            if ($item){
                $item->delete();
                $this->dispatch('itemDeleted', id: $this->modelId);
            }
            $this->dispatch(
                'toast',
                [
                    'type' => 'success',
                    'message' => 'Task deleted successfully!'
                ],
                toBrowser: true
            );

        }
        $this->dispatch('modal-close', name: $this->name);
    }


    public function cancel()
    {
        // đúng event mà Flux modal đang lắng nghe
        $this->dispatch('modal-close', name: $this->name);
    }
    public function render()
    {
        return view('livewire.confirm-modal');
    }
}
