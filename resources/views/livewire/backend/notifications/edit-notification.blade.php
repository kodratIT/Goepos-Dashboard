<div class="max-w-4xl mx-auto mt-10 py-10 px-6 bg-white shadow-md rounded-lg">
    <!-- Header with Back Button -->
    <div class="flex justify-between items-center mb-6 border-b pb-3">
        <h2 class="text-3xl font-semibold text-gray-800">Edit Notification</h2>
        <!-- Back Button -->
        <a href="{{ route('notifications') }}" wire:navigate.hover class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg shadow-md hover:bg-gray-300 transition">
            Back to List Notification
        </a>
    </div>

    <form wire:submit.prevent="saveNotification">
        <!-- Section: Notification Details -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-medium text-gray-700">Notification ID</label>
                <input type="text" wire:model="newNotification.id"
                       placeholder="e.g., notif_123"
                       class="mt-1 block w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                       required>
                <p class="text-xs text-gray-500 mt-1">Unique ID for this notification</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Background Color</label>
                <input type="text" wire:model="newNotification.background"
                       placeholder="#aabbcc"
                       class="mt-1 block w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                       required>
                <p class="text-xs text-gray-500 mt-1">Hex color code for background (e.g., #ffcc00)</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Icon (URL or Name)</label>
                <input type="text" wire:model="newNotification.icon"
                       placeholder="URL or icon name"
                       class="mt-1 block w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <p class="text-xs text-gray-500 mt-1">Either a URL or predefined icon name</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Icon Color</label>
                <input type="text" wire:model="newNotification.iconColor"
                       placeholder="#aabbcc"
                       class="mt-1 block w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <p class="text-xs text-gray-500 mt-1">Hex color code for icon (e.g., #ff0000)</p>
            </div>
        </div>

        <!-- Language Tabs -->
        <div class="border-t pt-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Messages & Titles</h3>
            <div class="mb-4">
                <!-- Tabs for Language Selection -->
                <div class="flex space-x-4 border-b mb-4">
                    <button type="button" wire:click="$set('selectedLanguage', 'all')"
                            class="py-2 px-4 border-b-2 @if($selectedLanguage === 'all') border-blue-500 text-blue-500 font-semibold @else border-transparent text-gray-600 @endif focus:outline-none">
                        Semua Bahasa
                    </button>
                    @foreach (['in' => 'Indonesia', 'en' => 'English', 'es' => 'Spanish', 'hi' => 'Hindi', 'de' => 'German'] as $langCode => $langName)
                        <button type="button" wire:click="$set('selectedLanguage', '{{ $langCode }}')"
                                class="py-2 px-4 border-b-2 @if($selectedLanguage === $langCode) border-blue-500 text-blue-500 font-semibold @else border-transparent text-gray-600 @endif focus:outline-none">
                            {{ $langName }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Input Fields for Messages and Titles Based on Selected Language -->
            @if ($selectedLanguage === 'all')
                <!-- Display All Languages -->
                @foreach (['in' => 'Indonesia', 'en' => 'English', 'es' => 'Spanish', 'hi' => 'Hindi', 'de' => 'German'] as $langCode => $langName)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title ({{ $langName }})</label>
                        <input type="text" wire:model="newNotification.title.{{ $langCode }}.text"
                               placeholder="Enter title in {{ $langName }}"
                               class="mt-1 block w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                               required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Message ({{ $langName }})</label>
                        <textarea wire:model="newNotification.message.{{ $langCode }}.text"
                                  placeholder="Enter message in {{ $langName }}"
                                  class="mt-1 block w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                  required></textarea>
                    </div>
                @endforeach
            @else
                <!-- Display Only Selected Language -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Title ({{ $languages[$selectedLanguage] }})</label>
                    <input type="text" wire:model="newNotification.title.{{ $selectedLanguage }}.text"
                           placeholder="Enter title in {{ $languages[$selectedLanguage] }}"
                           class="mt-1 block w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                           required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Message ({{ $languages[$selectedLanguage] }})</label>
                    <textarea wire:model="newNotification.message.{{ $selectedLanguage }}.text"
                              placeholder="Enter message in {{ $languages[$selectedLanguage] }}"
                              class="mt-1 block w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                              required></textarea>
                </div>
            @endif
        </div>

        <!-- Section: Additional Options -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 border-t pt-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Show Until (optional)</label>
                <input type="date" wire:model="newNotification.showUntil"
                       class="mt-1 block w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <p class="text-xs text-gray-500 mt-1">Set a date to automatically hide the notification</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select wire:model="newNotification.type"
                        class="mt-1 block w-full px-4 py-2 border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <option value="all">All Users</option>
                    <option value="specific">Specific Users</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Define whether the notification is for all or specific users</p>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-8">
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:ring focus:ring-blue-200 transition">
                Save Notification
            </button>
        </div>
    </form>
</div>
