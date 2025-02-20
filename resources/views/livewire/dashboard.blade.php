<x-app-layout>
    <!-- change the margin left of this main element based on the width of the sidebar -->
    <main :class="isSidebarOpen ? 'ml-80' : 'ml-0'"
        class="flex h-full [@media(max-width:940px)]:!ml-0 overflow-y-hidden"
        x-data="{activeTab: 'users', isSidebarOpen: true}">
        <x-sidebar-close-state />
        <livewire:sidebar />
        <div class="flex flex-col w-full h-full min-w-[940px]">
            <livewire:navbar />
            <div class="p-4 overflow-hidden grow">
                <div class="h-full border-4 rounded-lg bg-zinc-50 border-zinc-300">
                    <!-- panels -->
                    <!-- users -->
                    <div class="size-full" x-show="activeTab == 'equipment'">
                        <livewire:equipment-tab />
                    </div>
                    <!-- users -->
                    <!-- users -->
                    <div class="size-full" x-show="activeTab == 'equipment_types'">
                        <livewire:equipment-type-tab />
                    </div>
                    <!-- users -->
                    <!-- users -->
                        <livewire:users-tab />
                    </div>
                    <div class="size-full" x-show="activeTab == 'users'">
                    <!-- users -->
                    <!-- panels end -->
                </div>
            </div>
        </div>
    </main>
    <livewire:modify-user />
    </x-app-layout>