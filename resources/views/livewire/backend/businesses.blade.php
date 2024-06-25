<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data from Firebase
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Add New Document</h3>
                    <form wire:submit.prevent="addDocument">
                        <div class="flex items-center">
                            <input type="text" wire:model="newDocument.name" placeholder="Enter Name" class="border border-gray-300 rounded-md shadow-sm p-2 mr-4 w-full">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                Add
                            </button>
                        </div>
                        @error('newDocument.name') <span class="text-red-500">{{ $message }}</span> @enderror
                    </form>
                </div>
            </div>
        </div> --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="pb-4 bg-white dark:bg-gray-900">
                        <div class="flex items-center relative mb-1">
                            <input type="text" wire:model.debounce.300ms="searchTerm" id="table-search" class="w-full block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-1/3 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for businesses by email">

                            <button wire:click="searchDocuments" class="flex items-center p-2 bg-black text-white rounded-r-lg center">
                                <svg class="w-5 h-5 text-white" aria-hidden="true" fill="black" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-2">Search</span>
                            </button>

                        </div>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table id="documentsTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        CreatedAt
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        UpdateAt
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (count($documents) > 0)
                                    @foreach ($documents as $document)

                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox-table-search-{{ $loop->iteration }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $document->name ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $document->email ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $document->createdAt ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $document->updatedAt ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <a href="{{ route('businesses.detail', ['id' => $document->ownerUid]) }}" wire:navigate class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            Data tidak ditemukan
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
