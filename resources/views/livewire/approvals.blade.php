<x-slot name="header">
    <h1 class="text-gray-900">CHANGES FOR APPROVE</h1>
</x-slot>



<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            @if (session()->has('message'))
                <div class="bg-teal-100 rounded-b text-teal-900 px-4 py-4 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <h4>{{ session('message') }}</h4>
                        </div>
                    </div>
                </div>
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-4 py-2 text-center w-min">#</th>
                        <th class="px-4 py-2">Table</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Requested Updates</th>
                        <th class="px-4 py-2">Original Values</th>
                        
                        <th class="px-4 py-2">User Requested</th>
                        {{-- @if ($user->can('approvals')) --}}
                            <th class="px-4 py-2">Actions</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($approvals as $approval)
                        <tr>
                            <td class="border text-center px-4 py-2 w-min">{{ $approval->id }}</td>
                            <td class="border px-4 py-2">{{ $approval->approvalable_type }}</td>
                            <td class="border px-4 py-2">{{ $approval->name }}</td>
                            <td class="border px-4 py-2">{{ json_encode($approval->new_data) }}</td>
                            <td class="border px-4 py-2">{{ json_encode($approval->original_data) }}</td>

                           
                            <td class="border px-4 py-2">{{ $approval->user_name }}</td>

                            <td class="border px-4 py-2 text-center">
                                @if ($user->can('approval'))
                                    <x-button wire:click="approve({{ $approval->id }})"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4">
                                        APPROVE
                                    </x-button>
                                    <x-button wire:click="reject({{ $approval->id }})"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4">
                                        REJECT
                                    </x-button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
