<div class="navbar bg-base-100">
    <div class="flex justify-between mx-auto items-center gap-4 md:px-6 w-full max-w-5xl">
        <!-- Left: Main links -->
        <div class="navbar-start">
            <a href="{{ route('licks.index') }}"
                class="btn {{ request()->routeIs('home', 'licks.index') ? 'btn-active' : 'btn-ghost' }}">
                Home
            </a>

            <a href="{{ route('licks.stats') }}"
                class="btn {{ request()->routeIs('licks.stats') ? 'btn-active' : 'btn-ghost' }}">
                Stats
            </a>
        </div>

        <!-- Right: Brand / Hamburger -->
        <div class="flex items-center gap-2">
            <p class="text-xl font-medium text-end pr-2 hidden md:block">PencePro</p>

            <!-- Hamburger -->
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </label>
                <ul tabindex="0"
                    class="dropdown-content menu p-2 shadow bg-base-100 border border-base-200 rounded-box w-52">
                    <li><a href="{{ route('user.show') }}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left text-error">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>