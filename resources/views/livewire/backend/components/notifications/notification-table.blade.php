<div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Background</th>
                <th class="px-6 py-3">Icon</th>
                <th class="px-6 py-3">Icon Color</th>
                <th class="px-6 py-3">Message</th>
                <th class="px-6 py-3">Title</th>
                <th class="px-6 py-3">Show Until</th>
                <th class="px-6 py-3">Type</th>
                <th class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($notifications as $notification)
                <tr class="bg-white border-b text-center">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $notification['id'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="block w-full h-4 rounded" style="background-color: {{ $notification['background'] }};"></span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if (filter_var($notification['icon'], FILTER_VALIDATE_URL))
                            <img src="{{ $notification['icon'] }}" alt="icon" class="w-6 h-6 rounded">
                        @else
                            <span class="text-gray-500">{{ ucfirst($notification['icon']) }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap" style="color: {{ $notification['iconColor'] ?? '#000' }};">
                        {{ $notification['iconColor'] ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @foreach ($notification['message'] as $msg)
                            @if ($msg['lang'] === 'in')
                                <div class="text-gray-800">{{ $msg['text'] }}</div>
                                @if (isset($msg['actionText']) && isset($msg['action']))
                                    <a href="{{ $msg['action'] }}" class="text-blue-500 font-{{ $msg['actionTextStyle'] ?? 'normal' }} underline" style="color: {{ $msg['actionTextColor'] ?? '#000' }};">
                                        {{ $msg['actionText'] }}
                                    </a>
                                @endif
                            @endif
                        @endforeach
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @foreach ($notification['title'] as $title)
                            @if ($title['lang'] === 'in')
                                <span style="color: {{ $notification['titleColor'] ?? '#000' }};">
                                    {{ $title['text'] }}
                                </span>
                            @endif
                        @endforeach
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $notification['showUntil'] ? $notification['showUntil']->format('d-m-Y H:i') : 'Permanent' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($notification['type']) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <a href="{{ route('notifications-edit') }}" wire:navigate.hover rel="noopener noreferrer"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition ease-in-out duration-150 shadow-sm hover:shadow-md focus:outline-none focus:ring focus:ring-blue-200">
                            <!-- Ikon Edit -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232a3 3 0 114.243 4.243L8.243 20.707a1 1 0 01-.293.207l-4 2a1 1 0 01-1.36-1.36l2-4a1 1 0 01.207-.293l11.242-11.243z" />
                            </svg>
                            Edit
                        </a>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-gray-500">Tidak Ada Notifikasi</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
