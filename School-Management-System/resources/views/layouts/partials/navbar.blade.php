<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">

    <span class="ml-3">Dashboard</span>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">

            <a class="nav-link dropdown-toggle"
            href="{{ route('profile.index') }}">

                <span class="mr-2 d-none d-lg-inline text-gray-600 small">

                    {{ auth()->user()->name }}

                </span>

                @if(auth()->user()->photo)

                    <img class="img-profile rounded-circle"
                        src="{{ asset('storage/' . auth()->user()->photo) }}">

                @else

                    <img class="img-profile rounded-circle"
                        src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}">

                @endif

            </a>

        </li>
    </ul>

</nav>