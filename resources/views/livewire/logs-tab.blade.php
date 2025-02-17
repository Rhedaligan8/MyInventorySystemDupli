<div class="flex flex-col h-full gap-4 p-8">
    <!-- loading element -->
    <div wire:loading class="absolute top-0 left-0 z-50 bg-zinc-900/30 size-full">
        <div class="flex items-center justify-center h-full">
            <x-bladewind::spinner size="omg" color="blue" />
        </div>
    </div>
    <!-- loading element -->
    <!-- Search -->
    <div class="flex items-center gap-4">
        <form wire:submit.prevent="searchFilter" class="grow">
            <x-bladewind::input focused placeholder="Search..." wire:model.defer="searchString" add_clearing="false"
                size="regular" />
        </form>
        <select class="px-4 py-1 rounded-md w-44 min-w-32" wire:model="searchBy">
            <option value="description">Description</option>
            <option value="created_at">Created At</option>
            <option value="name">Name</option>
        </select>
        <x-bladewind::button button_text_css="font-bold" size="small"
            wire:click="clearSearchString()">Refresh</x-bladewind::button>
    </div>
    <!-- Search -->
    <!-- table -->
    <div class="mb-2 overflow-auto font-jetbrains grow table-container">
        <x-bladewind::table has_border="true" divider="thin">
            <x-slot name="header">
                <th>
                    <div>#</div>
                </th>
                <th>
                    <div @class([
                        'text-blue-500 font-bold' => $orderByString == 'name'
                    ])>NAME
                    </div>
                </th>
                <th>
                    <div @class([
                        'text-blue-500 font-bold' => $orderByString == 'description'
                    ])>DESCRIPTION
                    </div>
                </th>
                <th>
                    <div @class([
                        'text-blue-500 font-bold' => $orderByString == 'created_at'
                    ])>CREATED AT
                    </div>
                </th>
                <th></th>
            </x-slot>
            @foreach ($logs as $log)
                <tr>
                    <td>{{$loop->index + 1 + (($logs->currentPage() - 1) * $itemPerPage)}} </td>
                    <td>{{$log->user->name}}</td>
                    <td>{{$log->description}}</td>
                    <td>{{$log->created_at}}</td>
                    <td>
                        <button wire:click="goToUserLogs($log->username)">
                            <x-bladewind::icon name="clipboard" type="solid" class="text-blue-500 hover:text-blue-600" />
                        </button>
                    </td>
                </tr>
            @endforeach
        </x-bladewind::table>
        <!-- no data message -->
        @if (!count($logs))
            <div class="mt-4">
                <x-bladewind::empty-state image="/images/no-data.svg" message="No data found."></x-bladewind::empty-state>
            </div>
        @endif
        <!-- no data message -->
    </div>
    <!-- table -->
    <!-- links page -->
    <div>
        {{ $logs->onEachSide(1)->links() }}
        <div class="flex items-center gap-2 mt-4 text-sm">
            <p class="">Page: <span class="font-bold">{{ $logs->currentPage() }}</span></p>
            <p>Total logs: <span class="font-bold">{{ $totalLogs }}</span></p>
            <!-- items per page -->
            <div>
                Items per page:
                <select class="w-16 px-2" wire:model="itemPerPage">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                    <option value="35">35</option>
                    <option value="40">40</option>
                    <option value="45">45</option>
                    <option value="50">50</option>
                </select>
            </div>
            <!-- items per page -->
            <!-- sort by -->
            <div>
                Sort by:
                <select class="px-2 w-28" wire:model="orderByString">
                    <option value="created_at">Created At</option>
                    <option value="description">Description</option>
                    <option value="name">Name</option>
                </select>
            </div>
            <!-- sort by -->
            <!-- sort order -->
            <div>
                Sort order:
                <select class="px-2 w-28" wire:model="orderBySort">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
            <!-- sort order -->
        </div>
    </div>
    <!-- links page -->
</div>