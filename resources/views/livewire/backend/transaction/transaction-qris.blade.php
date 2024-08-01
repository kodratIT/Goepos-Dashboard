<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Metode Pembayaran
        </h2>
    </x-slot>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">History Transactions QRIS</h2>
            <a  href="{{ route('widhdrawal.qris', ['id' => $ownerUid]) }}" class="bg-success-500 text-white px-4 py-2 rounded bg-blue-500">Penarikan Saldo</a>
        </div>
        <div class="grid grid-cols-1 md:flex md:gap-2">
            <div class="md:w-3/4">
                @livewire('backend.components.table-transactions', ['ownerUid' => $ownerUid])
            </div>
            <div class="md:w-1/3">
                @livewire('backend.components.sidebar-transactions', ['ownerUid' => $ownerUid])
            </div>
        </div>

    </div>
</div>
