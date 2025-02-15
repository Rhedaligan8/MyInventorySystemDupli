<x-app-layout>
    <!-- change the margin left of this main element based on the width of the sidebar -->
    <main :class="isSidebarOpen ? 'ml-80' : 'ml-0'"
        class="flex h-full transition-[margin] [@media(max-width:768px)]:!ml-0"
        x-data="{activeTab: 'users', isSidebarOpen: true}">
        @include("components/sidebar-close-state")
        <livewire:sidebar />
        <div class="flex flex-col w-full">
            <livewire:navbar />
            <div class="p-4 overflow-hidden grow">
                <livewire:users-tab />
            </div>
        </div>
    </main>
</x-app-layout>