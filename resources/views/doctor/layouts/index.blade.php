<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Altheeb Clinic')</title>
    <!-- Normalize -->
    <link rel="stylesheet" href="{{ asset('/css/normalize.css') }}" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}" />
    <!-- Main Faile Css  -->
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}" />
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500;600;700;800&display=swap"
        rel="stylesheet" />
    @livewireStyles
    @stack('css')
</head>

<body>

    <!-- start scroll top button -->
    <div class="up-btn position-fixed rounded-3 text-white">
        <i class="up-ar fa-solid fa-angles-up"></i>
        <i class="tooth-icon fa-solid fa-tooth"></i>
    </div>
    <!-- end scroll top button -->

    <!-- Start Loader -->
    <div class='loader-container position-fixed w-100 vh-100'>
        <img src="{{ asset('img/rolling-loader.gif') }}" alt="loader-img" class="the_loader">
    </div>
    <!-- End Loader -->

    <!-- Start Top Nav Bar -->
    <nav class="top-nav">
        <div class="container justify-content-between justify-content-md-end   py-2">
            <a href="#" class="tog-show" data-show=".top-nav .list-item"><i class="fa-solid fa-bars"></i></a>
            <div class="dropdown-hover" data-show="dropdown-lang">
                <div class="icon-drop">
                    <i class="fa-solid fa-user icon"></i>
                </div>
                <p class="text">{{ doctor()->name }}</p>
                <div class="arrow-icon">
                    <i class="fa-solid fa-angle-down"></i>
                </div>
                <ul class="listis-item" id="dropdown-lang">
                    <li class="item-drop">
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                        </form>
                        <button class="border-0" form="logout-form">
                            <p class="text">{{ __('log out') }}</p>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Top Nav Bar -->

    <!-- Start Bottom Nav Bar -->
    <nav class="bottom-nav">
        <div class="container">
            <a href="#" class="tog-show" data-show=".bottom-nav .list-item"><i class="fa-solid fa-bars"></i></a>
            <ul class="list-item">
                <li>
                    <a class="item" href="{{ url('doctor') }}">
                        {{ __('home') }}
                        <i class="i-item fa-solid fa-house"></i>
                    </a>
                </li>

                @can('المرضى')
                    <li>
                        <a class="item" href="{{ route('doctor.patients.index') }}">
                            {{ __('admin.patients') }}
                            <i class="i-item fa-solid fa-bed-pulse"></i>
                        </a>
                    </li>
                @endcan
                <li>
                    <a class="item" href="{{ route('doctor.interface') }}">
                        {{ __('doctor interface') }}
                        <i class="i-item fa-solid fa-stethoscope"></i>
                    </a>
                </li>

                @can('المواعيد')
                    <li>
                        <a class="item" href="{{ route('doctor.appointments.today_appointments') }}">
                            {{ __('admin.today_appointments') }}
                            <i class="i-item fa-solid fa-calendar-days"></i>
                        </a>
                    </li>
                    <li>
                        <a class="item" href="{{ route('doctor.appointments') }}">
                            {{ __('Appointments') }}
                            <i class="i-item fa-solid fa-calendar-days"></i>
                        </a>
                    </li>
                    <li>
                        <a class="item" href="{{ route('doctor.appointments_info') }}">
                            {{ __('Appointments Data') }}
                            <i class="i-item fa-solid fa-calendar-days"></i>
                        </a>
                    </li>
                @endcan
                @can('الفواتير')
                    <li>
                        <a class="item" href="{{ route('doctor.invoices.index') }}">
                            {{ __('Invoices') }}
                            <i class="i-item fa-solid fa-file-invoice"></i>
                        </a>
                    </li>
                @endcan
                @can('التقارير')
                    <li>
                        <a class="item" href="{{ route('doctor.report') }}">
                            {{ __('Reports') }}
                            <i class="i-item fa-solid fa-file-invoice"></i>
                        </a>
                    </li>
                @endcan
                @can('المرضى بالانتظار')
                <li>
                    <a class="item"
                        href="{{ route('doctor.appointments', ['appointment_status' => 'confirmed', 'date' => date('Y-m-d')]) }}">
                        {{ __('Today appointments') }}
                        <i class="i-item fa-solid fa-hospital-user"></i>
                        <div class="badge-count">
                            {{ doctor()->appointments()->today()->where('appointment_status', 'confirmed')->count() }}
                        </div>
                    </a>
                </li>
                @endcan
                <li>
                    <a class="item"
                        href="{{ route('doctor.interface') }}">
                        {{ __('patients referred') }}
                        <i class="i-item fa-solid fa-hospital-user"></i>
                        <div class="badge-count">
                        {{ doctor()->appointments()->thisHour()->count() + doctor()->appointments()->Transferred()->count() }}
                        </div>
                    </a>
                </li>
                @if (app()->getLocale() == 'ar')
                    <li>
                        <a class="lang me-2" href="{{ LaravelLocalization::getLocalizedURL('en') }}"> <i
                                class="fa-solid fa-language"></i></a>
                    </li>
                @else
                    <li>
                        <a class="lang me-2" href="{{ LaravelLocalization::getLocalizedURL('ar') }}"> <i
                                class="fa-solid fa-language"></i></a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <!-- End Bottom Nav Bar -->
    <!-- start main section -->
    <section class="main-section py-5">
        <x-message-admin />
        @yield('content')
    </section>
    <!-- end main section -->
    <!-- Start Footer -->
    <div class="footer-bottom py-3 not-print">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <p>{{ __('All rights reserved © 2022') }}</p>
                <div class="about_data d-flex align-items-center justify-content-center">
                    <p class="ms-2">{{ __('C Program - Medical Clinic Management 0.0.1') }}</p>
                    <img class="alt_image" src="{{ asset('img/footer/doc.png') }}" alt="image">
                </div>
                <a href="https://www.const-tech.org/">
                    <img src="{{ asset('img/footer/copy.png') }}" alt="logo">
                </a>
            </div>
        </div>
    </div>
    <!-- ENd Footer -->
    <!-- Js Files -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        window.addEventListener('alert', ({
            detail: {
                type,
                message
            }
        }) => {
            Toast.fire({
                icon: type,
                title: message
            })
        })
    </script>
    @livewireScripts

    @stack('js')
</body>

</html>
