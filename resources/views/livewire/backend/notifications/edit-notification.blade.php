<div x-data="{
    isLivePreviewEnabled: false,
    newNotification: @entangle('newNotification').defer,
    topPosition: '70px',
}" x-init="

      window.addEventListener('showPreview', event => {
        if (event.detail) {
            newNotification = event.detail.newNotification;
        }
    });

    // Inisialisasi awal jika event belum ada
    if (!newNotification || Object.keys(newNotification).length === 0) {
        newNotification = @js($newNotification);
    }
    setInterval(() => {
        if (isLivePreviewEnabled) {
            $refs.generateButton.click();
        }
    }, 1000);

window.addEventListener('scroll', () => {
    topPosition = window.scrollY > 0 ? '-50px' : '70px'; // Sesuaikan jarak saat di-scroll

});">
    <div class="max-w-4xl mx-auto mt-10 py-10 px-6 bg-gradient-to-br from-white to-gray-100 shadow-lg rounded-xl"
        x-bind:style="`
                        background-color: ${newNotification?.background || '#555555'};
                        position: ${isLivePreviewEnabled ? 'fixed' : 'static'};
                        top: ${isLivePreviewEnabled ? topPosition : 'auto'};
                        left: ${isLivePreviewEnabled ? '50%' : 'auto'};
                        transform: ${isLivePreviewEnabled ? 'translateX(-50%)' : 'none'};
                        width: ${isLivePreviewEnabled ? '1000px' : 'auto'};
                        z-index: ${isLivePreviewEnabled ? '50' : 'auto'};
                    `">
        <div class="flex items-center justify-end mb-4">
            <label for="livePreviewToggle" class="mr-2 text-gray-600 font-semibold">Aktifkan Live Preview</label>
            <button
                @click="isLivePreviewEnabled = !isLivePreviewEnabled; console.log('Live Preview toggled:', isLivePreviewEnabled)"
                :class="{ 'bg-blue-600': isLivePreviewEnabled, 'bg-gray-300': !isLivePreviewEnabled }"
                class="relative inline-flex items-center h-6 rounded-full w-11 transition duration-300">
                <span class="sr-only">Toggle Live Preview</span>
                <span :class="{ 'translate-x-6': isLivePreviewEnabled, 'translate-x-1': !isLivePreviewEnabled }"
                    class="inline-block w-4 h-4 transform bg-white rounded-full transition duration-300"></span>
            </button>
        </div>

        <!-- Pratinjau Notifikasi Langsung -->
        <div id="notification-preview" x-show="isLivePreviewEnabled" x-cloak
            class="mt-10 p-4 rounded-lg shadow-md transition duration-300 ease-in-out"
            x-bind:style="`
                                     background-color: ${newNotification?.background || '#ffffff'};
                                     top: ${isLivePreviewEnabled ? topPosition : 'auto'};
                                     left: ${isLivePreviewEnabled ? '50%' : 'auto'};
                                     width: ${isLivePreviewEnabled ? '100%' : 'auto'};
                                     z-index: ${isLivePreviewEnabled ? '50' : 'auto'};
                                 `">
            <div class="flex items-center">
                <div id="notification-icon" class="w-12 h-12 rounded-full flex items-center justify-center mr-4 shadow"
                    x-bind:style="`background-color: ${newNotification?.backgroundIconColor || '#000000'};`">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"
                        x-bind:style="`color: ${newNotification?.iconColor || '#000000'};`">
                        <path
                            d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm1 17h-2v-2h2v2zm0-4h-2V7h2v8z" />
                    </svg>
                </div>
                <div>
                    <h4 id="notification-title" class="text-lg font-bold"
                        x-bind:style="`color: ${newNotification?.titleColor || '#000000'};`">
                        <span x-text="newNotification?.liveTitle || 'Judul Notifikasi'"></span>
                    </h4>
                    <p id="notification-message" class="text-sm"
                        x-bind:style="`color: ${newNotification?.messageColor || '#000000'};`">
                        <span x-text="newNotification?.liveMessage || 'Pesan Notifikasi'"></span>
                    </p>
                    <a id="notification-action" href="#" class="underline"
                        x-bind:style="`
                            color: ${newNotification?.actionTextColor || '#000000'};
                            font-weight: ${newNotification?.actionTextStyle === 'bold' ? 'bold' : 'normal'};
                            font-style: ${newNotification?.actionTextStyle === 'italic' ? 'italic' : 'normal'};
                            text-decoration: ${newNotification?.actionTextStyle === 'underline' ? 'underline' : 'none'};
                        `">
                        <span x-text="newNotification?.actionText || 'Teks Aksi'"></span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tombol Generate Desain (disembunyikan tetapi tetap bekerja) -->
        <div class="flex justify-center mt-6" x-show="false">
            <button x-ref="generateButton" @click.prevent="$wire.generatePreview()"
                class="flex items-center gap-2 bg-gradient-to-br from-white to-gray-100 shadow-lg font-semibold px-6 py-3 rounded-full shadow-lg hover:bg-blue-700 transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 focus:ring-offset-white">
            </button>
        </div>
    </div>
    <div class="max-w-4xl mx-auto mt-10 py-10 px-6 bg-gradient-to-br from-white to-gray-100 shadow-lg rounded-xl mt-100"
        x-bind:style="`
                            top: ${isLivePreviewEnabled ? '100px' : 'auto'};
                            margin-top: ${isLivePreviewEnabled ? '320px' : '20px'};
                        `">


        <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-200">
            <h2 class="text-3xl font-bold text-gray-900">Edit Notification</h2>
            <a href="{{ route('notifications') }}" wire:navigate.hover
                class="bg-gray-100 text-gray-700 flex items-center gap-2 px-4 py-2 rounded-lg shadow hover:bg-gray-200 hover:shadow-md transition-all duration-200">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>

        <!-- Form -->
        <form wire:submit.prevent="updateNotification">
            <!-- Notification Icon Styling Section -->
            <div class="border-b pb-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Style Icon Notification</h3>
                <p class="text-sm text-gray-500 mb-4">Customize the colors and style of your notification’s icon and
                    background.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Background Color Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Background Color</label>
                        <div class="flex items-center gap-2 mt-1">
                            <input type="color" wire:model="newNotification.background"
                                class="h-10 w-10 cursor-pointer rounded-lg shadow-sm border border-gray-300">
                            <input type="text" wire:model="newNotification.background" placeholder="#aabbcc"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-200">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Enter a hex code (e.g., #ffcc00) for the background color.
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Background Icon Color</label>
                        <div class="flex items-center gap-2 mt-1">
                            <input type="color" wire:model="newNotification.backgroundIconColor"
                                class="h-10 w-10 cursor-pointer rounded-lg shadow-sm border border-gray-300">
                            <input type="text" wire:model="newNotification.backgroundIconColor" placeholder="#aabbcc"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-200">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Enter a hex code (e.g., #ffcc00) for the background color.
                        </p>
                    </div>

                    <!-- Icon Color Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Icon Color</label>
                        <div class="flex items-center gap-2 mt-1">
                            <input type="color" wire:model="newNotification.iconColor"
                                class="h-10 w-10 cursor-pointer rounded-lg shadow-sm border border-gray-300">
                            <input type="text" wire:model="newNotification.iconColor" placeholder="#aabbcc"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-200">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Enter a hex code (e.g., #ff0000) for the icon color.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Icon (URL or Name)</label>
                        <input type="text" wire:model="newNotification.icon" placeholder="URL or icon name"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm">
                        <p class="text-xs text-gray-500 mt-1">Enter a URL or name of a predefined icon to display in the
                            notification.</p>
                    </div>
                </div>

                <!-- Icon URL or Name Selection -->
            </div>

            <!-- Action Options Section -->
            <div class="border-b pb-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-2 flex items-center gap-2">
                    <i class="fas fa-bolt text-gray-600"></i> Action Languages (No Required)
                </h3>
                <p class="text-sm text-gray-500 mb-4">Customize the action </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

                    <!-- Action Text -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                            <i class="fas fa-edit text-gray-600"></i> Action Text (Optional - in)
                        </label>
                        <input type="text" wire:model="actionText.in"
                            placeholder="Enter action text (e.g., Learn More)"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Text that appears on the action button (Optional - in)</p>
                    </div>
                    <!-- Action Text -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                            <i class="fas fa-edit text-gray-600"></i> Action Text (Optional - en)
                        </label>
                        <input type="text" wire:model="actionText.en"
                            placeholder="Enter action text (e.g., Learn More)"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Text that appears on the action button (Optional - en)
                        </p>
                    </div>
                    <!-- Action Text -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                            <i class="fas fa-edit text-gray-600"></i> Action Text (Optional - es)
                        </label>
                        <input type="text" wire:model="actionText.es"
                            placeholder="Enter action text (e.g., Learn More)"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Text that appears on the action button (Optional - es)
                        </p>
                    </div>
                    <!-- Action Text -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                            <i class="fas fa-edit text-gray-600"></i> Action Text (Optional - hi)
                        </label>
                        <input type="text" wire:model="actionText.hi"
                            placeholder="Enter action text (e.g., Learn More)"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Text that appears on the action button (Optional - hi)
                        </p>
                    </div>
                    <!-- Action Text -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                            <i class="fas fa-edit text-gray-600"></i> Action Text (Optional - de)
                        </label>
                        <input type="text" wire:model="actionText.de"
                            placeholder="Enter action text (e.g., Learn More)"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Text that appears on the action button (Optional - de)
                        </p>
                    </div>

                </div>
            </div>


            <!-- Action Options Section -->
            <div class="border-b pb-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Action Setting (No Required)</h3>
                <p class="text-sm text-gray-500 mb-4">Customize the action button with text, URL, style, and color.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Action URL Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Action URL (optional)</label>
                        <select wire:model="newNotification.action"
                            class="block w-full appearance-none bg-white border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300 text-gray-700">
                            <option value="" disabled selected>Select an action</option>
                            <optgroup label="External Links">
                                <option value="https://wa.com/text=ijin bertanya pak">💬 WhatsApp: Open in WhatsApp if
                                    installed</option>
                                <option value="https://goepos.id">🌐 GoEpos: Open in browser</option>
                            </optgroup>
                            <optgroup label="Product Management">
                                <option value="manage_product">📦 Manage Products: Open product and discount list
                                </option>
                                <option value="add_product">➕ Add Product: Open add product page</option>
                                <option value="add_discount">🏷️ Add Discount: Open add discount page</option>
                            </optgroup>
                            <optgroup label="Settings">
                                <option value="payment_method_setting">💳 Payment Method: Open payment method settings
                                </option>
                                <option value="subscription">🔔 Subscription: Open subscription page</option>
                                <option value="tax">💰 Tax Settings: Open tax settings</option>
                                <option value="setting_printer">🖨️ Printer Settings: Open printer settings</option>
                                <option value="service_charge">💼 Service Charge: Open service charge settings</option>
                            </optgroup>
                            <optgroup label="Customer & Order Management">
                                <option value="cash_drawer">💵 Cash Drawer: Open cash drawer page</option>
                                <option value="customer_display">📺 Customer Display: Open customer display settings
                                </option>
                                <option value="receipt_promo_setting">📜 Receipt Promo: Open promo info for receipt
                                </option>
                                <option value="channel_list">📋 Channel List: Open order type list</option>
                            </optgroup>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Select an action that the button will link to.</p>
                    </div>

                    <!-- Action Text Style -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Action Text Style (optional)</label>
                        <select wire:model="newNotification.actionTextStyle"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm">
                            <option value="">Select Action Text Style</option>
                            <option value="normal">Normal</option>
                            <option value="bold">Bold</option>
                            <option value="italic">Italic</option>
                        </select>
                    </div>

                    <!-- Action Text Color -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Action Text Color (optional)</label>
                        <div class="flex items-center gap-2 mt-1">
                            <input type="color" wire:model="newNotification.actionTextColor"
                                class="h-10 w-10 cursor-pointer rounded-lg shadow-sm border border-gray-300">
                            <input type="text" wire:model="newNotification.actionTextColor" placeholder="#aabbcc"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages & Titles Section -->
            <div class="border-b pb-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Messages & Titles</h3>
                <p class="text-sm text-gray-500 mb-4">Add and translate notification titles and messages for multiple
                    languages.</p>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Title (Indonesian)</label>
                    <input type="text" wire:model="newNotification.liveTitle" placeholder="Enter title in Indonesian"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Message (Indonesian)</label>
                    <textarea wire:model="newNotification.liveMessage" placeholder="Enter message in Indonesian"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm"></textarea>
                </div>

                {{-- <!-- Button to Trigger Translation -->
                <div class="flex justify-end mb-6">
                    <button type="button" wire:click="translate"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center transition duration-200">
                        <i class="fas fa-language"></i> Translate
                    </button>
                </div> --}}

                <!-- Auto-Translated Fields for Other Languages -->
                @foreach (['en' => 'English', 'es' => 'Spanish', 'hi' => 'Hindi', 'de' => 'German'] as $langCode => $langName)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Title ({{ $langName }})</label>
                        <input type="text" wire:model="title.{{ $langCode }}"
                            placeholder="Translated title in {{ $langName }}"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Message ({{ $langName }})</label>
                        <textarea wire:model="message.{{ $langCode }}" placeholder="Translated message in {{ $langName }}"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm"></textarea>
                    </div>
                @endforeach
            </div>

                        <!-- Action Options Section -->
                        <div class="border-b pb-6 mb-8">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2 flex items-center gap-2">
                                <i class="fas fa-bolt text-gray-600"></i> Style Message
                            </h3>
                            <p class="text-sm text-gray-500 mb-4">Customize the action button with text, URL, style, and color.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

                                {{-- Message Color --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                                        <i class="fas fa-palette text-gray-600"></i> Message Color
                                    </label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <input type="color" wire:model="newNotification.messageColor"
                                            class="h-10 w-10 cursor-pointer rounded-lg shadow-sm border border-gray-300 focus:ring focus:ring-blue-200">
                                        <input type="text" wire:model="newNotification.messageColor" placeholder="#aabbcc"
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Choose or enter hex color code for the Message color
                                        (e.g., #ff0000)</p>
                                </div>


                                {{-- Title Color --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                                        <i class="fas fa-palette text-gray-600"></i> Title Color
                                    </label>
                                    <div class="flex items-center gap-2 mt-1">
                                        <input type="color" wire:model="newNotification.titleColor"
                                            class="h-10 w-10 cursor-pointer rounded-lg shadow-sm border border-gray-300 focus:ring focus:ring-blue-200">
                                        <input type="text" wire:model="newNotification.titleColor" placeholder="#aabbcc"
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Choose or enter hex color code for the Title color
                                        (e.g., #ff0000)</p>
                                </div>
                            </div>
                        </div>

            <div class="border-b pb-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-2 flex items-center gap-2">
                    <i class="fas fa-cogs text-gray-600"></i> Setting Notification
                </h3>
                <p class="text-sm text-gray-500 mb-4">Define when and who will receive the notification.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- Show Until Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-gray-600"></i> Show Until (optional)
                        </label>
                        <input type="date" wire:model="newNotification.showUntil"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Set a date to automatically hide the notification</p>
                    </div>

                    <!-- Notification Type Selection -->
                    <div class="border-b pb-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                                <i class="fas fa-users text-gray-600"></i> Type
                            </label>
                            <select wire:model.lazy="type"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                                <option value="all">All Users</option>
                                <option value="specific">Specific Users</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Define whether the notification is for all or
                                specific
                                users</p>

                            @if ($type === 'specific')
                                <!-- Specify Target Dropdown -->
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700">Specify Target</label>
                                    <select wire:model.lazy="specificTarget"
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                                        <option value="" disabled>Select target group</option>
                                        <option value="subscription">User Subscriptions</option>
                                        <option value="user_only">User Only</option>
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">Choose to target users by subscription or
                                        specify
                                        individual users</p>
                                </div>
                            @endif

                            <!-- Owner UID Input List for User Only -->
                            @if ($specificTarget === 'user_only')
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700">Owner UID(s)</label>
                                    <div class="space-y-2">
                                        <!-- Loop over the Owner UIDs with a delete button for each -->
                                        @foreach ($ownerUids as $index => $uid)
                                            <div class="flex items-center gap-2">
                                                <input type="text" wire:model.lazy="ownerUids.{{ $index }}"
                                                    placeholder="Enter Owner UID"
                                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                                                <button type="button"
                                                    wire:click="removeOwnerUid({{ $index }})"
                                                    class="text-red-500 hover:text-red-700 focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>

                                            </div>
                                        @endforeach

                                        <!-- Button to add new Owner UID -->
                                        <button type="button" wire:click="addOwnerUid"
                                            class="mt-2 flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 focus:ring-2 focus:ring-green-300">
                                            <i class="fas fa-plus"></i> Add Owner UID
                                        </button>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Add one or more Owner UIDs to target specific
                                        users.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


            </div>



            <!-- Submit Button -->
            <div class="flex justify-end mt-8">
                <button type="submit" wire:loading.attr="disabled"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center transition duration-200">
                    <span wire:loading.remove wire:target="updateNotification">
                        <i class="fas fa-save"></i> Update Notification
                    </span>
                    <span wire:loading wire:target="updateNotification">Saving...</span>
                </button>
            </div>
        </form>
    </div>
