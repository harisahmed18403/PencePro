@extends('layouts.html')
@section('body')
    <x-nav-bar></x-nav-bar>

    <main class="flex-1 mx-auto md:my-2 w-full p-2 md:px-6 max-w-5xl overflow-hidden rounded-md">
        @if($errors->any())
            <div class="alert alert-error mb-4">
                {{ $errors->first() }}
            </div>
        @endif
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
@endsection