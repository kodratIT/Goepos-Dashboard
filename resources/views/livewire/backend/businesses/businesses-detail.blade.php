<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Businesses
        </h2>
    </x-slot>
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Left Section: User Details -->
            <div class="col-span-1 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">User Details</h3>
                <table class="w-full text-gray-700 dark:text-gray-300">
                    <tbody>
                        <tr>
                            <td class="font-semibold text-gray-900 dark:text-white">Name</td>
                            <td>:</td>
                            <td>{{ $data->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold text-gray-900 dark:text-white">Email</td>
                            <td>:</td>
                            <td>{{ $data->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold text-gray-900 dark:text-white">Address</td>
                            <td>:</td>
                            <td>{{ $data->location['street'] ?? '-' }}, {{ $data->location['city'] ?? '-' }}, {{ $data->location['country'] ?? '-' }}, {{ $data->location['zipCode'] ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold text-gray-900 dark:text-white">Phone</td>
                            <td>:</td>
                            <td>{{ $data->phone ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold text-gray-900 dark:text-white">Owner Email</td>
                            <td>:</td>
                            <td>{{ $data->ownerEmail ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold text-gray-900 dark:text-white">Description</td>
                            <td>:</td>
                            <td>{{ $data->description ?? '-' }}</td>
                        </tr>
                        {{-- <tr>
                            <td class="font-semibold text-gray-900 dark:text-white">Display Image</td>
                            <td>:</td>
                            <td><img src="{{ $data->displayImage ?? '#' }}" alt="Display Image" class="h-16 w-16 object-cover"></td>
                        </tr>
                        <tr>
                            <td class="font-semibold text-gray-900 dark:text-white">Image</td>
                            <td>:</td>
                            <td><img src="{{ $data->image ?? '#' }}" alt="Image" class="h-16 w-16 object-cover"></td>
                        </tr> --}}
                        <tr>
                            <td class="font-semibold text-gray-900 dark:text-white">Subscription Products</td>
                            <td>:</td>
                            <td>{{ $data->subscriptionProducts ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold text-gray-900 dark:text-white">Subscription Staffs</td>
                            <td>:</td>
                            <td>{{ $data->subscriptionStaffs ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold text-gray-900 dark:text-white">VAT Number</td>
                            <td>:</td>
                            <td>{{ $data->vatNumber ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold text-gray-900 dark:text-white">Website</td>
                            <td>:</td>
                            <td>{{ $data->website ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Right Section: Staff Details and Payment Methods -->
            <div class="col-span-1 md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
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
                                @if ($data->qris != null)
                                    <th scope="col" class="px-6 py-3">Status Owner</th>
                                    <th scope="col" class="px-6 py-3">Status GoePos</th>
                                @endif
                                <th scope="col" class="px-6 py-3  ">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($paymentMethod) > 0)
                                @foreach ($paymentMethod as $payment)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $payment['name'] ?? '-' }}</td>
                                        <td class="px-6 py-4">
                                            @if ($data->qris != null)
                                                Active
                                            @else
                                                Not Activated
                                            @endif
                                        </td>
                                        @if ($data->qris != null)
                                            <td class="px-6 py-4">
                                                @if ($data->qris['enableByGoePos'])
                                                    Active
                                                @else
                                                    inactive
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($data->qris['enableByOwner'])
                                                    Active
                                                @else
                                                    inActive
                                                @endif
                                            </td>
                                        @endif
                                        <td class="px-6 py-4">
                                            @if ($data->qris != null)
                                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline p-2">Disabled</a>
                                                <a href="{{ route('businesses.detail', ['id' => 1]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>

                                            @else
                                            <form wire:submit.prevent="qrisActivate">
                                                <div class="flex space-x-4">
                                                    <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" style="margin-right: 20px;">Activate</button>
                                                    <a href="{{ route('businesses.detail', ['id' => 1]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                                                </div>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Data tidak ditemukan</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
