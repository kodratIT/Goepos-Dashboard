<div>
    <div class="space-y-4">
        <div class="bg-white shadow-md rounded-lg p-4 mb-5">
            <h3 class="text-lg font-bold">Saldo (completed)</h3>
            <p class="text-2xl font-bold">@if(property_exists($transactionsDetail, 'net_qris_amount')) Rp.{{ $transactionsDetail->net_qris_amount }} @else - @endif</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 mb-5">
            <h3 class="text-lg font-bold">Saldo Settlement</h3>
            <p class="text-2xl font-bold">@if(property_exists($transactionsDetail, 'settlement_qris_amount')) Rp.{{ $transactionsDetail->settlement_qris_amount }} @else - @endif</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 mb-5">
            <h3 class="text-lg font-bold">Sedang diproses (pending)</h3>
            <p class="text-2xl font-bold">@if(property_exists($transactionsDetail, 'pending_qris_amount')) Rp.{{ $transactionsDetail->pending_qris_amount }} @else - @endif</p>
        </div>
        @livewire('backend.components.user-details', ['ownerUid' => $transactionsDetail->ownerUid])
    </div>
</div>
