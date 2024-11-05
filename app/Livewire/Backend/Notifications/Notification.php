<?php

namespace App\Livewire\Backend\Notifications;

use Livewire\Component;

class Notification extends Component
{
    public $notifications; // Data notifikasi
    public $perPageOptions = [5, 10, 15, 20, 50, 100, 250, 500, 1000];
    public $perPage = 5;
    public $hasMore = true;
    public $isLoading = false;

    public function mount()
    {
        // Data dummy untuk notifikasi
        $this->notifications = collect([
            [
                'id' => 'notif_1',
                'background' => '#ffcccc',
                'createdAt' => now(),
                'icon' => 'https://example.com/icon1.png',
                'iconColor' => '#ff0000',
                'backgroundIconColor' => '#fff5f5',
                'message' => [
                    ['lang' => 'in', 'text' => 'Selamat datang, klik atur produk untuk mengatur daftar produk Anda', 'actionText' => 'atur produk', 'action' => 'manage_product', 'actionTextStyle' => 'bold', 'actionTextColor' => '#ff0000'],
                    ['lang' => 'en', 'text' => 'Welcome, click to manage your product list', 'actionText' => 'manage product', 'action' => 'manage_product', 'actionTextStyle' => 'italic', 'actionTextColor' => '#ff0000'],
                ],
                'messageColor' => '#333333',
                'title' => [
                    ['lang' => 'in', 'text' => 'Selamat Datang Boss'],
                    ['lang' => 'en', 'text' => 'Welcome Boss'],
                ],
                'titleColor' => '#ff0000',
                'showUntil' => now()->addDays(3),
                'type' => 'all',
                'action' => 'https://goepos.id',
                'actionText' => 'Visit GoEpos'
            ],
            [
                'id' => 'notif_2',
                'background' => '#cceeff',
                'createdAt' => now()->subDays(1),
                'icon' => 'info',
                'iconColor' => '#0044cc',
                'backgroundIconColor' => '#e0f7ff',
                'message' => [
                    ['lang' => 'in', 'text' => 'Pesanan Anda sedang diproses', 'actionText' => 'lihat pesanan', 'action' => 'order_status', 'actionTextStyle' => 'italic', 'actionTextColor' => '#0044cc'],
                ],
                'messageColor' => '#333333',
                'title' => [
                    ['lang' => 'in', 'text' => 'Status Pesanan'],
                ],
                'titleColor' => '#0044cc',
                'showUntil' => now()->addDays(1),
                'type' => 'specific',
                'action' => 'https://tracking.example.com',
                'actionText' => 'Track Order'
            ],
            [
                'id' => 'notif_3',
                'background' => '#e0e0e0',
                'createdAt' => now()->subHours(6),
                'icon' => 'warning',
                'iconColor' => '#ffaa00',
                'backgroundIconColor' => '#fff3e0',
                'message' => [
                    ['lang' => 'in', 'text' => 'Pembayaran Anda telah diterima', 'actionText' => 'lihat detail', 'action' => 'payment_detail', 'actionTextStyle' => 'bold', 'actionTextColor' => '#ffaa00'],
                ],
                'messageColor' => '#333333',
                'title' => [
                    ['lang' => 'in', 'text' => 'Pembayaran Berhasil'],
                ],
                'titleColor' => '#ffaa00',
                'showUntil' => null,
                'type' => 'all',
                'action' => 'https://example.com/payment-detail',
                'actionText' => 'View Details'
            ]
        ])->take($this->perPage);
    }

    public function render()
    {
        return view('livewire.backend.notifications.notification', [
            'notifications' => $this->notifications,
        ])->layout('layouts.app');
    }
}
