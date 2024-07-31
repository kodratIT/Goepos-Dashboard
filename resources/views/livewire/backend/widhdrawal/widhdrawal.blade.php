<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Withdrawal Qris
        </h2>
    </x-slot>

    <div class="py-12 m-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Bagian Kiri (Detail Bank, Detail Pelanggan, Detail Penarikan) -->
                <div class="lg:col-span-8 space-y-6">
                    <!-- Detail Bank -->
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Detail Bank</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div>
                                <label for="bankName" class="block font-medium text-gray-700">Bank Account</label>
                                <input type="text" id="bankName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $bankAccount->bankType }}"  disabled />
                            </div>
                            <div>
                                <label for="bankName" class="block font-medium text-gray-700">Nama Pemilik</label>
                                <input type="text" id="bankName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $bankAccount->nameAccount }}"  disabled disabled />
                            </div>
                            <div>
                                <label for="bankAccountNumber" class="block font-medium text-gray-700">No. Rekening</label>
                                <input type="text" id="bankAccountNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $bankAccount->accountNumber }}"  disabled />
                            </div>
                        </div>
                    </div>

                    <!-- Detail Pelanggan -->
                    {{-- {{ dd($documents) }}balanceCheckout --}}
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Detail Pelanggan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="accountName" class="block font-medium text-gray-700">Name (Toko)</label>
                                <input type="text" id="accountName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ isset($document->name) ? $document->name : '-' }}" disabled />
                            </div>
                            <div>
                                <label for="customerName" class="block font-medium text-gray-700">Name Owner</label>
                                <input type="text" id="customerName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ isset($document->name) ? $document->name : '-' }}" disabled />
                            </div>
                            <div>
                                <label for="email" class="block font-medium text-gray-700">Email</label>
                                <input type="text" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $document->email }}" disabled />
                            </div>
                            <div>
                                <label for="phone" class="block font-medium text-gray-700">Phone</label>
                                <input type="text" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ isset($document->phone) ? $document->phone : '-' }}" disabled />
                            </div>
                        </div>
                    </div>

                    <!-- Detail Penarikan -->
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Detail Penarikan</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <label for="message" class="block text-sm font-medium text-gray-900 dark:text-white">Balance Amount</label>


                            <div class="flex">
                                <button id="dropdown-currency-button"  class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">
                                    Rupiah <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>
                                </button>
                                <label for="currency-input" value="{{ $balanceCheckout }}" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
                                <div class="relative w-full">
                                    <input type="text" wire:model.lazy="balanceCheckout" wire:change="updateBalance($event.target.value)" id="currency-input" class="@if ($verify)
                                        bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                    @else
                                        block p-2.5 w-full z-20 text-sm text-gray-900 bg-white-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500
                                    @endif " placeholder="Enter amount" required @if($verify) disabled @endif  />
                                </div>

                            </div>
                            <span class="block text-sm font-small text-blue-900 dark:text-blue">Avalable Balance Rp.    {{ $balanceAmount }}</span>

                            {{-- <div class="relative">
                                <label for="price-range-input" class="sr-only">Default range</label>
                                <input id="price-range-input" type="range" value="{{ $balanceCheckout }}" min="100000" max="{{ $balanceCheckout }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                                <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6">Min (100000)</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-1/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">{{ $balanceCheckout/3 }}</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-2/3 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">{{ $balanceCheckout/2 }}</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6">Max ({{ $balanceCheckout }})</span>
                            </div> --}}
                            {{-- <div>
                                <label for="message" class="block mt-5 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                <textarea id="message" rows="4" class="@if ($verify)
                                    bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                @else
                                    p-2.5 w-full text-sm text-gray-900 bg-white-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                @endif " placeholder="Keterangan" @if ($verify)
                                    disabled
                                @endif></textarea>
                            </div> --}}
                        </div>
                    </div>

                </div>

                <!-- Bagian Kanan (Rincian Penarikan) -->
                <div class="lg:col-span-4">
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Rincian Penarikan</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white dark:bg-gray-800 ">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                Groos Amount
                                            </th>
                                            <td class="px-6 py-4">
                                                Rp.{{ $groosAmount  }}
                                            </td>
                                        </tr>
                                        <tr class="bg-white dark:bg-gray-800 ">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                Fee Trx
                                            </th>
                                            <td class="px-6 py-4">
                                                Rp.{{ $feeTrx  }}
                                            </td>
                                        </tr>
                                        <tr class="bg-white dark:bg-gray-800 ">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                Available Amount
                                            </th>
                                            <td class="px-6 py-4">
                                                Rp.{{ $balanceAmount  }}
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                    </thead>
                                    <tbody>
                                        <hr>
                                        <tr class="bg-white dark:bg-gray-800">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                Transaksi Amount
                                            </th>
                                            <td class="px-6 py-4">
                                                Rp.{{ $balanceCheckout }}
                                            </td>
                                        </tr>

                                        <tr class="bg-white dark:bg-gray-800">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                Fee Transfer
                                            </th>

                                            <td class="px-6 py-4">
                                                 - Rp.{{ $feeTransfer  }}
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="font-semibold text-gray-900 dark:text-white">
                                            <th scope="row" class="px-6 py-3 text-base">Total</th>
                                            <td class="px-6 py-3">Rp.{{ $balanceCheckout - ($feeTransfer) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                        <div class="flex justify-end mt-5">
                            <button id="finish" @if($verify) class=" bg-blue-500 text-white px-4 py-2 rounded" @else class="hidden" @endif >Penarikan Saldo</button>
                            <button type="button" id="send"
                                class="hidden px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                wire:click.prevent="createPaymentTransferQris" wire:loading.attr="disabled"
                                wire:loading.class="bg-gray-500" wire:target="createPaymentTransferQris">
                                <svg wire:loading wire:target="createPaymentTransferQris" aria-hidden="true"
                                    role="status" class="inline w-4 h-4 me-3 text-white animate-spin"
                                    viewBox="0 0 100 101" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="#E5E7EB" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentColor" />
                                </svg>
                                <span wire:loading.remove wire:target="createPaymentTransferQris">Penarikan Saldo</span>
                                <span wire:loading wire:target="createPaymentTransferQris">Processing...</span>
                            </button>

                            <button  @if(!$verify) class=" bg-blue-500 text-white px-4 py-2 rounded" @else class="hidden" @endif wire:click="verifyWd" class="bg-blue-500 text-white px-4 py-2 rounded">Penarikan Saldo</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('documentsLoaded', () => {
                initializeSweetAlert();
            });

            Livewire.hook('message.processed', (message, component) => {
                initializeSweetAlert();
            });

            initializeSweetAlert();
        });

        function initializeSweetAlert() {
            const finish = document.getElementById('finish');
            if (finish) {
                finish.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Apakah Kamu Yakin?',
                        text: "Kamu Akan Mengaktifkan Metode Pembayaran QRIS!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Tidak',
                        confirmButtonText: 'Ya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('finish').classList.add('hidden');
                            document.getElementById('send').classList.remove('hidden');
                            document.getElementById('send').click();
                        }
                    });
                });
            }


        }
    </script>
</div>
