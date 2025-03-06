<?php

namespace App\Livewire;

use Livewire\Component;


class SuccessNotificationButton extends Component
{
    public $showMessage = false;

    public function showNotification()
    {
        $this->showMessage = true;
    }

    public function render()
    {
        return view('livewire.success-notification-button');
    }
}
