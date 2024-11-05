<?php

namespace App\Livewire\Backend\Components\Notifications;

use Livewire\Component;

class NotificationTable extends Component
{
    public $notifications; // Menerima data dari komponen induk

    public function render()
    {
        return view('livewire.backend.components.notifications.notification-table');
    }
}
