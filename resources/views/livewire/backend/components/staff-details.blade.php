<div>
    <div class="col-span-1 md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        @if ($is_bankActive)
            @livewire('bank-account-form')
        @else
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Staff</h3>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Staff</th>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Role</th>
                        <th scope="col" class="px-6 py-3">Username</th>
                        <th scope="col" class="px-6 py-3">Disabled</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($staff) > 0)
                        @foreach($staff as $index => $staffMember)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Staff {{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $staffMember->name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $staffMember->ownerEmail ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $staffMember->role ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $staffMember->username ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $staffMember->disabled ? 'Yes' : 'No' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                Tidak Ada Data
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <hr class="mt-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Metode Pembayaran Digital</h3>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table id="documentsTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Metode</th>
                            <th scope="col" class="px-6 py-3">Status Activated</th>
                            @if (property_exists($data, 'qris'))
                                <th scope="col" class="px-6 py-3">Status Owner</th>
                                <th scope="col" class="px-6 py-3">Status GoePos</th>
                            @endif
                            <th scope="col" class="px-6 py-3  ">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($paymentMethod) > 0)
                            @foreach ($paymentMethod as $payment)
                                @if($payment->active)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $payment->name ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        @if (property_exists($data, 'qris'))
                                            Active
                                        @else
                                            Not Activated
                                        @endif
                                    </td>
                                    @if (property_exists($data, 'qris'))
                                        <td class="px-6 py-4">
                                            @if ($data->qris->enabledByGoePos)
                                                Active
                                            @else
                                                inactive
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($data->qris->enabledByOwner)
                                                Active
                                            @else
                                                inActive
                                            @endif
                                        </td>
                                    @endif
                                    <td class="px-6 py-4">
                                        @if (property_exists($data, 'qris'))
                                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline p-2">Disabled</a>
                                            <a wire:navigate href="{{ route('transaction.qris', ['id' =>  $data->ownerUid]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                                        @else
                                            <button type="buttom" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" style="margin-right: 20px;">Activate</button>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Data tidak ditemukan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>
