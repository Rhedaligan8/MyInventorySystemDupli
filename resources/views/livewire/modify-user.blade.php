<div x-data="{ open: @entangle('isOpen') }">
    <div x-show="open" class="absolute inset-0 top-0 left-0 flex items-center justify-center bg-black/50">
        <div class="p-6 bg-white rounded-lg w-96">
            <h2 class="mb-4 text-xl font-bold">Edit User</h2>
            <form wire:submit.prevent="modifyUser">
                <div class="mb-2">
                    <label for="username">Username</label>
                    <input type="text" wire:model.defer="username" id="username" class="w-full px-2 py-1 border">
                    @error('username') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-2">
                    <label for="role">Role</label>
                    <select wire:model.defer="role" id="role" class="w-full px-2 py-1 border">
                        <option value="0">Staff</option>
                        <option value="1">Admin</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label for="status">Status</label>
                    <select wire:model.defer="status" id="status" class="w-full px-2 py-1 border">
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" wire:click="closeModal"
                        class="px-3 py-1 text-white bg-red-500 rounded">Close</button>
                    <button type="submit" class="px-3 py-1 text-white bg-blue-500 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>