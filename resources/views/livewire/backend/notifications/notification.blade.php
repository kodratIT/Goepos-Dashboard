<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data from Firebase
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header: Per Page & Add Notification Button -->
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <label for="perPage" class="text-sm font-medium text-gray-700">Tampilkan</label>
                    <select wire:change="updateDataPerPage" wire:model="perPage" id="perPage"
                        class="ml-2 border-gray-300 rounded-md shadow-sm">
                        @foreach ($perPageOptions as $option)
                            <option value="{{ $option }}">{{ $option }} data per halaman</option>
                        @endforeach
                    </select>
                </div>
                <!-- Add Notification Button -->
                <a href="{{ route('notifications-add') }}" wire:navigate.hover
                    class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
                    Add Notification
                </a>
            </div>

            <!-- Tabel Notifikasi atau Indikator Loading saat Filter diubah -->
            <div>
                @if ($isFilter)
                    <!-- Indikator loading khusus filter -->
                    <div class="flex justify-center items-center py-4">
                        <p class="text-gray-500">Loading data...</p>
                    </div>
                @else
                    @livewire('backend.components.notifications.notification-table', ['notifications' => $notifications], key(count($notifications)))
                @endif
            </div>

            <!-- Load More Button dengan Indikator Loading -->
            @if ($hasMore)
                <div class="flex justify-center mt-4">
                    <button wire:click="loadMore" wire:loading.attr="disabled"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
                        <span wire:loading.remove>Load More</span>
                        <span wire:loading>
                            <svg class="animate-spin h-5 w-5 mr-2 inline-block text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            Loading...
                        </span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
