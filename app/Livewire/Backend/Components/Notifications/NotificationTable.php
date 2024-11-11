<?php

namespace App\Livewire\Backend\Components\Notifications;

use Livewire\Component;

class NotificationTable extends Component
{
    public $notifications; // Menerima data dari komponen induk

    public function deleteNotification($id) {
        try {
            // Ganti dengan inisialisasi Firestore yang sesuai
            // $this->firestore->collection('notifications')->document($id)->delete();

            session()->flash('message', 'Notifikasi berhasil dihapus.');
        } catch (GoogleException $e) {
            Log::error("Gagal menghapus notifikasi dengan ID $id: " . $e->getMessage());
            session()->flash('error', 'Gagal menghapus notifikasi. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.backend.components.notifications.notification-table');
    }
}
