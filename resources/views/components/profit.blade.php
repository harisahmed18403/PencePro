@props(['profit'])

@if($profit < 0)
    <span class="text-error">{{ $profit }}</span>
@else
    <span class="text-success">{{ $profit }}</span>
@endif