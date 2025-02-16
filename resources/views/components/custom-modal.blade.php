@props(['modalName' => '', 'user_id' => ''])

<div class="absolute top-0 left-0 z-40 flex-col items-center hidden p-6 my-auto overflow-y-auto font-nunito bg-black/50 size-full"
    name="custom-{{ $modalName }}-modal">
    <div class="m-auto ">
        {{ $slot }}
    </div>
</div>