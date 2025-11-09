@props(['profit', 'class' => ''])

@if($profit < 0)
    <span class="text-error {{ $class }}">&pound; {{ number_format($profit, 1) }}</span>
@else
    <span class="text-success {{ $class }}">&pound; +{{ number_format($profit, 1) }}</span>
@endif