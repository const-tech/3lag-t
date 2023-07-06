<nav class="main-navbar">
    <div
        class="container-fluid d-flex align-items-lg-center align-items-stretch gap-3 justify-content-between">
        <div class="logo">
            <div class="tog-active d-block d-lg-none" data-tog="true" data-active=".app">
                <i class="fas fa-bars"></i>
            </div>
            <img src="{{ asset('img/company-logo.svg') }}" class="img lg" alt="" />
        </div>
        <div class="list-item d-none d-lg-flex ms-auto">
          <a href="{{ route('admin.vacations') }}" class="main-btn btn-purple">
            @if(App\Models\VacationRequest::count()>0)
            <span class="main-badge">{{ App\Models\VacationRequest::count() }}</span>
            @endif
            {{ __('Vacation Requests')}}
            <img src="{{ asset('admin-assets') }}/images/icons/contract-white.svg" alt="" class="icon">
          </a>
        </div>
        <div class="dropdown info-user">
            <button class="dropdown-toggle d-flex align-items-center gap-2 content" type="button"
                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="text">
                    <div class="name">
                        <i class="fas fa-angle-down"></i>
                        {{ auth()->user()->name }}
                    </div>
                    <div class="dic">
                        Admin Manager
                    </div>
                </div>
                <div class="img">
                    <img src="{{ auth()->user()->photo ? display_file(auth()->user()->photo) : display_file(setting()->logo) }}"
                        alt="" class="icon" />
                </div>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        {{ __('profile') }}
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
</nav>
