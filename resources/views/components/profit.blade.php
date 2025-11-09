@props(['profit'])

@if($profit < 0)
    <span class="text-error">&pound; {{ $profit }}</span>
@else
    <span class="text-success">&pound; {{ $profit }}</span>
@endif