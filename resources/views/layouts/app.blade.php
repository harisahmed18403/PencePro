<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full overflow-hidden" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    {{-- PWA Manifest --}}
    <link rel="manifest" href="{{ asset('pwa/manifest.json') }}">
</head>

<body class="flex flex-col w-full h-full bg-base-300 overflow-hidden">
    <x-nav-bar></x-nav-bar>

    <main class="flex-1 mx-auto md:my-2 w-full p-2 md:px-6 max-w-5xl overflow-hidden rounded-md">
        @yield('content')
    </main>

    {{-- Register service worker --}}
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('{{ asset("pwa/service-worker.js") }}')
                .then(reg => {
                    if (reg.waiting) {
                        reg.waiting.postMessage({ type: 'SKIP_WAITING' });
                    }
                    console.log('Service worker registered');
                })
                .catch(err => console.error('Service worker registration failed:', err));
        }
    </script>
</body>

</html>