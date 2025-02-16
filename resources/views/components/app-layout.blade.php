<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Equipment Inventory</title>
    @livewireStyles
</head>

<body class="w-screen h-screen overflow-hidden">
    {{ $slot }}
    <x-bladewind::notification />
    @livewireScripts
    <script>
        window.addEventListener('showNotification', function (event) {
            showNotification(event.detail.title,
                event.detail.message,
                event.detail.type,
                2,
                'regular');
        });


        window.addEventListener('scrollToTop', () => {
            document.querySelector('.table-container').scrollTo({ top: 0, behavior: 'auto' });
        });


        function showCustomModal(name) {
            document.getElementsByName(`custom-${name}-modal`)[0].classList.remove('hidden');
            document.getElementsByName(`custom-${name}-modal`)[0].classList.add('flex');
        }


        function hideCustomModal(name) {
            document.getElementsByName(`custom-${name}-modal`)[0].classList.remove('flex');
            document.getElementsByName(`custom-${name}-modal`)[0].classList.add('hidden');
        }
    </script>
</body>

</html>