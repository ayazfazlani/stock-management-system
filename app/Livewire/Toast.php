<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Toast extends Component
{
    public $toasts = [];

    #[On('notify')]
    public function notify($message, $type = 'success')
    {
        $id = uniqid();
        $this->toasts[$id] = [
            'id' => $id,
            'message' => $message,
            'type' => $type,
        ];

        // Auto-remove toast after 3 seconds
        $this->dispatch('toast-timeout', id: $id);
    }

    #[On('remove-toast')]
    public function removeToast($id)
    {
        unset($this->toasts[$id]);
    }

    public function render()
    {
        return view('livewire.toast');
    }
}
