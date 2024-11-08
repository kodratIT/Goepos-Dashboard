<div class="max-w-4xl mx-auto mt-10 py-10 px-6 bg-gradient-to-br from-white to-gray-100 shadow-lg rounded-xl">
    <!-- Header with Back Button -->
    <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-200">
        <div class="flex items-center gap-2">
            <i class="fas fa-bell text-blue-600 text-2xl"></i>
            <h2 class="text-3xl font-bold text-gray-900">Create New Notification</h2>
        </div>
        <a href="{{ route('notifications') }}" wire:navigate.hover
            class="bg-gray-100 text-gray-700 flex items-center gap-2 px-4 py-2 rounded-lg shadow hover:bg-gray-200 hover:shadow-md transition-all duration-200">
            <i class="fas fa-arrow-left"></i>
            <span>Back to List</span>
        </a>
    </div>

    <form wire:submit.prevent="saveNotification">
        <!-- Notification Icon Styling Section -->
        <div class="border-b pb-6 mb-8">
            <!-- Heading and Description -->
            <h3 class="text-xl font-semibold text-gray-800 mb-2 flex items-center gap-2">
                <i class="fas fa-info-circle text-gray-600"></i> Style Icon Notification
            </h3>
            <p class="text-sm text-gray-500 mb-4">Easily customize the colors and style of your notification’s icon and
                background.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <!-- Background Color Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-palette text-gray-600"></i> Background Color
                    </label>
                    <div class="flex items-center gap-2 mt-1">
                        <input type="color" wire:model="newNotification.background"
                            class="h-10 w-10 cursor-pointer rounded-lg shadow-sm border border-gray-300 focus:ring-2 focus:ring-blue-200"
                            aria-label="Choose background color">
                        <input type="text" wire:model="newNotification.background" placeholder="#aabbcc"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-200"
                            aria-label="Enter hex color code for background">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Choose or enter a hex code (e.g., #ffcc00) for the
                        notification’s background.</p>
                </div>

                <!-- Icon Color Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-brush text-gray-600"></i> Icon Color
                    </label>
                    <div class="flex items-center gap-2 mt-1">
                        <input type="color" wire:model="newNotification.iconColor"
                            class="h-10 w-10 cursor-pointer rounded-lg shadow-sm border border-gray-300 focus:ring-2 focus:ring-blue-200"
                            aria-label="Choose icon color">
                        <input type="text" wire:model="newNotification.iconColor" placeholder="#aabbcc"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-200"
                            aria-label="Enter hex color code for icon">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Choose or enter a hex code (e.g., #ff0000) for the
                        notification icon color.</p>
                </div>
            </div>

            <!-- Icon URL or Name Selection -->
            <div class="mt-8">
                <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                    <i class="fas fa-image text-gray-600"></i> Icon (URL or Name)
                </label>
                <input type="text" wire:model="newNotification.icon" placeholder="URL or icon name"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none"
                    aria-label="Enter icon URL or name">
                <p class="text-xs text-gray-500 mt-1">Enter a URL or name of a predefined icon to display in the
                    notification.</p>
            </div>
        </div>

        <!-- Action Options Section -->
        <div class="border-b pb-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-2 flex items-center gap-2">
                <i class="fas fa-bolt text-gray-600"></i> Action Languages  (No Required)
            </h3>
            <p class="text-sm text-gray-500 mb-4">Customize the action </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

                <!-- Action Text -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-edit text-gray-600"></i> Action Text (Optional - in)
                    </label>
                    <input type="text" wire:model="actionText.in" placeholder="Enter action text (e.g., Learn More)"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                    <p class="text-xs text-gray-500 mt-1">Text that appears on the action button (Optional - in)</p>
                </div>
                <!-- Action Text -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-edit text-gray-600"></i> Action Text (Optional - en)
                    </label>
                    <input type="text" wire:model="actionText.en" placeholder="Enter action text (e.g., Learn More)"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                    <p class="text-xs text-gray-500 mt-1">Text that appears on the action button (Optional - en)</p>
                </div>
                <!-- Action Text -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-edit text-gray-600"></i> Action Text (Optional - es)
                    </label>
                    <input type="text" wire:model="actionText.es" placeholder="Enter action text (e.g., Learn More)"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                    <p class="text-xs text-gray-500 mt-1">Text that appears on the action button (Optional - es)</p>
                </div>
                <!-- Action Text -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-edit text-gray-600"></i> Action Text (Optional - hi)
                    </label>
                    <input type="text" wire:model="actionText.hi" placeholder="Enter action text (e.g., Learn More)"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                    <p class="text-xs text-gray-500 mt-1">Text that appears on the action button (Optional - hi)</p>
                </div>
                <!-- Action Text -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-edit text-gray-600"></i> Action Text (Optional - de)
                    </label>
                    <input type="text" wire:model="actionText.de" placeholder="Enter action text (e.g., Learn More)"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                    <p class="text-xs text-gray-500 mt-1">Text that appears on the action button (Optional - de)</p>
                </div>

            </div>
        </div>

        <div class="border-b pb-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-2 flex items-center gap-2">
                <i class="fas fa-bolt text-gray-600"></i> Action Setting (No Required)
            </h3>
            <p class="text-sm text-gray-500 mb-4">Customize the action </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">


                <!-- Action URL Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-link text-gray-600"></i> Action URL (optional)
                    </label>
                    <div class="relative mt-1">
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
                        <p class="text-xs text-gray-500 mt-1">Select an action that the button will link
                        </p>

                        <!-- Custom Icon for Dropdown -->
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>


                <!-- Action Text Style -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-font text-gray-600"></i> Action Text Style (optional)
                    </label>
                    <select wire:model="newNotification.actionTextStyle"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        <option value="">Select Action Text Style </option>
                        <option value="normal">Normal</option>
                        <option value="bold">Bold</option>
                        <option value="italic">Italic</option>
                        <option value="underline">Underline</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Choose the style of the action text</p>
                </div>

                <!-- Action Text Color -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fas fa-palette text-gray-600"></i> Action Text Color (optional)
                    </label>
                    <div class="flex items-center gap-2 mt-1">
                        <input type="color" wire:model="newNotification.actionTextColor"
                            class="h-10 w-10 cursor-pointer rounded-lg shadow-sm border border-gray-300 focus:ring focus:ring-blue-200">
                        <input type="text" wire:model="newNotification.actionTextColor" placeholder="#aabbcc"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Choose or enter hex color code for the action text color
                        (e.g., #ff0000)</p>
                </div>

            </div>
        </div>


        <!-- Error Message Display -->
        @if ($errorMessage)
            <div class="mb-4 text-red-600 font-semibold">
                {{ $errorMessage }}
            </div>
        @endif

        <!-- Messages & Titles Section -->
        <div class="border-b pb-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-2 flex items-center gap-2">
                <i class="fas fa-language text-gray-600"></i> Messages & Titles
            </h3>
            <p class="text-sm text-gray-500 mb-4">Add and translate notification titles and messages for multiple
                languages.</p>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Title (Indonesian)</label>
                <input type="text" wire:model="newNotification.title.in.text"
                    placeholder="Enter title in Indonesian"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Message (Indonesian)</label>
                <textarea wire:model="newNotification.message.in.text" placeholder="Enter message in Indonesian"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none"></textarea>
            </div>

            <!-- Button to Trigger Translation with Loading Spinner -->
            <div class="flex justify-end mb-6">
                <button type="button" wire:click="translate" wire:loading.attr="disabled"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center transition duration-200">
                    <!-- SVG Loading Spinner -->
                    <svg aria-hidden="true" role="status" wire:loading wire:target="translate"
                        class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="#E5E7EB" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentColor" />
                    </svg>
                    <span wire:loading.remove wire:target="translate">
                        <i class="fas fa-language"></i> Translate
                    </span>
                    <span wire:loading wire:target="translate">
                        Transalting...
                    </span>
                </button>
            </div>


            <!-- Auto-Translated Fields for Other Languages -->
            @foreach (['en' => 'English', 'es' => 'Spanish', 'hi' => 'Hindi', 'de' => 'German'] as $langCode => $langName)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Title ({{ $langName }})</label>
                    <input type="text" wire:model="newNotification.title.{{ $langCode }}.text"
                        placeholder="Translated title in {{ $langName }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Message ({{ $langName }})</label>
                    <textarea wire:model="newNotification.message.{{ $langCode }}.text"
                        placeholder="Translated message in {{ $langName }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none"></textarea>
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
                        <p class="text-xs text-gray-500 mt-1">Define whether the notification is for all or specific
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
                                <p class="text-xs text-gray-500 mt-1">Choose to target users by subscription or specify
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
                                            <button type="button" wire:click="removeOwnerUid({{ $index }})"
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
            <button type="submit" wire:click="saveNotification" wire:loading.attr="disabled"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center transition duration-200">

                <!-- SVG Loading Spinner -->
                <svg aria-hidden="true" role="status" wire:loading wire:target="saveNotification"
                    class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor" />
                </svg>

                <!-- Button Text -->
                <span wire:loading.remove wire:target="saveNotification">
                    <i class="fas fa-save"></i> Save Notification
                </span>
                <span wire:loading wire:target="saveNotification">
                    Saving...
                </span>
            </button>
        </div>


</div>
</form>
</div>
