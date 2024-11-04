<div class="{{ $darkMode ? 'dark' : '' }}">

    <!-- Header: Per Page, Search & Dark Mode -->
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
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
        </div>

        {{-- <button wire:click="toggleDarkMode" class="ml-4 bg-gray-800 text-white px-4 py-2 rounded">
            {{ $darkMode ? 'Light Mode' : 'Dark Mode' }}
        </button> --}}
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
