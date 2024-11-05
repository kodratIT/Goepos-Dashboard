<?php

namespace App\Livewire\Backend\Notifications;

use Livewire\Component;

class EditNotification extends Component
{
    public $newNotification = [
        'id' => '',
        'background' => '',
        'icon' => '',
        'iconColor' => '',
        'message' => [
            'in' => ['text' => ''],
            'en' => ['text' => ''],
            'es' => ['text' => ''],
            'hi' => ['text' => ''],
            'de' => ['text' => ''],
        ],
        'title' => [
            'in' => ['text' => ''],
            'en' => ['text' => ''],
            'es' => ['text' => ''],
            'hi' => ['text' => ''],
            'de' => ['text' => ''],
        ],
        'showUntil' => null,
        'type' => 'all',
    ];

    public $selectedLanguage = 'all'; // Menyimpan bahasa yang dipilih (default: semua bahasa)

    public $languages = [ // Daftar bahasa yang didukung
        'in' => 'Indonesian',
        'en' => 'English',
        'es' => 'Spanish',
        'hi' => 'Hindi',
        'de' => 'German',
    ];

    public function saveNotification()
    {
        // Validasi data notifikasi
        $this->validate([
            'newNotification.id' => 'required|string',
            'newNotification.background' => 'required|string',
            'newNotification.icon' => 'nullable|string',
            'newNotification.iconColor' => 'nullable|string',
            'newNotification.message.*.text' => 'required|string',
            'newNotification.title.*.text' => 'required|string',
            'newNotification.showUntil' => 'nullable|date',
            'newNotification.type' => 'required|in:all,specific',
        ]);

        // Simpan data notifikasi baru (contohnya dalam database atau collection Firebase)
        // Notification::create($this->newNotification); // Sesuaikan dengan penyimpanan yang digunakan

        // Redirect ke halaman daftar notifikasi setelah menyimpan
        return redirect()->route('notifications.list');
    }

    public function render()
    {
        return view('livewire.backend.notifications.edit-notification')->layout('layouts.app');
    }
}
