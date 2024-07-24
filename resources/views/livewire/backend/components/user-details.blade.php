<div>
    <div class="col-span-1 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">User Details</h3>

        <!-- Skeleton loading -->
        <div wire:loading role="status" class="max-w-sm animate-pulse space-y-2.5">
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[330px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[300px] mb-2.5"></div>
            <div class="h-2 bg-gray-200 rounded-full dark:bg-gray-700 max-w-[360px]"></div>
            <span class="sr-only">Loading...</span>
        </div>

        <!-- Table content -->
        <div wire:loading.remove>
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
    </div>
</div>
