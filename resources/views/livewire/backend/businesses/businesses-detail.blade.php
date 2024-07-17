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
                            <td>{{ $data->location->street ?? '-' }}, {{ $data->location->city ?? '-' }}, {{ $data->location->country ?? '-' }}, {{ $data->location->zipCode ?? '-' }}</td>
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
                @if ($is_bankActive)
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Bank Account</h3>
                    <form wire:submit.prevent="saveBankAccount">
                        <div class="mb-6">
                            <label for="Bank-type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bank Name</label>
                            <select id="Bank-type" wire:model="bankType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Pilih Bank</option>
                                <option value="MANDIRI">Bank Mandiri</option>
                                <option value="BCA">Bank Central Asia (BCA)</option>
                                <option value="BRI">Bank Rakyat Indonesia (BRI)</option>
                                <option value="BNI">Bank Negara Indonesia (BNI)</option>
                                <option value="CIMB">CIMB Niaga</option>
                                <option value="DANAMON">Bank Danamon</option>
                                <option value="PERMATA">Bank Permata</option>
                                <option value="PANIN">Bank Panin</option>
                                <option value="BTN">Bank Tabungan Negara (BTN)</option>
                                <option value="MEGA">Bank Mega</option>
                            </select>
                        </div>

                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name Account</label>
                                <input type="text" id="first_name" wire:model="nameAccount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Goe Pos" required />
                            </div>
                            <div>
                                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bank Number</label>
                                <input type="number" id="last_name" wire:model="bankNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1210971921971" required />
                            </div>
                        </div>

                        <div class="flex flex-col items-end mt-10">
                            <button wire:click="isSaving" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Simpan
                            </button>
                            <div wire:loading class="mt-2">
                                Menyimpan...
                            </div>
                        </div>

                    </form>



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

                    {{ $isSaving }}
            </div>
        </div>
    </div>

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
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Kamu Yakin untuk Melakukan Aktivasi Metode Pembayaran QRIS?</h3>
                    <div class="flex justify-center items-center space-x-6 text-center">
                        <form wire:submit.prevent="qrisActivate">
                            <button type="submit" data-modal-hide="popup-modal" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            No, cancel
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
