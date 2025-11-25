@props(['title'])
<div class="flex flex-col gap-4">
    <h1 class="text-2xl font-bold mb-2 text-center">{{ $title }}</h1>
    <div class="flex flex-col gap-4">
        {{ $slot }}
    </div>
</div>