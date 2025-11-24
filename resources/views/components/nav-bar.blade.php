<div class="navbar justify-center bg-base-100 shadow-sm">
    <div class="flex justify-between items-center gap-4 md:px-6 w-full max-w-5xl">
        <div class="flex gap-4">
            <a href="{{ route('licks.index') }}"
                class="btn {{ request()->routeIs('home', 'licks.index') ? 'btn-active' : 'btn-ghost' }}">
                Home
            </a>

            <a href="{{ route('licks.stats') }}"
                class="btn {{ request()->routeIs('licks.stats') ? 'btn-active' : 'btn-ghost' }}">
                Stats
            </a>
        </div>

        <p class="md:text-xl font-medium text-end">PencePro</p>
    </div>
</div>