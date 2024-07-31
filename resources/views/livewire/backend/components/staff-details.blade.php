<div>
    <div class="col-span-1 md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        @if ($is_bankActive)
            @livewire('backend.components.bank-account-form', ['ownerUid' => $ownerUid])
        @endif
        <div @if ($is_bankActive) class=" hidden " @endif>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Staff</h3>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Staff</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Name</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Email</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Role</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Username</th>
                        <th scope="col" class="px-6 py-3 whitespace-nowrap">Disabled</th>
                    </tr>
                </thead>
                <tbody>
                    @if (is_array($staff) && count($staff) > 0)
                        @foreach ($staff as $index => $staffMember)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Staff
                                    {{ $index + 1 }}</td>
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
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Metode Pembayaran Digital</h3>
                <table id="documentsTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">Metode</th>
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">Status Activated</th>
                            @if (isset($data->qris))
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Status GoePos</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Status Owner</th>
                                <th scope="col" class="px-6 py-3 whitespace-nowrap">Net Amount</th>
                            @endif
                            <th scope="col" class="px-6 py-3 whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($paymentMethod) > 0)
                            @foreach ($paymentMethod as $payment)
                                @if ($payment->active)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $payment->name ?? '-' }}</td>
                                        <td class="px-6 whitespace-nowrap">
                                            @if (isset($data->qris))
                                                <span
                                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Active</span>
                                            @else
                                                Not Activated
                                            @endif
                                        </td>
                                        @if (isset($data->qris))
                                            <td class="px-6 whitespace-nowrap">
                                                @if ($data->qris->enabledByGoePos)
                                                    <span
                                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Active</span>
                                                @else
                                                    <span
                                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">inactive</span>
                                                @endif
                                            </td>
                                            <td class="px-6 whitespace-nowrap">
                                                @if ($data->qris->enabledByOwner)
                                                    <span
                                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Active</span>
                                                @else
                                                    <span
                                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">inactive</span>
                                                @endif
                                            </td>
                                            <td class="px-6 whitespace-nowrap">
                                                {{-- {{ \app\Helpers\HelpersUtils::formatRupiah($net_amount) }} --}}
                                                Rp. {{ $net_amount }}
                                            </td>
                                        @endif
                                        <td class="px-6 whitespace-nowrap">

                                            <div class="{{ isset($data->qris) ? 'hidden' : '' }}">
                                                <button type="button" id="activate-button"
                                                    class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                    style="margin-right: 20px;">Activate</button>

                                                <button type="button" id="confirm-activate"
                                                    class="hidden px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                    wire:click.prevent="qrisActivate" wire:loading.attr="disabled"
                                                    wire:loading.class="bg-gray-500" wire:target="qrisActivate">
                                                    <svg wire:loading wire:target="qrisActivate" aria-hidden="true"
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
                                                    <span wire:loading.remove wire:target="activateQris">Activate</span>
                                                    <span wire:loading wire:target="activateQris">Activating...</span>
                                                </button>
                                            </div>

                                            <div @if(isset($data->qris)) class="" @else class="hidden" @endif>

                                                <a id="disabledButtom" @if(isset($data->qris->enabledByGoePos)) @if($data->qris->enabledByGoePos) class="font-medium text-red-600 dark:text-red-500 hover:underline" @else class="hidden" @endif @else class="font-medium text-red-600 dark:text-red-500 hover:underline" @endif

                                                    style="margin-right: 20px;">Disabled</a>

                                                <a id="disabledButtonloading" class="hidden "
                                                    style="margin-right: 20px;" wire:click.prevent="qrisDisabled"
                                                    wire:loading.attr="disabled" wire:loading.class=""
                                                    wire:target="qrisDisabled">
                                                    <!-- Ikon pemuatan (spinner) yang muncul saat proses pemuatan -->
                                                    <svg wire:loading wire:target="qrisDisabled" aria-hidden="true"
                                                        role="status"
                                                        class="inline w-4 h-4 me-3 text-black animate-spin"
                                                        viewBox="0 0 100 101" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                            fill="#E5E7EB" />
                                                        <path
                                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    <!-- Teks yang muncul saat tidak dalam proses pemuatan -->
                                                    <span wire:loading.remove wire:target="qrisDisabled">Disabled</span>
                                                </a>

                                                <a id="activeButtom" @if(isset($data->qris->enabledByGoePos)) @if($data->qris->enabledByGoePos == false) class="font-medium text-blue-600 dark:text-blue-500 hover:underline"  @else class="hidden" @endif @else class="font-medium text-blue-600 dark:text-blue-500 hover:underline" @endif
                                                    style="margin-right: 20px;">Active</a>
                                                <a id="activeButtonloading" class="hidden " style="margin-right: 20px;"
                                                    wire:click.prevent="qrisActive" wire:loading.attr="disabled"
                                                    wire:loading.class="" wire:target="qrisActive">
                                                    <!-- Ikon pemuatan (spinner) yang muncul saat proses pemuatan -->
                                                    <svg wire:loading wire:target="qrisActive" aria-hidden="true"
                                                        role="status"
                                                        class="inline w-4 h-4 me-3 text-black animate-spin"
                                                        viewBox="0 0 100 101" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                            fill="#E5E7EB" />
                                                        <path
                                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    <!-- Teks yang muncul saat tidak dalam proses pemuatan -->
                                                    <span wire:loading.remove wire:target="qrisActive">Active</span>

                                                    <a wire:navigate
                                                        href="{{ route('transaction.qris', ['id' => $ownerUid]) }}"
                                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                                            </div>

                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3"
                                    class="px-6 whitespace-nowrap text-center text-gray-500 dark:text-gray-400">Data
                                    tidak
                                    ditemukan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
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

        // function initializeSweetAlert() {

        //     const activateButton = document.getElementById('activate-button');
        //     if (activateButton) {
        //         activateButton.addEventListener('click', function() {
        //             Swal.fire({
        //                 title: 'Apakah Kamu Yakin?',
        //                 text: "Kamu Akan Mengaktifkan Metode Pembayaran QRIS!",
        //                 icon: 'warning',
        //                 showCancelButton: true,
        //                 confirmButtonColor: '#3085d6',
        //                 cancelButtonColor: '#d33',
        //                 cancelButtonText: 'Tidak',
        //                 confirmButtonText: 'Ya'
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        //                     document.getElementById('activate-button').classList.add('hidden');
        //                     document.getElementById('confirm-activate').classList.remove('hidden');
        //                     document.getElementById('confirm-activate').click();
        //                 }
        //             });
        //         });
        //     }

        //     const disabledButton = document.getElementById('disabledButtom');
        //     if (disabledButton) {
        //         disabledButton.addEventListener('click', function() {
        //             Swal.fire({
        //                 title: 'Apakah Kamu Yakin?',
        //                 text: "Kamu Akan Menonaktifkan Metode Pembayaran QRIS",
        //                 icon: 'warning',
        //                 showCancelButton: true,
        //                 confirmButtonColor: '#3085d6',
        //                 cancelButtonColor: '#d33',
        //                 cancelButtonText: 'Tidak',
        //                 confirmButtonText: 'Ya'
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        //                     document.getElementById('disabledButtom').classList.add('hidden');
        //                     document.getElementById('disabledButtonloading').classList.remove('hidden');
        //                     document.getElementById('disabledButtonloading').click();
        //                 }
        //             });
        //         });
        //     }

        //     const activeButton = document.getElementById('activeButtom');
        //     if (activeButton) {
        //         activeButton.addEventListener('click', function() {
        //             Swal.fire({
        //                 title: 'Apakah Kamu Yakin?',
        //                 text: "Kamu Akan Mengaktifkan Metode Pembayaran QRIS",
        //                 icon: 'warning',
        //                 showCancelButton: true,
        //                 confirmButtonColor: '#3085d6',
        //                 cancelButtonColor: '#d33',
        //                 cancelButtonText: 'Tidak',
        //                 confirmButtonText: 'Ya'
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        //                     document.getElementById('activeButtom').classList.add('hidden');
        //                     document.getElementById('activeButtonloading').classList.remove('hidden');
        //                     document.getElementById('activeButtonloading').click();
        //                 }
        //             });
        //         });
        //     }
        // }

        document.addEventListener('livewire:init', function() {
            Livewire.on('documentsLoaded', () => {
                initializeSweetAlert();
            });

            Livewire.hook('message.processed', (message, component) => {
                initializeSweetAlert();
            });

            initializeSweetAlert();
        });

        const activateButton = document.getElementById('activate-button');
            if (activateButton) {
                activateButton.addEventListener('click', function() {
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
                            document.getElementById('activate-button').classList.add('hidden');
                            document.getElementById('confirm-activate').classList.remove('hidden');
                            document.getElementById('confirm-activate').click();
                        }
                    });
                });
            }

            const disabledButton = document.getElementById('disabledButtom');
            if (disabledButton) {
                disabledButton.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Apakah Kamu Yakin?',
                        text: "Kamu Akan Menonaktifkan Metode Pembayaran QRIS",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Tidak',
                        confirmButtonText: 'Ya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('disabledButtom').classList.add('hidden');
                            document.getElementById('disabledButtonloading').classList.remove('hidden');
                            document.getElementById('disabledButtonloading').click();
                        }
                    });
                });
            }

            const activeButton = document.getElementById('activeButtom');
            if (activeButton) {
                activeButton.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Apakah Kamu Yakin?',
                        text: "Kamu Akan Mengaktifkan Metode Pembayaran QRIS",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Tidak',
                        confirmButtonText: 'Ya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('activeButtom').classList.add('hidden');
                            document.getElementById('activeButtonloading').classList.remove('hidden');
                            document.getElementById('activeButtonloading').click();
                        }
                    });
                });
            }
    </script>
</div>
