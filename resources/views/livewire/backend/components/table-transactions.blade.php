<div>
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
                                <td class="px-6 py-4 whitespace-nowrap @if($transaction->status == 'paid') text-green-600 font-bold @endif">+ Rp.{{ $transaction->totalGroosAmount }}</td>
                                @if($transaction->typePayment == 'withdrawal')
                                    <td class="px-6 py-4 whitespace-nowrap @if($transaction->status == 'paid') text-red-600 @endif">-Rp.{{ $transaction->totalfeeTransfer }}</td>
                                @else
                                    <td class="px-6 py-4 whitespace-nowrap @if($transaction->status == 'paid') text-red-600 @endif">-Rp.{{ $transaction->totalfeeTrx }}</td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap @if($transaction->status == 'expired') text-red-600 @elseif($transaction->status == 'processing') text-yellow-900 @else text-green-600 font-bold @endif">{{ $transaction->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \App\Helpers\HelpersUtils::convertTimestampToDateTrx($transaction->createdAt) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">@if($transaction->status == 'paid') Fee Transaction {{ $transaction->feePercent }}% @elseif($transaction->status == 'completed') Penarikan Saldo @else - @endif</td>
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
</div>
