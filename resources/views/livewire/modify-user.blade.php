<div x-data="{ open: @entangle('isOpen'), password:  @entangle('password').defer }">
    <div x-show="open" x-cloak
        class="absolute inset-0 top-0 left-0 z-40 flex items-start justify-center p-4 overflow-y-auto bg-black/50 size-full">
        <div class="p-6 rounded-lg bg-zinc-50 w-96">
            <h2 class="mb-4 text-xl font-bold text-center">Edit User</h2>
            <form wire:submit.prevent="modifyUser">
                <div class="mb-2">
                    <label for="username">Username</label>
                    <x-bladewind::input add_clearing="false" wire:model.defer="username" id="username" />
                    @error('username') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2">
                    <label for="role">Role</label>
                    <select wire:model.defer="role" id="role"
                        class="w-full px-4 py-2 text-sm border-2 rounded-md border-zinc-200">
                        <option value="0">Staff</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="status">Status</label>
                    <select wire:model.defer="status" id="status"
                        class="w-full px-4 py-2 text-sm border-2 rounded-md border-zinc-200">
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                </div>
                <x-bladewind::alert show_close_icon="false">
                    Password reset is (username)-password
                </x-bladewind::alert>
                <div class="mb-2">
                    <label for="password">Password</label>
                    <div class="flex gap-2">
                        <x-bladewind::input x-model="password" class="grow" add_clearing="false"
                            wire:model.defer="password" id="password" placeholder="xxxxxxxxxxxxxxxxxxxxxxxx" />
                        <x-bladewind::button x-show="password == ''" size="tiny" wire:click="resetPassword()"
                            button_text_css="font-bold" size="small">Reset
                        </x-bladewind::button>
                        <x-bladewind::button x-show="password != ''" wire:click="changePassword()" button_text_css="
                            font-bold" size="small">Change
                        </x-bladewind::button>
                    </div>
                    @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="h-1 my-4 bg-zinc-300"></div>
                <div class="flex gap-2 mt-2">
                    <x-bladewind::button class="w-full" wire:click="deleteUser" color="red" outline="true"
                        button_text_css="font-bold" size="small">Delete
                    </x-bladewind::button>
                    <x-bladewind::button class="w-full" can_submit="true" button_text_css="font-bold"
                        size="small">Update
                    </x-bladewind::button>
                </div>
                <x-bladewind::button x-on:click="open = false" wire:click="closeModal" class="w-full mt-2" color="red"
                    button_text_css="font-bold" size="small">Close
                </x-bladewind::button>
            </form>
        </div>s
    </div>
</div>