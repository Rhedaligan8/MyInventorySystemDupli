<div class="size-full flex flex-col">
    <!-- loading element -->
    <div wire:loading class="absolute top-0 left-0 z-50 bg-zinc-900/30 size-full">
        <div class="flex items-center justify-center h-full">
            <x-bladewind::spinner size="omg" color="blue" />
        </div>
    </div>
    <!-- loading element -->
    <livewire:navbar />
    <main class="px-8 py-4 grow overflow-hidden">
        <div class="flex flex-col h-full gap-4 ">
            <div>
                <x-bladewind::button wire:click="backToDashboard()" icon="arrow-left" radius="full" outline="true"
                    button_text_css="font-bold" class="hover:bg-black">
                    Back to dashboard
                </x-bladewind::button>
            </div>
            <div class="bg-zinc-50 border-4 border-zinc-300 rounded-2xl grow p-8 overflow-y-auto flex flex-col gap-4">
                @if (is_null($name))
                    <div class="size-full flex items-center justify-center">
                        <x-bladewind::empty-state image="/images/no-data.svg"
                            message="User not found."></x-bladewind::empty-state>
                    </div>
                @else
                    <!-- personal information -->
                    <div class="border-2 border-zinc-300 p-4 rounded-lg ">
                        <h1 class="font-bold text-xl font-inter mb-4">User Information</h1>
                        <x-bladewind::alert show_close_icon="false" class="mb-4">
                            Username must be at least 8 characters long and cannot contain spaces.
                        </x-bladewind::alert>
                        <form wire:submit.prevent="updateUser">
                            <div class=" grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-2">
                                <div>
                                    <label for="name" class="font-bold text-zinc-500">Name</label>
                                    <x-bladewind::input wire:model.defer="name" id="name" size="small" />
                                </div>
                                <div>
                                    <label for="username" class="font-bold text-zinc-500">Username</label>
                                    <x-bladewind::input wire:model.defer="username" id="username" size="small" />
                                </div>
                                <div class="flex flex-col">
                                    <label for="role" class="font-bold text-zinc-500">Role</label>
                                    <select id="role" wire:model.defer="role"
                                        class="p-2 rounded-md text-sm border-2 border-zinc-200">
                                        <option value="admin">Admin</option>
                                        <option value="staff">Staff</option>
                                    </select>
                                </div>
                                <div class="flex flex-col">
                                    <label for="status" class="font-bold text-zinc-500">Status</label>
                                    <select id="status" wire:model.defer="status"
                                        class="p-2 rounded-md text-sm border-2 border-zinc-200">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="flex flex-col">
                                    <label for="created_at" class="font-bold text-zinc-500">Created At</label>
                                    <input id="created_at" wire:model.defer="created_at" disabled type="text"
                                        class="p-2 rounded-md text-sm border-2 border-zinc-200">
                                </div>
                                <div class="flex flex-col">
                                    <label for="updated_at" class="font-bold text-zinc-500">Updated At</label>
                                    <input id="updated_at" wire:model.defer="updated_at" disabled type="text"
                                        class="p-2 rounded-md text-sm border-2 border-zinc-200">
                                </div>
                                <div class="flex justify-end mt-4 col-span-full">
                                    <x-bladewind::button can_submit="true"
                                        button_text_css="font-bold">UPDATE</x-bladewind::button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- reset password -->
                    <div class="border-2 border-zinc-300 p-4 rounded-lg ">
                        <h1 class="font-bold text-xl font-inter mb-4">Reset password</h1>
                        <x-bladewind::alert show_close_icon="false" class="mb-4">
                            Reset password is "(username)-password"
                        </x-bladewind::alert>
                        <div>
                            <div>
                                <input id="password" disabled type="password" value="xxxxxxxxxxxxxxxxxxxxxxxxxxx"
                                    class="p-2 rounded-md text-sm border-2 border-zinc-200">
                                <x-bladewind::button wire:click="resetPassword"
                                    button_text_css="font-bold">RESET</x-bladewind::button>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <x-bladewind::button wire:click="goToUsersLogs()" icon="arrow-right" radius="full" outline="true"
                            button_text_css="font-bold" class="hover:bg-black" icon_right="true" color="red">
                            Check user logs
                        </x-bladewind::button>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>