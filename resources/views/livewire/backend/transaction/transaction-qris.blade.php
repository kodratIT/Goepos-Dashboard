<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Metode Pembayaran
        </h2>
    </x-slot>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">History Transactions QRIS</h2>
            <a wire:navigate.hover href="{{ route('widhdrawal.qris', ['id' => $transactionsDetail->ownerUid]) }}" class="bg-success-500 text-white px-4 py-2 rounded bg-blue-500">Penarikan Saldo</a>
            {{-- <button wire:click="createTransaction" class="bg-red-500 text-white px-4 py-2 rounded bg-blue-500">Penarikan Saldo</button> --}}
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Transactions Table -->
            <div class="md:col-span-2">
                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <table id="documentsTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>

                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">ID Trx</th>
                                <th scope="col" class="px-6 py-3">Groos Amount</th>
                                <th scope="col" class="px-6 py-3">Fee Amount</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">CreatedAt</th>
                                <th scope="col" class="px-6 py-3">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($transactions) > 0)
                                @foreach ($transactions as $index => $transaction)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-center">
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $transaction->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap  @if($transaction->status == "paid")text-green-600  font-bold @endif">+ Rp.{{ $transaction->totalGroosAmount }}</td>
                                        @if($transaction->typePayment == 'withdrawal')
                                             <td class="px-6 py-4 whitespace-nowrap @if($transaction->status == "paid") text-red-600 @endif ">-Rp.{{$transaction->totalfeeTransfer }}</td>
                                        @else
                                             <td class="px-6 py-4 whitespace-nowrap @if($transaction->status == "paid") text-red-600 @endif ">-Rp.{{$transaction->totalfeeTrx }}</td>
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap   @if($transaction->status == 'expired') text-red-600  @elseif ($transaction->status == 'processing') text-yellow-900) @else text-green-600  font-bold @endif "><span class="">{{ $transaction->status }}</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->createdAt }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">@if($transaction->status == 'paid')Fee Transaction {{ $transaction->feePercent }}@elseif($transaction->status == 'completed')Penarikan Saldo @else - @endif</td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        Tidak Ada Transaction
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-4">
                <div class="bg-white shadow-md rounded-lg p-4 mb-5">
                    <h3 class="text-lg font-bold">Saldo (paid)</h3>
                    <p class="text-2xl font-bold">@if(property_exists($transactionsDetail, 'net_qris_amount'))Rp.{{ $transactionsDetail->net_qris_amount }}@else - @endif</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-4 mb-5">
                    <h3 class="text-lg font-bold">Sedang diproses (settlement)</h3>
                    <p class="text-2xl font-bold">@if(property_exists($transactionsDetail, 'settlement_qris_amount'))Rp.{{ $transactionsDetail->settlement_qris_amount }}@else - @endif</p>
                </div>
                <div class="col-span-1 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">User Details</h3>
                    <table class="w-full text-gray-700 dark:text-gray-300">
                        <tbody>
                            <tr>
                                <td class="font-semibold text-gray-900 dark:text-white">Name</td>
                                <td>:</td>
                                <td>{{ $document->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold text-gray-900 dark:text-white">Email</td>
                                <td>:</td>
                                <td>{{ $document->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold text-gray-900 dark:text-white">Address</td>
                                <td>:</td>
                                <td>{{ $document->location->street ?? '-' }}, {{ $document->location->city ?? '-' }}, {{ $document->location->country ?? '-' }}, {{ $document->location->zipCode ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold text-gray-900 dark:text-white">Phone</td>
                                <td>:</td>
                                <td>{{ $document->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold text-gray-900 dark:text-white">Owner Email</td>
                                <td>:</td>
                                <td>{{ $document->ownerEmail ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold text-gray-900 dark:text-white">Description</td>
                                <td>:</td>
                                <td>{{ $document->description ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold text-gray-900 dark:text-white">Subscription Products</td>
                                <td>:</td>
                                <td>{{ $document->subscriptionProducts ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold text-gray-900 dark:text-white">Subscription Staffs</td>
                                <td>:</td>
                                <td>{{ $document->subscriptionStaffs ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold text-gray-900 dark:text-white">VAT Number</td>
                                <td>:</td>
                                <td>{{ $document->vatNumber ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold text-gray-900 dark:text-white">Website</td>
                                <td>:</td>
                                <td>{{ $document->website ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
