<main class="size-full">
    <div class="flex flex-col p-4 overflow-y-auto size-full">
        <div class="max-w-[500px] my-auto w-full mx-auto relative">
            <div
                class="backdrop-blur-sm relative z-10 p-8 border shadow-xl  bg-gradient-to-b from-blue-400/20 from-30% to-white/10 to-50%  rounded-lg">
                <div class="flex flex-col items-center gap-2 mb-2">
                    <x-pnri-logo class="size-20" />
                    <h1 class="text-2xl font-bold text-center font-inter">ICT EQUIPMENT INVENTORY</h1>
                </div>
                <form wire:submit.prevent="login">
                    <div class="mb-4">
                        <x-bladewind::input add_clearing="false" placeholder="Username"
                            class="border-2 rounded-lg border-zinc-900/20" prefix_is_icon="true" prefix="user"
                            prefix_icon_type="solid" wire:model.defer="username" />
                        @error('username') <small class="text-red-500">{{ $message }}</small> @enderror
                    </div>
                    <div class="mb-4">
                        <x-bladewind::input type="password" add_clearing="false" placeholder="Password" viewable="true"
                            class="border-2 rounded-lg border-zinc-900/20" prefix_is_icon="true" prefix="lock-closed"
                            prefix_icon_type="solid" wire:model.defer="password" />
                        @error('password') <small class="text-red-500">{{ $message }}</small> @enderror
                    </div>
                    <x-bladewind::button class="w-full" button_text_css="font-bold"
                        can_submit="true">LOGIN</x-bladewind::button>
                </form>
            </div>
        </div>
    </div>
</main>