<div class="{{ $darkMode ? 'dark' : '' }}">

    <!-- Header: Per Page, Search & Dark Mode -->
    <div class="flex justify-between items-center mb-4">
        {{-- <div class="flex items-center">
            <label for="perPage" class="text-sm font-medium text-gray-700">Tampilkan</label>
            <select wire:model.lazy="perPage" id="perPage" class="ml-2 border-gray-300 rounded-md shadow-sm">
                @foreach ($perPageOptions as $option)
                    <option value="{{ $option }}">{{ $option }} data per halaman</option>
                @endforeach
            </select>
        </div>

        <div class="relative">
            <input type="text" wire:model.lazy="search" placeholder="Cari berdasarkan email"
                class="border-gray-300 rounded-md shadow-sm pl-10 focus:ring focus:ring-blue-200"
                @input.debounce.300ms="$wire.set('search', $event.target.value)">
        </div> --}}

        {{-- <button wire:click="toggleDarkMode" class="ml-4 bg-gray-800 text-white px-4 py-2 rounded">
            {{ $darkMode ? 'Light Mode' : 'Dark Mode' }}
        </button> --}}
    </div>

    <!-- Analytics Widgets -->
    <div class="grid gap-6 mb-6">

        <!-- Row 1: 2 Widget -->
        <div class="grid gap-6 mb-6">
            <!-- Row 1: 2 Widget -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Total Transaksi Widget -->
                <div class="p-6 bg-white shadow-md rounded-lg flex items-center space-x-4">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m12 8h-6m-6 0h-6" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-700">Total Transaksi</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalTransactions }}</p>
                    </div>
                </div>

                <!-- Transaksi Selesai Widget -->
                <div class="p-6 bg-white shadow-md rounded-lg flex items-center space-x-4">
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-700">Transaksi Selesai</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $completedTransactions }}</p>
                    </div>
                </div>
            </div>

            {{-- <div class="mt-6 bg-white p-6 shadow-md rounded-lg">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Grafik Tren Transaksi</h3>
                <div id="chart" class="w-full h-96"></div>
            </div> --}}
        </div>
        <!-- Row 2: 3 Widget -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Widget: Transaksi Processing -->
            <div class="p-6 bg-white shadow-md rounded-lg flex items-center space-x-4">
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-700">Transaksi Processing</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $processingTransactions }}</p>
                </div>
            </div>

            <!-- Widget: Transaksi Expired -->
            <div class="p-6 bg-white shadow-md rounded-lg flex items-center space-x-4">
                <div class="bg-red-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-700">Transaksi Expired</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $expiredTransactions }}</p>
                </div>
            </div>

            <!-- Widget: Total Nominal -->
            <div class="p-6 bg-white shadow-md rounded-lg flex items-center space-x-4">
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-700">Total Nominal Transaksi</h3>
                    <p class="text-2xl font-bold text-gray-900">Rp.{{ number_format($totalAmount) }}</p>
                </div>
            </div>
        </div>

    </div>

    {{-- <!-- Table Section -->
    <div class="md:col-span-2">
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">ID Trx</th>
                        <th class="px-6 py-3">OwnerUid</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Groos Amount</th>
                        <th class="px-6 py-3">Fee Amount</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">CreatedAt</th>
                        <th class="px-6 py-3">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                            <td class="px-6 py-4">{{ $transaction->id }}</td>
                            <td class="px-6 py-4">{{ $transaction->ownerUid }}</td>
                            <td class="px-6 py-4">{{ $transaction->email }}</td>
                            <td class="px-6 py-4">{{ $transaction->name }}</td>
                            <td class="px-6 py-4 @if ($transaction->status == 'paid') text-green-600 font-bold @endif">
                                + Rp.{{ number_format($transaction->totalGroosAmount) }}
                            </td>
                            <td class="px-6 py-4 @if ($transaction->status == 'paid') text-red-600 @endif">
                                -Rp.{{ number_format($transaction->totalfeeTrx) }}
                            </td>
                            <td class="px-6 py-4">{{ ucfirst($transaction->status) }}</td>
                            <td class="px-6 py-4">{{ $transaction->createdAt }}</td>
                            <td class="px-6 py-4">{{ $transaction->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-gray-500">Tidak Ada Transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4">{{ $transactions->links() }}</div>
        </div>
    </div> --}}

    <div class="md:col-span-2">
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">ID Trx</th>
                        <th class="px-6 py-3">OwnerUid</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Groos Amount</th>
                        <th class="px-6 py-3">Fee Amount</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">CreatedAt</th>
                        <th class="px-6 py-3">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions->data as $transaction)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->id ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->ownerUID ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->ownerEmail ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->userName ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap @if (($transaction->status ?? '') == 'paid') text-green-600 font-bold @endif">
                            + Rp.{{ number_format($transaction->totalGroosAmount ?? 0) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap @if (($transaction->status ?? '') == 'paid') text-red-600 @endif">
                            -Rp.{{ number_format($transaction->totalfeeTrx ?? 0) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap @if (($transaction->status ?? '') == 'paid') text-green-600 font-bold @endif">{{ ucfirst($transaction->status ?? '-') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ formatTanggal($transaction->createdAt ?? '-') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->description ?? '-' }}</td>
                    </tr>

                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-gray-500">Tidak Ada Transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Kode Pagination Lama Dikomentari -->
            {{-- <div class="p-4">{{ $transactions->links() }}</div> --}}

            <!-- Infinite Scroll: Button Muat Lebih Banyak -->
            @if ($isLoading)
                <div class="flex justify-center mt-4">
                    <p>Loading...</p>
                </div>
            @endif

        @if ($hasMore && !$isLoading)
            <div class="flex justify-center mt-4">
                <button wire:click="loadMore" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Muat Lebih Banyak
                </button>
            </div>
        @endif
        </div>
    </div>


</div>
<script>
    document.addEventListener('scroll', () => {
        const loading = @json($isLoading); // Cek state loading dari backend
        if (loading) return; // Jika sedang loading, tidak lakukan apa-apa

        // Jika pengguna mencapai bagian bawah halaman, panggil loadMore
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            Livewire.emit('loadMore');
        }
    });
</script>
