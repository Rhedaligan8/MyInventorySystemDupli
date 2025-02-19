<div class="flex flex-col size-full">
    <!-- loading element -->
    <div wire:loading class="absolute top-0 left-0 z-50 bg-zinc-900/30 size-full">
        <div class="flex items-center justify-center h-full">
            <x-bladewind::spinner size="omg" color="blue" />
        </div>
    </div>
    <!-- loading element -->
    <livewire:navbar />
    <div class="flex flex-col px-8 py-4 overflow-hidden grow ">
        <div class="mb-4">
            <x-bladewind::button wire:click="backToDashboard()" icon="arrow-left" radius="full" outline="true"
                button_text_css="font-bold" class="hover:bg-black">
                Back to dashboard
            </x-bladewind::button>
        </div>

        <div class="flex flex-col items-center gap-8 p-8 overflow-y-auto rounded-lg shadow-md grow bg-zinc-50">
            <x-bladewind::alert show_close_icon="false">
                *Username must be at least 8 characters without any spaces.
                <br>
                *Default password is (username)-password
            </x-bladewind::alert>
            <form wire:submit.prevent="createUser" class="max-w-full w-96">
                <h1 class="mb-2 text-2xl font-bold text-center font-inter">Create New User</h1>
                <div class="flex flex-col gap-4">
                    <div>
                        <label for="username" class="font-bold text-zinc-500">Username</label>
                        <x-bladewind::input placeholder="Enter username" add_clearing="false"
                            wire:model.defer="username" id="username" size="small" />
                        @error('username') <small class="text-red-500">{{ $message }}</small> @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="role" class="font-bold text-zinc-500">Role</label>
                        <select id="role" wire:model.defer="role"
                            class="p-2 text-sm border-2 rounded-md border-zinc-200">
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="status" class="font-bold text-zinc-500">Status</label>
                        <select id="status" wire:model.defer="status"
                            class="p-2 text-sm border-2 rounded-md border-zinc-200">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <x-bladewind::button class="w-full" can_submit="true"
                        button_text_css="font-bold">Create</x-bladewind::button>
                </div>
            </form>
        </div>
    </div>
</div>