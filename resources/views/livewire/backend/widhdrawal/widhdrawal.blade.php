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
                            <div>
                                <label for="message" class="block mt-5 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                <textarea id="message" rows="4" class="@if ($verify)
                                    bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                @else
                                    p-2.5 w-full text-sm text-gray-900 bg-white-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                @endif " placeholder="Keterangan" @if ($verify)
                                    disabled
                                @endif></textarea>
                            </div>
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
                            @if($verify)
                            <button wire:click="createPaymentTransferQris" class="bg-red-500 text-white px-4 py-2 rounded">Penarikan Saldo</button>
                            @else
                            <button wire:click="verifyWd" class="bg-red-500 text-white px-4 py-2 rounded">Penarikan Saldo</button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



{{-- <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    Toggle modal
    </button>

    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                    <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- @livewireScripts --}}

    {{-- <script>
        var rangeInput = document.getElementById('price-range-input');
        var currencyInput = document.getElementById('currency-input');

        function updateCurrencyInput() {
            currencyInput.value = rangeInput.value;
        }

        rangeInput.addEventListener('input', updateCurrencyInput);

    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const inputField = document.getElementById('currency-input');

            inputField.addEventListener('input', (event) => {
                const newValue = event.target.value;
            });
        });
    </script>
</div>
