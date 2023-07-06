<div class="sidebar">
    <div class="tog-active d-none d-lg-block" data-tog="true" data-active=".app">
        <i class="fas fa-bars"></i>
    </div>
    <ul class="list ">
        @can('الواجهة')
        <li class="list-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
            <a href="{{ route('admin.home') }}">
                <div>
                    <i class="fa-solid fa-house-user icon"></i>
                    {{__('home') }}
                </div>
            </a>
        </li>
        @endcan
        <li class="list-item">
            <a target="_blank" href="{{ route('front.home') }}">
                <div>

                    <i class="fa-solid fa-desktop icon"></i>

                    {{__('interface') }}
                </div>
            </a>
        </li>
        <li class="list-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <a href="{{ route('admin.settings') }}">
                <div>
                    <i class="fas fa-cog"></i>
                    {{ __('settings') }}
                </div>
            </a>
        </li>
        {{-- @can('الاعدادت')
        @endcan --}}
        @can('الصلاحيات')
        <li class="list-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
            <a href="{{ route('admin.roles.index') }}">
                <div>
                    <i class="fas fa-chart-bar"></i>
                    {{ __('groups') }}
                </div>
            </a>
        </li>
        @endcan

        @can('الأقسام')
        <li class="list-item {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">
            <a href="{{ route('admin.departments.index') }}">
                <div>
                    <i class="fa-solid fa-puzzle-piece"></i>
                    {{ __('admin.departments')}}
                </div>
            </a>
        </li>
        @endcan
        @can('الموظفين')
        <li class="list-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}">
                <div>
                    <i class="fa-solid fa-user-tie"></i> {{ __('admin.users')}}
                </div>
            </a>
        </li>
        @endcan
        @can('الأقسام')

        @endcan
        @can('الأقسام')
        <li class="list-item {{ request()->routeIs('admin.cities.*') ? 'active' : '' }}">
            <a href="{{ route('admin.cities.index') }}">
                <div>
                    <i class="fa-solid fa-building-wheat"></i> {{ __('admin.cities')}}

                </div>
            </a>
        </li>
        @endcan
        @can('الأقسام')

        @endcan
        @can('الأقسام')

        <li class="list-item">
            <a data-bs-toggle="collapse" href="#settings" aria-expanded="false">
                <div>
                    <i class="fa-solid fa-hospital-user"></i>
                    {{ __('admin.patients')}}
                </div>
                <i class="fa-solid fa-angle-right arrow"></i>
            </a>
        </li>
        <div class="collapse item-collapse" id="settings">
            <li class="list-item">
                <a href="{{ route('admin.patients.index') }}">
                    <div>
                        <i class="fa-solid fa-hospital-user"></i> {{ __('admin.patients')}}
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.countries.index') }}">
                    <div>
                        <i class="fa-solid fa-address-card"></i> {{ __('admin.countries')}}
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.relationships.index') }}">
                    <div>
                        <i class="fa-solid fa-users"></i> {{ __('admin.relationships')}}
                    </div>
                </a>
            </li>
            <li class="list-item">
                <a href="{{ route('admin.diagnoses.index') }}">
                    <div>
                        <i class="fa-solid fa-comment-medical"></i> {{ __('admin.Diagnoses')}}
                    </div>
                </a>
            </li>
        </div>
        @endcan
        @can('الأقسام')
        <li class="list-item {{ request()->routeIs('admin.forms.*') ? 'active' : '' }}">
            <a href="{{ route('admin.forms.index') }}">
                <div>
                    <i class="fa-solid fa-file-signature"></i> {{ __('admin.Forms')}}
                </div>
            </a>
        </li>
        @endcan
        <li class="list-item {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
            <a href="{{ route('admin.appointments.index') }}">
                <div>
                    <i class="fa-solid fa-calendar-days"></i> {{ __('admin.appointments')}}
                </div>
            </a>
        </li>
        <li class="list-item {{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}">
            <a href="{{ route('admin.invoices.index') }}">
                <div>
                    <i class="fa-solid fa-file-invoice-dollar"></i> {{ __('admin.invoices')}}
                </div>
            </a>
        </li>
        <li class="list-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <a href="{{ route('admin.products.index') }}">
                <div>
                    <i class="fa-solid fa-handshake-angle"></i> {{ __('admin.Therapeutic services')}}
                </div>
            </a>
        </li>
        <li class="list-item {{ request()->routeIs('admin.insurances.*') ? 'active' : '' }}">
            <a href="{{ route('admin.insurances.index') }}">
                <div>
                    <i class="fa-solid fa-building"></i> {{ __('admin.insurances')}}
                </div>
            </a>
        </li>
        <!-- <li class="list-item {{ request()->routeIs('admin.vacations') ? 'active' : '' }}">
            <a href="{{ route('admin.vacations') }}">
                <div>
                    <i class="fa-solid fa-building"></i> {{ __('Vacation Requests')}}
                </div>
            </a>
        </li> -->
        {{-- <li class="list-item {{ request()->routeIs('admin.user-manuals.*') ? 'active' : '' }}">
        <a href="{{ route('admin.user-manuals.index') }}">
            <div>
                <i class="fa-solid fa-building"></i> {{ __('admin.user-manuals')}}
            </div>
        </a>
        </li> --}}
    </ul>
</div>
