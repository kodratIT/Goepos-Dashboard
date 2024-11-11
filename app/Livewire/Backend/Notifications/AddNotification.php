<?php

namespace App\Livewire\Backend\Notifications;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\NotificationsModel;
use Stichoza\GoogleTranslate\GoogleTranslate;

class AddNotification extends Component
{
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


    public function render()
    {
        return view('livewire.backend.notifications.add-notification')->layout('layouts.app');
    }
}
