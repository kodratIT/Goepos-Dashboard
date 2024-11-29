<?php

namespace App\Livewire\Backend\Notifications;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\NotificationsModel;
use Stichoza\GoogleTranslate\GoogleTranslate;

class AddNotification extends Component
{

    public $styles = [
        [
            'name' => 'Info Style',
            'icon' => 'info',
            'background' => '#d1ecf1',
            'backgroundIconColor' => '#bee5eb',
            'iconColor' => '#0c5460',
            'title' => [
                'in' => ['text' => 'Informasi Penting'],
            ],
            'message' => [
                'in' => ['text' => 'Ini adalah pesan informasi penting.'],
            ],
            'messageColor' => '#0c5460',
            'titleColor' => '#0c5460',
            'actionText' => 'Detail Info',
            'actionURL' => 'https://example.com',
            'actionTextStyle' => 'normal',
            'actionTextColor' => '#0c5460',
            'showUntil' => null,
        ],
        [
            'name' => 'Warning Style',
            'icon' => 'warning',
            'background' => '#fff3cd',
            'backgroundIconColor' => '#ffeeba',
            'iconColor' => '#856404',
            'title' => [
                'in' => ['text' => 'Peringatan!'],
            ],
            'message' => [
                'in' => ['text' => 'Harap perhatikan peringatan ini.'],
            ],
            'messageColor' => '#856404',
            'titleColor' => '#856404',
            'actionText' => 'Cek Detail',
            'actionURL' => 'https://example-warning.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#856404',
            'showUntil' => null,
        ],
        [
            'name' => 'Danger Style',
            'icon' => 'danger',
            'background' => '#f8d7da',
            'backgroundIconColor' => '#f5c6cb',
            'iconColor' => '#721c24',
            'title' => [
                'in' => ['text' => 'Kesalahan Fatal!'],
            ],
            'message' => [
                'in' => ['text' => 'Terdapat kesalahan fatal yang harus segera diperbaiki.'],
            ],
            'messageColor' => '#721c24',
            'titleColor' => '#721c24',
            'actionText' => 'Perbaiki Sekarang',
            'actionURL' => 'https://example-danger.com',
            'actionTextStyle' => 'underline',
            'actionTextColor' => '#721c24',
            'showUntil' => null,
        ],
        [
            'name' => 'Success Style',
            'icon' => 'check-circle',
            'background' => '#d4edda',
            'backgroundIconColor' => '#c3e6cb',
            'iconColor' => '#155724',
            'title' => [
                'in' => ['text' => 'Berhasil!'],
            ],
            'message' => [
                'in' => ['text' => 'Aksi Anda telah berhasil dilakukan.'],
            ],
            'messageColor' => '#155724',
            'titleColor' => '#155724',
            'actionText' => 'Lihat Detail',
            'actionURL' => 'https://example-success.com',
            'actionTextStyle' => 'italic',
            'actionTextColor' => '#155724',
            'showUntil' => null,

        ],
        [
            'name' => 'Neutral Style',
            'icon' => 'ellipsis-h',
            'background' => '#e2e3e5',
            'backgroundIconColor' => '#d6d8db',
            'iconColor' => '#818182',
            'title' => [
                'in' => ['text' => 'Info Umum'],
            ],
            'message' => [
                'in' => ['text' => 'Ini adalah informasi umum.'],
            ],
            'messageColor' => '#818182',
            'titleColor' => '#818182',
            'actionText' => 'Baca Selengkapnya',
            'actionURL' => 'https://example-neutral.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#818182',
            'showUntil' => null,

        ],
        [
            'name' => 'Primary Style',
            'icon' => 'star',
            'background' => '#cce5ff',
            'backgroundIconColor' => '#b8daff',
            'iconColor' => '#004085',
            'title' => [
                'in' => ['text' => 'Notifikasi Penting'],
            ],
            'message' => [
                'in' => ['text' => 'Tindakan ini perlu perhatian Anda segera.'],
            ],
            'messageColor' => '#004085',
            'titleColor' => '#004085',
            'actionText' => 'Aksi Sekarang',
            'actionURL' => 'https://example-primary.com',
            'actionTextStyle' => 'underline',
            'actionTextColor' => '#004085',
            'showUntil' => null,

        ],
        [
            'name' => 'Custom Purple',
            'icon' => 'palette',
            'background' => '#e8daef',
            'backgroundIconColor' => '#d7bde2',
            'iconColor' => '#7d3c98',
            'title' => [
                'in' => ['text' => 'Gaya Ungu!'],
            ],
            'message' => [
                'in' => ['text' => 'Pilihan desain dengan warna ungu elegan.'],
            ],
            'messageColor' => '#7d3c98',
            'titleColor' => '#7d3c98',
            'actionText' => 'Lihat Gaya',
            'actionURL' => 'https://example-purple.com',
            'actionTextStyle' => 'italic',
            'actionTextColor' => '#7d3c98',
            'showUntil' => null,

        ],
        [
            'name' => 'Custom Orange',
            'icon' => 'sun',
            'background' => '#fdebd0',
            'backgroundIconColor' => '#f9e79f',
            'iconColor' => '#d35400',
            'title' => [
                'in' => ['text' => 'Gaya Oranye!'],
            ],
            'message' => [
                'in' => ['text' => 'Desain dengan warna oranye cerah.'],
            ],
            'messageColor' => '#d35400',
            'titleColor' => '#d35400',
            'actionText' => 'Cek Oranye',
            'actionURL' => 'https://example-orange.com',
            'actionTextStyle' => 'normal',
            'actionTextColor' => '#d35400',
            'showUntil' => null,

        ],
        [
            'name' => 'Soft Pink',
            'icon' => 'heart',
            'background' => '#fce4ec',
            'backgroundIconColor' => '#f8bbd0',
            'iconColor' => '#ad1457',
            'title' => [
                'in' => ['text' => 'Gaya Pink Lembut'],
            ],
            'message' => [
                'in' => ['text' => 'Pesan dengan sentuhan pink lembut.'],
            ],
            'messageColor' => '#ad1457',
            'titleColor' => '#ad1457',
            'actionText' => 'Lihat Desain',
            'actionURL' => 'https://example-softpink.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#ad1457',
            'showUntil' => null,

        ],
        [
            'name' => 'Calm Green',
            'icon' => 'leaf',
            'background' => '#e8f5e9',
            'backgroundIconColor' => '#c8e6c9',
            'iconColor' => '#2e7d32',
            'title' => [
                'in' => ['text' => 'Hijau Tenang'],
            ],
            'message' => [
                'in' => ['text' => 'Desain dengan tema hijau lembut.'],
            ],
            'messageColor' => '#2e7d32',
            'titleColor' => '#2e7d32',
            'actionText' => 'Detail Hijau',
            'actionURL' => 'https://example-calmgreen.com',
            'actionTextStyle' => 'italic',
            'actionTextColor' => '#2e7d32',
            'showUntil' => null,

        ],
        [
            'name' => 'Bold Red',
            'icon' => 'fire',
            'background' => '#fbe9e7',
            'backgroundIconColor' => '#ffccbc',
            'iconColor' => '#b71c1c',
            'title' => [
                'in' => ['text' => 'Merah Berani!'],
            ],
            'message' => [
                'in' => ['text' => 'Pesan dengan gaya merah yang kuat.'],
            ],
            'messageColor' => '#b71c1c',
            'titleColor' => '#b71c1c',
            'actionText' => 'Lihat Merah',
            'actionURL' => 'https://example-boldred.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#b71c1c',
            'showUntil' => null,

        ],
        [
            'name' => 'Cool Blue',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_blue_icon.png',
            'background' => '#d1e7f2',
            'backgroundIconColor' => '#a5d8f3',
            'iconColor' => '#004e89',
            'title' => ['in' => ['text' => 'Pemberitahuan Penting']],
            'message' => ['in' => ['text' => 'Pesan dengan warna biru yang menenangkan.']],
            'messageColor' => '#004e89',
            'titleColor' => '#004e89',
            'actionText' => 'Lihat Pesan',
            'actionURL' => 'https://example-coolblue.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#004e89',
            'showUntil' => null,

        ],
        [
            'name' => 'Golden Yellow',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_yellow_icon.png',
            'background' => '#fff9c4',
            'backgroundIconColor' => '#fff176',
            'iconColor' => '#fbc02d',
            'title' => ['in' => ['text' => 'Pesan Emas']],
            'message' => ['in' => ['text' => 'Pesan dengan warna emas yang mewah.']],
            'messageColor' => '#fbc02d',
            'titleColor' => '#fbc02d',
            'actionText' => 'Tindak Lanjut',
            'actionURL' => 'https://example-goldenyellow.com',
            'actionTextStyle' => 'italic',
            'actionTextColor' => '#fbc02d',
            'showUntil' => null,

        ],
        [
            'name' => 'Bright Green',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_brightgreen_icon.png',
            'background' => '#dff0d8',
            'backgroundIconColor' => '#a3e4a8',
            'iconColor' => '#2c5f2d',
            'title' => ['in' => ['text' => 'Notifikasi Hijau']],
            'message' => ['in' => ['text' => 'Pesan dengan tema hijau terang.']],
            'messageColor' => '#2c5f2d',
            'titleColor' => '#2c5f2d',
            'actionText' => 'Lihat Detail',
            'actionURL' => 'https://example-brightgreen.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#2c5f2d',
            'showUntil' => null,

        ],
        [
            'name' => 'Sunset Orange',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_sunsetorange_icon.png',
            'background' => '#fed7d0',
            'backgroundIconColor' => '#fbb4a2',
            'iconColor' => '#d94a2f',
            'title' => ['in' => ['text' => 'Peringatan Oranye']],
            'message' => ['in' => ['text' => 'Pesan dengan warna oranye lembayung.']],
            'messageColor' => '#d94a2f',
            'titleColor' => '#d94a2f',
            'actionText' => 'Cek Sekarang',
            'actionURL' => 'https://example-sunsetorange.com',
            'actionTextStyle' => 'normal',
            'actionTextColor' => '#d94a2f',
            'showUntil' => null,

        ],
        [
            'name' => 'Mystic Purple',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_purple_icon.png',
            'background' => '#ede7f6',
            'backgroundIconColor' => '#d1c4e9',
            'iconColor' => '#5e35b1',
            'title' => ['in' => ['text' => 'Pesan Ungu']],
            'message' => ['in' => ['text' => 'Notifikasi dengan tema ungu mistis.']],
            'messageColor' => '#5e35b1',
            'titleColor' => '#5e35b1',
            'actionText' => 'Lihat Info',
            'actionURL' => 'https://example-mysticpurple.com',
            'actionTextStyle' => 'italic',
            'actionTextColor' => '#5e35b1',
            'showUntil' => null,

        ],
        [
            'name' => 'Pastel Green',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_green_icon.png',
            'background' => '#e8f8e0',
            'backgroundIconColor' => '#c4f4c2',
            'iconColor' => '#367b48',
            'title' => ['in' => ['text' => 'Hijau Pastel']],
            'message' => ['in' => ['text' => 'Tema pastel hijau untuk notifikasi ini.']],
            'messageColor' => '#367b48',
            'titleColor' => '#367b48',
            'actionText' => 'Tindak Lanjut',
            'actionURL' => 'https://example-pastelgreen.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#367b48',
            'showUntil' => null,

        ],
        [
            'name' => 'Coral Red',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_red_icon.png',
            'background' => '#ffcdd2',
            'backgroundIconColor' => '#ef9a9a',
            'iconColor' => '#c62828',
            'title' => ['in' => ['text' => 'Pesan Merah Coral']],
            'message' => ['in' => ['text' => 'Pesan dengan warna merah coral elegan.']],
            'messageColor' => '#c62828',
            'titleColor' => '#c62828',
            'actionText' => 'Lihat Detail',
            'actionURL' => 'https://example-coralred.com',
            'actionTextStyle' => 'italic',
            'actionTextColor' => '#c62828',
            'showUntil' => null,

        ],
        [
            'name' => 'Sky Blue',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_skyblue_icon.png',
            'background' => '#bbdefb',
            'backgroundIconColor' => '#90caf9',
            'iconColor' => '#1565c0',
            'title' => ['in' => ['text' => 'Langit Biru']],
            'message' => ['in' => ['text' => 'Pesan dengan tema warna biru langit.']],
            'messageColor' => '#1565c0',
            'titleColor' => '#1565c0',
            'actionText' => 'Baca Info',
            'actionURL' => 'https://example-skyblue.com',
            'actionTextStyle' => 'normal',
            'actionTextColor' => '#1565c0',
            'showUntil' => null,

        ],
        [
            'name' => 'Golden Glow',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_gold_icon.png',
            'background' => '#fffde7',
            'backgroundIconColor' => '#fff59d',
            'iconColor' => '#fbc02d',
            'title' => ['in' => ['text' => 'Kilauan Emas']],
            'message' => ['in' => ['text' => 'Pesan ini memberikan nuansa emas.']],
            'messageColor' => '#fbc02d',
            'titleColor' => '#fbc02d',
            'actionText' => 'Lihat Detail',
            'actionURL' => 'https://example-goldenglow.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#fbc02d',
            'showUntil' => null,

        ],
        [
            'name' => 'Soft Cyan',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_cyan_icon.png',
            'background' => '#e0f7fa',
            'backgroundIconColor' => '#b2ebf2',
            'iconColor' => '#00796b',
            'title' => ['in' => ['text' => 'Sian Lembut']],
            'message' => ['in' => ['text' => 'Pesan dengan warna sian lembut.']],
            'messageColor' => '#00796b',
            'titleColor' => '#00796b',
            'actionText' => 'Tindak Lanjut',
            'actionURL' => 'https://example-softcyan.com',
            'actionTextStyle' => 'normal',
            'actionTextColor' => '#00796b',
            'showUntil' => null,

        ],
        [
            'name' => 'Ocean Breeze',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-anchor.png',
            'background' => '#00a8cc',
            'backgroundIconColor' => '#00bcd4',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Laut']],
            'message' => ['in' => ['text' => 'Pesan dengan nuansa biru laut yang menenangkan.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Lihat Detail',
            'actionURL' => 'https://example-ocean.com',
            'actionTextStyle' => 'normal',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],
        [
            'name' => 'Sunset Glow',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-sun.png',
            'background' => '#ff6f61',
            'backgroundIconColor' => '#ff8a65',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Senja']],
            'message' => ['in' => ['text' => 'Pesan dengan nuansa hangat matahari terbenam.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Baca Selengkapnya',
            'actionURL' => 'https://example-sunset.com',
            'actionTextStyle' => 'italic',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],
        [
            'name' => 'Forest Whisper',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-tree.png',
            'background' => '#4caf50',
            'backgroundIconColor' => '#66bb6a',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Hutan']],
            'message' => ['in' => ['text' => 'Pesan dengan nuansa hijau hutan yang segar.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Lihat Info',
            'actionURL' => 'https://example-forest.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],
        [
            'name' => 'Lavender Dream',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-leaf.png',
            'background' => '#9575cd',
            'backgroundIconColor' => '#b39ddb',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Lavender']],
            'message' => ['in' => ['text' => 'Pesan dengan nuansa ungu lavender yang menenangkan.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Detail Info',
            'actionURL' => 'https://example-lavender.com',
            'actionTextStyle' => 'normal',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],
        [
            'name' => 'Peachy Keen',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-heart.png',
            'background' => '#ffab91',
            'backgroundIconColor' => '#ffccbc',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Persik']],
            'message' => ['in' => ['text' => 'Pesan dengan nuansa persik yang lembut.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Baca Lagi',
            'actionURL' => 'https://example-peach.com',
            'actionTextStyle' => 'italic',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],
        [
            'name' => 'Minty Fresh',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-leaf.png',
            'background' => '#80deea',
            'backgroundIconColor' => '#b2ebf2',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Mint']],
            'message' => ['in' => ['text' => 'Pesan dengan nuansa mint yang segar.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Lihat Selengkapnya',
            'actionURL' => 'https://example-mint.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],
        [
            'name' => 'Coral Charm',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-star.png',
            'background' => '#ff8a80',
            'backgroundIconColor' => '#ffab91',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Coral']],
            'message' => ['in' => ['text' => 'Pesan dengan nuansa coral yang ceria.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Detail Info',
            'actionURL' => 'https://example-coral.com',
            'actionTextStyle' => 'normal',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],
        [
            'name' => 'Sunny Side',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-sun.png',
            'background' => '#fff176',
            'backgroundIconColor' => '#fff59d',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Cerah']],
            'message' => ['in' => ['text' => 'Pesan dengan nuansa kuning cerah yang menyenangkan.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Baca Selengkapnya',
            'actionURL' => 'https://example-sunny.com',
            'actionTextStyle' => 'italic',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],    [
            'name' => 'Berry Blast',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-grape.png',
            'background' => '#d32f2f',
            'backgroundIconColor' => '#f44336',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Berry']],
            'message' => ['in' => ['text' => 'Pesan dengan nuansa berry merah yang menyegarkan.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Lihat Info',
            'actionURL' => 'https://example-berry.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],
        [
            'name' => 'Placid Blue',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-water.png',
            'background' => '#81d4fa',
            'backgroundIconColor' => '#b3e5fc',
            'iconColor' => '#01579b',
            'title' => ['in' => ['text' => 'Pemberitahuan Biru']],
            'message' => ['in' => ['text' => 'Pesan dengan tema biru yang damai.']],
            'messageColor' => '#01579b',
            'titleColor' => '#01579b',
            'actionText' => 'Detail Info',
            'actionURL' => 'https://example-placidblue.com',
            'actionTextStyle' => 'normal',
            'actionTextColor' => '#01579b',
            'showUntil' => null,

        ],
        [
            'name' => 'Blazing Orange',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-fire.png',
            'background' => '#ff9800',
            'backgroundIconColor' => '#ffc107',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Panas']],
            'message' => ['in' => ['text' => 'Pesan dengan tema oranye menyala.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Baca Lagi',
            'actionURL' => 'https://example-orange.com',
            'actionTextStyle' => 'italic',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],
        [
            'name' => 'Elegant Purple',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-crown.png',
            'background' => '#6a1b9a',
            'backgroundIconColor' => '#9c27b0',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Elegan']],
            'message' => ['in' => ['text' => 'Pesan dengan nuansa ungu elegan.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Lihat Info',
            'actionURL' => 'https://example-purple.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],
        [
            'name' => 'Soft Sand',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-umbrella-beach.png',
            'background' => '#ffe0b2',
            'backgroundIconColor' => '#ffcc80',
            'iconColor' => '#6d4c41',
            'title' => ['in' => ['text' => 'Pemberitahuan Pantai']],
            'message' => ['in' => ['text' => 'Pesan dengan tema warna pasir pantai.']],
            'messageColor' => '#6d4c41',
            'titleColor' => '#6d4c41',
            'actionText' => 'Detail Info',
            'actionURL' => 'https://example-sand.com',
            'actionTextStyle' => 'normal',
            'actionTextColor' => '#6d4c41',
            'showUntil' => null,

        ],
        [
            'name' => 'Spring Green',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-seedling.png',
            'background' => '#69f0ae',
            'backgroundIconColor' => '#b9f6ca',
            'iconColor' => '#00c853',
            'title' => ['in' => ['text' => 'Pemberitahuan Musim Semi']],
            'message' => ['in' => ['text' => 'Pesan dengan warna hijau musim semi.']],
            'messageColor' => '#00c853',
            'titleColor' => '#00c853',
            'actionText' => 'Lihat Detail',
            'actionURL' => 'https://example-green.com',
            'actionTextStyle' => 'italic',
            'actionTextColor' => '#00c853',
            'showUntil' => null,

        ],
        [
            'name' => 'Crisp White',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-snowflake.png',
            'background' => '#eceff1',
            'backgroundIconColor' => '#cfd8dc',
            'iconColor' => '#607d8b',
            'title' => ['in' => ['text' => 'Pemberitahuan Dingin']],
            'message' => ['in' => ['text' => 'Pesan dengan nuansa putih yang bersih.']],
            'messageColor' => '#607d8b',
            'titleColor' => '#607d8b',
            'actionText' => 'Lihat Selengkapnya',
            'actionURL' => 'https://example-crisp.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#607d8b',
            'showUntil' => null,

        ],
        [
            'name' => 'Velvet Red',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-gem.png',
            'background' => '#d50000',
            'backgroundIconColor' => '#f44336',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Berlian']],
            'message' => ['in' => ['text' => 'Pesan dengan nuansa merah mewah.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Detail Info',
            'actionURL' => 'https://example-red.com',
            'actionTextStyle' => 'normal',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],
        [
            'name' => 'Moody Blue',
            'icon' => 'https://www.w3schools.com/icons/fontawesome_fa-moon.png',
            'background' => '#1e88e5',
            'backgroundIconColor' => '#2196f3',
            'iconColor' => '#ffffff',
            'title' => ['in' => ['text' => 'Pemberitahuan Biru Gelap']],
            'message' => ['in' => ['text' => 'Pesan dengan tema biru gelap yang menenangkan.']],
            'messageColor' => '#ffffff',
            'titleColor' => '#ffffff',
            'actionText' => 'Lihat Info',
            'actionURL' => 'https://example-blue.com',
            'actionTextStyle' => 'bold',
            'actionTextColor' => '#ffffff',
            'showUntil' => null,

        ],
        // Tambahkan pola serupa hingga total 30 desain.
    ];


    public $newNotification = [
        'id' => '',
        'iconColor' => '',
        'background' => '',
        'backgroundIconColor' => '',
        'icon' => '',
        'message' => [
            'in' => ['text' => ''],
            'en' => ['text' => ''],
            'es' => ['text' => ''],
            'hi' => ['text' => ''],
            'de' => ['text' => ''],
        ],
        'messageColor' => '',
        'title' => [
            'in' => ['text' => ''],
            'en' => ['text' => ''],
            'es' => ['text' => ''],
            'hi' => ['text' => ''],
            'de' => ['text' => ''],
        ],
        'titleColor' => '',
        'actionText' => null,
        'actionURL' => null,
        'action' => null,
        'actionTextStyle' => null,
        'actionTextColor' => null,
        'showUntil' => null,
    ];

    public $type = 'all';
    public $specificTarget = '';
    public $ownerUids = [];

    public $languages = [
        'in' => 'Indonesian',
        'en' => 'English',
        'es' => 'Spanish',
        'hi' => 'Hindi',
        'de' => 'German',
    ];

    public $actionText = [
        'in' => '',
        'en' => '',
        'es' => '',
        'hi' => '',
        'de' => '',
    ];

    public $errorMessage = '';

    public $isFormComplete = false;
    public $notifikasiDikirim = false;

    protected $listeners = ['showPreview'];

    public $selectedStyle = null;

    public function applyStyle($styleName)
    {
        $this->selectedStyle = collect($this->styles)->firstWhere('name', $styleName);
        if ($this->selectedStyle) {
            $this->newNotification = array_merge($this->newNotification, $this->selectedStyle);
        }
    }

    public function updated($propertyName)
    {
        logger()->info('newNotification updated:', $this->newNotification);

        $this->newNotification['actionText'] = $this->actionText['in'];

        $this->dispatch('showPreview', $this->newNotification);
    }

    public function generatePreview()
    {
        $this->dispatch('show-preview', $this->newNotification);
    }

    protected function firestore()
    {
        return new NotificationsModel();
    }

    public function updatedType($value)
    {
        if ($value === 'all') {
            $this->specificTarget = '';
            $this->ownerUids = [];
        }
    }

    public function addOwnerUid()
    {
        $this->ownerUids[] = '';
    }

    public function removeOwnerUid($index)
    {
        unset($this->ownerUids[$index]);
        $this->ownerUids = array_values($this->ownerUids); // Reindex array
    }

    public function translate()
    {
        if (empty($this->newNotification['title']['in']['text']) || empty($this->newNotification['message']['in']['text'])) {
            $this->errorMessage = 'Please fill in both the Indonesian title and message before translating.';
            return;
        }

        $this->errorMessage = '';

        $fields = ['title', 'message'];
        $languages = ['en', 'es', 'hi', 'de'];

        foreach ($fields as $field) {
            foreach ($languages as $lang) {
                try {
                    $translator = new GoogleTranslate();
                    $translator->setSource('id');
                    $translator->setTarget($lang);
                    $this->newNotification[$field][$lang]['text'] = $translator->translate($this->newNotification[$field]['in']['text']);
                } catch (\Exception $e) {
                    $this->newNotification[$field][$lang]['text'] = '';
                }
            }
        }
    }

    public function saveNotification()
    {
        // Format pesan notifikasi
        $formattedMessages = $this->formatMessages($this->newNotification['message']);
        $formattedTitles = $this->formatTitles($this->newNotification['title']);

          // Hapus semua elemen kosong dari array
        $this->ownerUids = array_values(array_filter($this->ownerUids, function ($uid) {
            return $uid !== '';
        }));

        $timeSpentShowUntil = $this->newNotification['showUntil']
            ? Carbon::parse($this->newNotification['showUntil'])
            : null;
        // Susun data hasil akhir
        $data = [
            'background' => $this->newNotification['background'],
            'backgroundIconColor' => $this->newNotification['backgroundIconColor'],
            'iconColor' => $this->newNotification['iconColor'],
            'icon' => $this->newNotification['icon'],
            'message' => $formattedMessages,
            'messageColor' => $this->newNotification['messageColor'],
            'title' => $formattedTitles,
            'titleColor' => $this->newNotification['titleColor'],
            'showUntil' => $timeSpentShowUntil,
            'createdAt' => Carbon::now(),
            'type' => $this->type,
        ];

        $result = $this->firestore()->createNotifications($data, $this->specificTarget, $this->ownerUids);

        if (!$this->notifikasiDikirim) {
            if ($result) {

                toastr()->success('Notifikasi Berhasil Dibuat');
                $this->notifikasiDikirim = true;
                // sleep(2);
                return $this->redirect(route('notifications'), navigate: true);

            } else {
                toastr()->error('Notifikasi Gagal Dibuat');
                $this->notifikasiDikirim = true;
            }
        }
    }

    /**
     * Format pesan notifikasi.
     *
     * @param array $messages
     * @return array
     */
    private function formatMessages(array $messages): array
    {
        $formattedMessages = [];

        foreach ($messages as $lang => $message) {
            // Ambil actionText yang sesuai dengan bahasa (gunakan bahasa default 'in' jika tidak ada)
            $translatedActionText = $this->actionText[$lang] ?? '';

            // Mulai dengan array kosong dan tambahkan hanya jika nilai tidak kosong
            $formattedMessage = [
                'lang' => $lang,
                'text' => $message['text'] , // Pastikan 'text' selalu ada
            ];

            // Tambahkan field lainnya hanya jika tidak kosong
            if (!empty($this->newNotification['action'])) {
                $formattedMessage['action'] = $this->newNotification['action'];
            }

            if (!empty($translatedActionText)) {
                $formattedMessage['actionText'] = $translatedActionText;
            }

            if (!empty($this->newNotification['actionTextStyle'])) {
                $formattedMessage['actionTextStyle'] = $this->newNotification['actionTextStyle'];
            }

            if (!empty($this->newNotification['actionTextColor'])) {
                $formattedMessage['actionTextColor'] = $this->newNotification['actionTextColor'];
            }

            $formattedMessages[] = $formattedMessage;
        }

        return $formattedMessages;
    }



    /**
     * Format judul notifikasi.
     *
     * @param array $titles
     * @return array
     */
    private function formatTitles(array $titles): array
    {
        $formattedTitles = [];
        foreach ($titles as $lang => $title) {
            $formattedTitles[] = [
                'lang' => $lang,
                'text' => $title['text'],
            ];
        }

        return $formattedTitles;
    }

    public function isPreviewOpen ()
    {
        $this->emit('showPreview', $this->newNotification);
    }



    public function render()
    {
        return view('livewire.backend.notifications.add-notification')->layout('layouts.app');
    }


}
