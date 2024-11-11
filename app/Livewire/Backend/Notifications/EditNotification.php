<?php

namespace App\Livewire\Backend\Notifications;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\NotificationsModel;
use Stichoza\GoogleTranslate\GoogleTranslate;

class EditNotification extends Component
{
    public $notificationId; // ID notifikasi untuk diedit
    public $newNotification = [
        'id' => '',
        'backgroundIconColor' => '',
        'iconColor' => '',
        'background' => '',
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

    public $message = [
            'in' => ['text' => ''],
            'en' => ['text' => ''],
            'es' => ['text' => ''],
            'hi' => ['text' => ''],
            'de' => ['text' => ''],
    ];

    public $title = [
        'in' => ['text' => ''],
        'en' => ['text' => ''],
        'es' => ['text' => ''],
        'hi' => ['text' => ''],
        'de' => ['text' => ''],
    ];

    public $type = '';
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

    protected function firestore()
    {
        return new NotificationsModel();
    }

    public function mount($id)
    {
        $this->notificationId = $id;
        $this->loadNotification();
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

    public function loadNotification()
    {
    // Ambil data notifikasi berdasarkan ID dari Firestore
    $notificationData = $this->firestore()->findNotificationById($this->notificationId);

    $this->type = $notificationData['type'];
    if ($notificationData) {

        $loop = false;
        foreach ($notificationData['message'] as $lang => $message) {

            if(!$loop){
                $this->newNotification = [
                    'id' => $this->notificationId,
                    'backgroundIconColor' => $notificationData['backgroundIconColor'] ?? '',
                    'iconColor' => $notificationData['iconColor'] ?? '',
                    'background' => $notificationData['background'] ?? '',
                    'icon' => $notificationData['icon'] ?? '',
                    'message' => $notificationData['message'] ?? '',
                    'messageColor' => $notificationData['messageColor'] ?? '',
                    'title' => $notificationData['title'],
                    'titleColor' => $notificationData['titleColor'] ?? '',
                    'showUntil' => isset($notificationData['showUntil']) ? Carbon::parse($notificationData['showUntil'])->format('Y-m-d') : null,
                    'action' => $message['action'] ?? null,
                    'actionTextStyle' => $message['actionTextStyle'] ?? null,
                    'actionTextColor' => $message['actionTextColor'] ?? null,
                ];

                $loop = true;
            }
        }


        foreach ($notificationData['message'] as $lang => $message) {
            $this->actionText[$message['lang']] = $message['actionText'] ?? '';
            $this->message[$message['lang']] = $message['text'];
        }

        foreach ($notificationData['title'] as $lang => $message) {
            $this->title[$message['lang']] = $message['text'];
        }

    } else {
        session()->flash('error', 'Notifikasi tidak ditemukan.');
        return redirect()->route('notifications');
    }
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

    public function updateNotification()
    {
        // Format pesan notifikasi
        $formattedMessages = $this->formatMessages($this->message);
        $formattedTitles = $this->formatTitles($this->title);

        // Hapus elemen kosong dari array ownerUids
        $this->ownerUids = array_values(array_filter($this->ownerUids, function ($uid) {
            return $uid !== '';
        }));

        $timeSpentShowUntil = !empty($this->newNotification['showUntil'])
        ? Carbon::createFromFormat('Y-m-d', $this->newNotification['showUntil'], config('app.timezone'))->setTimezone('UTC')
        : null;


        // Susun data hasil akhir untuk pembaruan
        $data = [
            'id' => $this->notificationId,
            'background' => $this->newNotification['background'],
            'backgroundIconColor' => $this->newNotification['backgroundIconColor'],
            'iconColor' => $this->newNotification['iconColor'],
            'icon' => $this->newNotification['icon'],
            'message' => $formattedMessages,
            'messageColor' => $this->newNotification['messageColor'],
            'title' => $formattedTitles,
            'titleColor' => $this->newNotification['titleColor'],
            'showUntil' => $timeSpentShowUntil,
            'type' => $this->type,
        ];


        $result = $this->firestore()->updateNotification($data, $this->specificTarget, $this->ownerUids);

        if ($result) {
            toastr()->success('Notifikasi berhasil diperbarui');
            return redirect()->route('notifications');
        } else {
            toastr()->error('Gagal memperbarui notifikasi');
        }
    }

    private function formatMessages(array $messages): array
    {
        // dd($messages);
        $formattedMessages = [];
        foreach ($messages as $lang => $message) {
            $translatedActionText = $this->actionText[$lang] ?? '';
            $formattedMessage = [
                'lang' => $lang,
                'text' => $message, // Akses langsung teks karena tidak lagi memiliki subfield 'text'
            ];


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

    private function formatTitles(array $titles): array
    {
        $formattedTitles = [];
        foreach ($titles as $lang => $title) {
            $formattedTitles[] = [
                'lang' => $lang,
                'text' => $title,
            ];
        }

        return $formattedTitles;
    }

    public function render()
    {
        return view('livewire.backend.notifications.edit-notification')->layout('layouts.app');
    }
}
