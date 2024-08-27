<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Businesses
        </h2>
    </x-slot>
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
           <div class="col-span-1">
              @livewire('backend.components.user-details', ['ownerUid' => $data])
           </div>
           <div class="col-span-2">
              @livewire('backend.components.staff-details', ['ownerUid' => $data])
           </div>
        </div>
     </div>
</div>
