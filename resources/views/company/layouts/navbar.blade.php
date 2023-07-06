<nav class="main-navbar">
    <div class="d-flex align-items-center justify-content-between">
        <div class="tog-nav" data-tog="true">
            <i class="fas fa-bars"></i>
        </div>

        <div class="d-flex align-items-center gap-3">

            <div class="dropdown dropdown-user ">
                <button class="btn btn-secondary  dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ auth()->user()->photo ? display_file(auth()->user()->photo) : display_file(setting()->logo) }}"
                        alt="" class="photo">
                    {{ auth()->user()->name }}

                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                    <li>
                        <a class="dropdown-item" href="{{ route('company.profile') }}">
                            <i class="fa-solid fa-id-badge"></i> {{ __('profile') }}
                        </a>
                    </li>

                    <li>
                        <form class="dropdown-item" action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                            <button type="submit" class="w-100">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                خروج
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>
