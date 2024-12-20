<div wire:init="loadDocuments">
    <div class="px-6 bg-white border-b border-gray-200">
        <div class="relative overflow-x-auto shadow-md">
            <!-- Skeleton Loader -->
            <div wire:loading class="animate-pulse">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">No</th>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">Name</th>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">Email</th>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">City</th>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">Phone</th>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">Product</th>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">Expiration</th>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">Last Login</th>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">Last Month Trx</th>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">Last Month QTY Trx</th>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">Last Day Trx</th>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">Last Day QTY Trx</th>
                            <th scope="col" class="px-4 py-3 whitespace-nowrap">UpdateAt</th>
                            <th scope="col" class="px-4 py-3 text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 5; $i++)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                                <td class="px-4 py-3"><div class="h-4 bg-gray-200 rounded"></div></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>

            <!-- Data Table -->
            <table id="documentsTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 table-auto" wire:loading.remove>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">No</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">Name</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">Email</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">Qris</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">Last Login</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">City</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">Phone</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">Product</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">Expiration</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">Last Month Trx</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">Last Month QTY Trx</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">Last Day Trx</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">Last Day QTY Trx</th>
                        <th scope="col" class="px-4 py-3 whitespace-nowrap">UpdateAt</th>
                        <th scope="col" class="px-4 py-3 text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($documents) > 0)
                        @foreach ($documents as $document)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $document->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap ">{{ $document->email ?? '-' }}</td>

                                <td class="px-4 py-3 whitespace-nowrap ">
                                    @if(isset($document->qris->activationStatus) && $document->qris->activationStatus === 'active')
                                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">Active</span>
                                    @elseif (isset($document->qris->activationStatus) && $document->qris->activationStatus === 'verifying')
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-400 border border-yellow-400">verifying</span>
                                    @elseif(isset($document->qris->activationStatus) && $document->qris->activationStatus === 'rejected')
                                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">Rejected</span>

                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap">{{ $document->lastLogin }}</td>



                                <td class="px-4 py-3 whitespace-nowrap">{{ $document->location->city ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $document->phone ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $document->sku ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $document->expiration ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $document->totalTrxMonth ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $document->totalTrxQtyMonth ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $document->totalTrxDay ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $document->totalTrxQtyDay ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ isset($document->createdAt) ? $document->createdAt : '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-right">
                                    <a  href="{{ route('businesses.detail', ['id' => $document->ownerUid]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr wire:loading.remove>
                            <td colspan="15" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
