@props(['title', 'submitText' => null])
<div class="flex flex-col gap-4 h-full">
    <h1 class="text-2xl font-bold mb-2 text-center">{{ $title }}</h1>
    <div class="flex flex-col gap-4 h-full overflow-y-auto overflow-y:pb-30">
        {{ $slot }}

    </div>
    @if ($submitText)
        <div class="flex justify-end">
            <button type="submit" class="btn btn-success">{{ $submitText }}</button>
        </div>
    @endif
</div>