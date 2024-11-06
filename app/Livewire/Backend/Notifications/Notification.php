<?php

namespace App\Livewire\Backend\Notifications;

use Livewire\Component;
use App\Models\NotificationsModel;

class Notification extends Component
{
    public $notifications = []; // Menyimpan data notifikasi yang dimuat
    public $perPageOptions = [ 5, 10, 15, 20, 50, 100, 250, 500, 1000];
    public $perPage = 5;
    public $hasMore = true;
    public $isLoading = false;
    public $isFilter = false;

    public $countData =0;

    protected function firestore()
    {
        return new NotificationsModel();
    }

    public function mount()
    {
        $this->loadMore(); // Memuat data awal
    }

    public function render()
    {
        return view('livewire.backend.notifications.notification', [
            'notifications' => $this->notifications,
        ])->layout('layouts.app');
    }


    public function loadData()
    {
        // Mengambil data dari Firestore dengan limit sesuai `perPage`
        $data = $this->firestore()->getAllNotifications($this->perPage);
        $this->notifications = json_decode($data, true);
    }

    public function updateDataPerPage()
    {
        // Reset data dan muat ulang berdasarkan `perPage`
        $this->isFilter = true;
        $this->notifications = []; // Reset daftar notifikasi
        $this->loadData();
        $this->isFilter = false;
    }


    public function loadMore()
    {
        $this->countData += $this->perPage;

        $this->isLoading = true;

        // Ambil data notifikasi dengan limit sesuai `perPage`
        $data = $this->firestore()->getAllNotifications($this->countData);

        $newNotifications = json_decode($data, true);

        // Filter data baru agar hanya memasukkan notifikasi yang ID-nya belum ada di daftar `notifications`
        $existingIds = array_column($this->notifications, 'id'); // Ambil semua ID yang sudah ada
        $uniqueNotifications = array_filter($newNotifications, function($notification) use ($existingIds) {
            return !in_array($notification['id'], $existingIds);
        });

        // Tambahkan data baru yang unik ke daftar notifikasi yang sudah ada
        $this->notifications = array_merge($this->notifications, $uniqueNotifications);

        $this->isLoading = false;

    }

}
