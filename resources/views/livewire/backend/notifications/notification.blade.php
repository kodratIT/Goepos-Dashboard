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
                    <select wire:model.lazy="perPage" id="perPage" class="ml-2 border-gray-300 rounded-md shadow-sm">
                        @foreach ($perPageOptions as $option)
                            <option value="{{ $option }}">{{ $option }} data per halaman</option>
                        @endforeach
                    </select>
                </div>
                <!-- Add Notification Button -->
                <a href="{{ route('notifications-add') }}" wire:navigate.hover class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
                    Add Notification
                </a>
            </div>

            <!-- Tabel Notifikasi -->
            @livewire('backend.components.notifications.notification-table', ['notifications' => $notifications])

            <!-- Load More Button -->
            @if ($hasMore && !$isLoading)
                <div class="flex justify-center mt-4">
                    <button wire:click="loadMore" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
                        Load More
                    </button>
                </div>
            @elseif($isLoading)
                <div class="flex justify-center mt-4">
                    <p>Loading...</p>
                </div>
            @endif
        </div>
    </div>
</div>
