<div>
    <div class="col-span-1 md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
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
    </div>
</div>
