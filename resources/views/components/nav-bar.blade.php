<div class="navbar bg-base-100 shadow-sm justify-center">
    <div class="flex w-full max-w-5xl md:px-6">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl" href="{{ route('home') }}"><x-logo></x-logo></a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('licks.stats') }}">Stats</a></li>
                <li>
                    <details>
                        <summary>Profile</summary>
                        <ul class="bg-base-100 border border-base-200 rounded-t-none p-2 z-99">
                            <li><a a href="{{ route('user.show') }}">Edit</a></li>
                            <li class="w-full">
                                <form method="POST" action="{{ route('logout') }}" class="flex w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left text-error">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </details>
                </li>
            </ul>
        </div>
    </div>
</div>