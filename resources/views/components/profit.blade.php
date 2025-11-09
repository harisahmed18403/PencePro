@props(['profit', 'class' => ''])

@if($profit < 0)
    <span class="text-error {{ $class }}">&pound; {{ $profit }}</span>
@else
    <span class="text-success {{ $class }}">&pound; {{ $profit }}</span>
@endif