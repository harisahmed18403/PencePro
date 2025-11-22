<div class="navbar justify-center bg-base-100 shadow-sm gap-2">
    <div class="flex items-center gap-4 w-full">
        <p class="text-xl font-medium">PencePro</p>

        <a href="{{ route('licks.index') }}" class="btn {{ request()->routeIs('home') ? '' : 'btn-ghost' }}">
            Home
        </a>

        <a href="{{ route('licks.stats') }}" class="btn {{ request()->routeIs('licks.stats') ? '' : 'btn-ghost' }}">
            Stats
        </a>
    </div>
</div>