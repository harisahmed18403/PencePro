<div class="navbar bg-base-100 shadow-sm gap-2">
    <a href="{{ route('home') }}" class="btn {{ request()->routeIs('home') ? '' : 'btn-ghost' }} text-xl">
        PencePro
    </a>

    <a href="{{ route('licks.index') }}" class="btn {{ request()->routeIs('licks.index') ? '' : 'btn-ghost' }}">
        Licks
    </a>

    <a href="{{ route('licks.stats') }}" class="btn {{ request()->routeIs('licks.stats') ? '' : 'btn-ghost' }}">
        Stats
    </a>
</div>