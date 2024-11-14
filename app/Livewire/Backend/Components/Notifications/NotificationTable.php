<?php

namespace App\Livewire\Backend\Components\Notifications;

use Livewire\Component;
use App\Models\NotificationsModel;

class NotificationTable extends Component
{
    public $notifications; // Menerima data dari komponen induk


    protected function firestore()
    {
        return new NotificationsModel();
    }
    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data ini akan dihapus secara permanen!',
            'icon' => 'warning',
            'confirmButtonText' => 'Ya, hapus!',
            'cancelButtonText' => 'Batal',
            'method' => 'deleteNotification',
            'params' => $id, // Kirim parameter ke metode deleteNotification
        ]);
    }

    public function deleteNotification($id)
    {

        try {
            // Memanggil metode Firestore untuk menghapus notifikasi

            $result = $this->firestore()->deleteNotification($id);
            // Jika berhasil
            if ($result) {
                toastr()->success('Notifikasi Berhasil Dihapus');
                   // Dispatch event ke parent untuk memuat ulang data
                $this->dispatch('reloadNotifications');
            } else {
                toastr()->error('Notifikasi Gagal Dihapus');
            }
        } catch (\Exception $e) {
            toastr()->error('Kesalahan sistem: ' . $e->getMessage());
        }
    }




    public function render()
    {
        return view('livewire.backend.components.notifications.notification-table');
    }
}
