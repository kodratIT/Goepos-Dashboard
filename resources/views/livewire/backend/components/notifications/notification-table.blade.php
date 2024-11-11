<div>
    <!-- Tabel Notifikasi -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th class="px-4 py-3">NO</th>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Background</th>
                    <th class="px-4 py-3">Background Icon Color</th>
                    <th class="px-4 py-3">IconColor</th>
                    <th class="px-4 py-3">Icon</th>
                    <th class="px-4 py-3">Message</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Show Until</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">CreateaAt</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notifications as $notification)
                    <tr class="bg-white border-b text-center hover:bg-gray-50">

                        <td>{{ $loop->iteration }}</td>

                        <!-- ID -->
                        <td class="px-4 py-4 font-semibold text-gray-900">{{ $notification['id'] ?? '-' }}</td>

                        <!-- Background color preview -->
                        <td class="px-4 py-4">
                            <div class="w-8 h-8 rounded-full"
                                style="background-color: {{ $notification['background'] ?? '#ffffff' }};
                                        border: {{ $notification['background'] == '#ffffff' ? '1px solid #d1d5db' : 'none' }};">
                            </div>
                        </td>
                        <!-- Background color preview -->
                        <td class="px-4 py-4">
                            <div class="w-8 h-8 rounded-full"
                                style="background-color: {{ $notification['backgroundIconColor'] ?? '#ffffff' }};
                                        border: {{ $notification['backgroundIconColor'] == '#ffffff' ? '1px solid #d1d5db' : 'none' }};">
                            </div>
                        </td>


                        <td class="px-6 py-4" style="color: {{ $notification['iconColor'] ?? '#000' }};">
                            <div class="w-6 h-6 rounded-full"
                                style="background-color: {{ $notification['iconColor'] ?? '#000' }};"></div>
                        </td>

                        <!-- Icon -->
                        <td class="px-4 py-4">
                            @if (!empty($notification['icon']) && filter_var($notification['icon'], FILTER_VALIDATE_URL))
                                <img src="{{ $notification['icon'] }}" alt="icon" class="w-8 h-8 rounded">
                            @else
                                <span class="text-gray-500">{{ ucfirst($notification['icon']) ?? '-' }}</span>
                            @endif
                        </td>

                        <!-- Message (short preview) -->
                        <td class="px-4 py-4 text-gray-700 whitespace-nowrap">
                            <!-- Menampilkan pesan dengan batas 20 karakter -->
                            {{ Str::limit($notification['message'][0]['text'] ?? '-',20) }}
                            @if (strlen($notification['message'][0]['text'] ?? '') > 0)
                                <a href="#" class="text-blue-500 hover:underline"
                                    onclick="showFullMessage({{ json_encode($notification['message']) }})">
                                    Lihat Detail
                                </a>
                            @endif
                        </td>


                        <!-- Title (short preview) -->
                        <td class="px-4 py-4 text-gray-900 whitespace-nowrap">
                            {{ $notification['title'][0]['text'] ?? '-' }}
                            <span class="text-xs text-gray-500 ">({{ $notification['title'][0]['lang'] ?? '-' }})</span>
                        </td>

                        <!-- Show Until with color indicator for permanency -->
                        <td class="px-4 py-4">
                            @if (isset($notification['showUntil']))
                                <span class="px-2 py-1 rounded-full text-xs font-semibold text-green-800 bg-green-100">
                                    {{ \Carbon\Carbon::parse($notification['showUntil'])->format('d-m-Y H:i') }}
                                </span>
                            @else
                                <span class="px-2 py-1 rounded-full text-xs font-semibold text-gray-800 bg-gray-200">
                                    Permanent
                                </span>
                            @endif
                        </td>

                        <!-- Type with color indicator -->
                        <td class="px-4 py-4">
                            <span
                                class="px-2 py-1 rounded-full text-xs font-semibold text-white
                                {{ $notification['type'] === 'specific' ? 'bg-blue-500' : 'bg-yellow-500' }}">
                                {{ ucfirst($notification['type'] ?? '-') }}
                            </span>
                        </td>


                        <td class="px-4 py-4">
                            <span
                                class="px-4 py-4 text-gray-900 whitespace-nowrap">
                                {{ $notification['createdAt'] ?? '-' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 flex space-x-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('notifications-edit', ['id' => $notification['id'] ?? '']) }}" wire:navigate.hover
                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md shadow-sm transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.232 5.232a3 3 0 114.243 4.243L8.243 20.707a1 1 0 01-.293.207l-4 2a1 1 0 01-1.36-1.36l2-4a1 1 0 01.207-.293l11.242-11.243z" />
                                </svg>
                                Edit
                            </a>

                            <!-- Tombol Delete -->
                            <button onclick="confirmDelete('{{ $notification['id'] ?? '' }}')"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-md shadow-sm transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Delete
                            </button>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-gray-500 py-4">Tidak Ada Notifikasi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Modal untuk menampilkan pesan lengkap dengan tabs bahasa -->
    <div id="fullMessageModal"
        class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-3/4 max-w-4xl">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-semibold text-gray-800 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M9.707 15.293a1 1 0 01-1.414 0l-3.414-3.414a1 1 0 011.414-1.414L9 12.586l4.293-4.293a1 1 0 011.414 1.414l-5 5z" />
                    </svg>
                    Detail Pesan
                </h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Tabs untuk Pemilihan Bahasa -->
            <div class="mb-4 border-b border-gray-200">
                <div class="flex space-x-4" id="languageTabs">
                    {{-- <button onclick="selectLanguage('all')" id="lang-all"
                        class="py-2 px-4 border-b-2 font-semibold focus:outline-none transition-all duration-200 ease-in-out">
                        Semua Bahasa
                    </button> --}}
                    <button onclick="selectLanguage('in')" id="lang-in"
                        class="py-2 px-4 border-b-2 font-semibold focus:outline-none transition-all duration-200 ease-in-out">
                        Indonesia
                    </button>
                    <button onclick="selectLanguage('en')" id="lang-en"
                        class="py-2 px-4 border-b-2 font-semibold focus:outline-none transition-all duration-200 ease-in-out">
                        English
                    </button>
                    <button onclick="selectLanguage('es')" id="lang-es"
                        class="py-2 px-4 border-b-2 font-semibold focus:outline-none transition-all duration-200 ease-in-out">
                        Spanish
                    </button>
                    <button onclick="selectLanguage('hi')" id="lang-hi"
                        class="py-2 px-4 border-b-2 font-semibold focus:outline-none transition-all duration-200 ease-in-out">
                        Hindi
                    </button>
                    <button onclick="selectLanguage('de')" id="lang-de"
                        class="py-2 px-4 border-b-2 font-semibold focus:outline-none transition-all duration-200 ease-in-out">
                        German
                    </button>
                </div>
            </div>

            <!-- Konten Pesan dan Judul -->
            <div id="messageContent" class="space-y-6">
                <!-- Konten pesan akan diisi secara dinamis melalui JavaScript -->
            </div>
        </div>
    </div>
</div>

<script>
    let selectedMessageData = []; // Array data pesan yang diterima
    let selectedLanguage = 'in'; // Bahasa default

    function showFullMessage(messages) {
        selectedMessageData = messages;
        selectLanguage('in'); // Menampilkan semua bahasa pertama kali
        document.getElementById('fullMessageModal').classList.remove('hidden');
    }

    function selectLanguage(lang) {
        selectedLanguage = lang;

        // Perbarui visual tab
        const tabs = document.querySelectorAll('#languageTabs button');
        tabs.forEach(tab => {
            tab.classList.remove('border-blue-500', 'text-blue-500');
            tab.classList.add('border-transparent', 'text-gray-600');
        });
        document.getElementById(`lang-${lang}`).classList.add('border-blue-500', 'text-blue-500');

        // Clear konten sebelumnya
        const messageContent = document.getElementById('messageContent');
        messageContent.innerHTML = '';

        // Filter pesan sesuai bahasa yang dipilih
        let filteredMessages;
        if (lang === 'in') {
            filteredMessages = selectedMessageData.filter(msg => msg.lang ===
            lang); // Tampilkan semua data
        } else {
            filteredMessages = selectedMessageData.filter(msg => msg.lang ===
            lang); // Hanya data sesuai bahasa yang dipilih
        }

        // Cek apakah ada pesan yang sesuai dengan bahasa yang dipilih
        if (filteredMessages.length === 0) {
            const noMessageHtml = `
                <div class="text-center text-gray-500 italic">
                    Tidak Ada Message untuk Bahasa ini, silakan setting di menu edit.
                </div>
            `;
            messageContent.insertAdjacentHTML('beforeend', noMessageHtml);
        } else {
            // Tambahkan setiap pesan yang difilter ke dalam konten
            filteredMessages.forEach(msg => {
                const messageHtml = `
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414L9.586 4a1 1 0 011.414 0l4.293 4.293a1 1 0 01-1.414 1.414L10 6.414l-3.293 3.293a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            <label class="block text-sm font-medium text-gray-700">Message (${msg.lang}):</label>
                        </div>
                        <p class="text-gray-700 ml-7">${msg.text || '-'}</p>

                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M12.293 10.707a1 1 0 010 1.414l-3.293 3.293a1 1 0 01-1.414 0L5.293 12a1 1 0 111.414-1.414L9 13.414l2.293-2.293a1 1 0 011.414 0z" />
                            </svg>
                            <label class="block text-sm font-medium text-gray-700">Action Text:</label>
                        </div>
                        <p class="text-gray-700 ml-7">${msg.actionText || '-'}</p>

                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 011.414 0L10 13.586l3.293-3.293a1 1 0 011.414 1.414l-4.293 4.293a1 1 0 01-1.414 0L5.293 11.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            <label class="block text-sm font-medium text-gray-700">Action URL:</label>
                        </div>
                        <p class="text-gray-700 ml-7">${msg.action || '-'}</p>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 011.414 0L10 13.586l3.293-3.293a1 1 0 011.414 1.414l-4.293 4.293a1 1 0 01-1.414 0L5.293 11.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            <label class="block text-sm font-medium text-gray-700">Action Text Style:</label>
                        </div>
                        <p class="text-gray-700 ml-7">${msg.actionTextStyle || '-'}</p>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 011.414 0L10 13.586l3.293-3.293a1 1 0 011.414 1.414l-4.293 4.293a1 1 0 01-1.414 0L5.293 11.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            <label class="block text-sm font-medium text-gray-700">Action Text Color:</label>
                        </div>
                        <p class="text-gray-700 ml-7 p-5 text-white border-2"
                        style="background-color: ${msg.actionTextColor};
                                border-color: ${msg.actionTextColor || '#d1d5db'};
                                border-radius: 4px;">
                        ${msg.actionTextColor || '-'}
                        </p>

                `;
                messageContent.insertAdjacentHTML('beforeend', messageHtml);
            });
        }
    }

    function closeModal() {
        document.getElementById('fullMessageModal').classList.add('hidden');
    }
</script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('deleteNotification', id); // Memanggil metode Livewire untuk menghapus data
                Swal.fire(
                    'Terhapus!',
                    'Data berhasil dihapus.',
                    'success'
                )
            }
        })
    }
</script>
