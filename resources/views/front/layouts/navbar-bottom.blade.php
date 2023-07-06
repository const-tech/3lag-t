<nav class="bottom-nav not-print">
    <div class="container">
        <a href="#" class="tog-show" data-show=".bottom-nav .list-item"><i class="fa-solid fa-bars"></i></a>
        <div class="nav-holder d-flex align-items-center justify-content-between">
            <ul class="list-item">
                <li>
                    <a class="item" href="{{ route('front.home') }}">
                        {{ __('admin.home') }}
                        <i class="i-item fa-solid fa-house"></i>
                    </a>
                </li>

                @can('المرضى')
                <li>
                    <a class="item" href="{{ route('front.patients.index') }}">
                        {{ __('admin.patients') }}
                        <i class="i-item fa-solid fa-users"></i>
                    </a>
                </li>
                @endcan
                @can('اضافة مريض')
                <li>
                    <a class="item" href="{{ route('front.patients.create') }}">
                        {{ __('admin.Add patient') }}
                        <i class="i-item fa-solid fa-hospital-user"></i>
                    </a>
                </li>
                @endcan
                @can('المواعيد')
                <li>
                    <a class="item" href="{{ route('front.appointments.today_appointments') }}">
                        {{ __('admin.today_appointments') }}
                        <i class="i-item fa-solid fa-calendar-days"></i>
                    </a>
                </li>
                <li>
                    <a class="item" href="{{ route('front.appointments.index') }}">
                        {{ __('admin.Appointments') }}
                        <i class="i-item fa-solid fa-calendar-days"></i>
                    </a>
                </li>

                @endcan
                @can('الفواتير')
                <li>
                    <a class="item" href="{{ route('front.invoices.index') }}">
                        {{ __('admin.invoices') }}
                        <i class="i-item fa-solid fa-file-invoice"></i>
                    </a>
                </li>
                @endcan
                @can('التشخيصات')
                <li>
                    <a class="item" href="{{ route('front.diagnoses.index') }}">
                        {{ __('admin.Diagnoses') }}
                        <i class="i-item fa-solid fa-money-check-dollar"></i>
                    </a>
                </li>
                @endcan


                <!-- <li>
                    <div class="dropdown-hover item">
                        <span class="d-flex align-items-center">
                            <div>
                                {{-- {{ __('Rays') }}
                                و --}}
                                {{ __('Lab') }}
                                <i class="i-item fa-solid fa-money-check-dollar"></i>
                            </div>
                            <div class="arrow-icon me-2">
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                        </span>
                        <ul class="listis-item " id="dropdown-lang">
                            {{-- <li class="item-drop">
                                <a href="{{ route('front.scan_requests') }}">
                            <span class="text d-flex align-items-center gap-1">
                                {{ __('Rays') }}
                                <div class="badge-count position-static">
                                    {{ App\Models\ScanRequest::where('status', 'pending')->count() }}
                                </div>
                            </span>
                            </a>
                </li> --}}
                {{-- <li class="item-drop">
                                <a href="{{ route('front.lab_requests') }}">
                <span class="text d-flex align-items-center gap-1">
                    {{ __('Lab') }}
                    <div class="badge-count position-static">{{ App\Models\LabRequest::where('status', 'pending')->count() }}</div>
                </span>
                </a>
                </li> --}}
            </ul>
        </div>
        </li> -->
        @can('تسديد الزيارات')
        <li>
            <a class="item" href="{{ route('front.pay_visit') }}">
                {{ __('admin.Pay a visit') }}
                <i class="i-item fa-solid fa-money-check-dollar"></i>
                <div class="badge-count">
                    {{ App\Models\Invoice::whereRelation('employee', 'type', 'dr')->where('status', 'Unpaid')->count() }}
                </div>
            </a>
        </li>
        @endcan

        </ul>
    </div>
    </div>
</nav>
