@props(['title'])
<div class="flex flex-col gap-4">
    <p class="text-2xl font-semibold">{{ $title }}</p>
    <div class="flex flex-col gap-4">
        {{ $slot }}
    </div>
</div>