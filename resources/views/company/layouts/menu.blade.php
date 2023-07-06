<div class="sidebar">
    <div class="close tog-nav">
        <i class="fas fa-xmark"></i>
    </div>
    <img src="{{ asset('img/company-logo.svg') }}" alt="" class="logo" />
    <ul class="list ">

        <li class="list-item {{ request()->routeIs('company.home') ? 'active' : '' }}">
            <a href="{{ route('company.home') }}">
                <div>
                    <i class="fa-solid fa-house-user icon"></i>
                    {{ __('home') }}
                </div>
            </a>
        </li>



            <li class="list-item {{ request()->routeIs('company.departments.*') ? 'active' : '' }}">
                <a href="{{ route('company.departments.index') }}">
                    <div>
                        <i class="fa-solid fa-puzzle-piece"></i>
                        {{ __('admin.departments') }}
                    </div>
                </a>
            </li>
            <li class="list-item {{ request()->routeIs('company.program_modules.*') ? 'active' : '' }}">
                <a href="{{ route('company.program_modules.index') }}">
                    <div>
                        <i class="fa-solid fa-puzzle-piece"></i>
                        {{ __('admin.program_modules') }}
                    </div>
                </a>
            </li>

    </ul>
</div>
