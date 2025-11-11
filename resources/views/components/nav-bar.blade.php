<div class="navbar justify-center bg-base-100 shadow-sm gap-2">
    <div class="w-full max-w-5xl">
        <a href="{{ route('licks.index') }}" class="btn {{ request()->routeIs('home') ? '' : 'btn-ghost' }} text-xl">
            PencePro
        </a>

        <a href="{{ route('licks.stats') }}" class="btn {{ request()->routeIs('licks.stats') ? '' : 'btn-ghost' }}">
            Stats
        </a>
    </div>
</div>