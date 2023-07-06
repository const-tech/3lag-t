<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title','Altheeb Clinic')</title>
    <!-- Normalize -->
    <link rel="stylesheet" href="{{asset('/css/normalize.css')}}" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/css/all.min.css')}}" />
    <!-- Main Faile Css  -->
    <link rel="stylesheet" href="{{asset('/css/main.css')}}" />
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500;600;700;800&display=swap"
        rel="stylesheet"
    />
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
    <img src="{{ asset('img/loader.gif') }}" alt="loader-img" class="the_loader">
</div>
<!-- End Loader -->

<!-- Start Top Nav Bar -->
<nav class="top-nav">
    <div class="container justify-content-between justify-content-md-end   py-2">
        <a href="#" class="tog-show" data-show=".top-nav .list-item"
        ><i class="fa-solid fa-bars"></i
            ></a>
        <div class="dropdown-hover" data-show="dropdown-lang">
            <div class="icon-drop">
                <i class="fa-solid fa-user icon"></i>
            </div>
            <p class="text">{{auth()->user()->name}}</p>
            <div class="arrow-icon">
                <i class="fa-solid fa-angle-down"></i>
            </div>
            <ul class="listis-item" id="dropdown-lang">
                <li class="item-drop">
                    <a href="#">
                        <p class="text">الدعم الفني</p>
                    </a>
                </li>
                <li class="item-drop">
                    <form id="logout-form" method="POST" action="{{route('logout')}}">
                        @csrf
                    </form>
                    <button class="border-0" form="logout-form">
                        <p class="text">تسجيل الخروج</p>
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
        <a href="#" class="tog-show" data-show=".bottom-nav .list-item"
        ><i class="fa-solid fa-bars"></i
            ></a>
        <ul class="list-item">
            <li>
                <a class="item" href="{{route('lab.home')}}">
                    الرئيسية
                    <i class="i-item fa-solid fa-house"></i>
                </a>
            </li>

            @can('المرضى')
            <li>
                <a class="item" href="{{route('lab.patients.index')}}">
                    {{ __('admin.patients') }}
                    <i class="i-item fa-solid fa-bed-pulse"></i>
                </a>
            </li>
            @endcan
            <li>
                <a class="item" href="{{route('lab.requests')}}">
                    {{ __('Lap Requests')}}
                    <i class="i-item fa-solid fa-bed-pulse"></i>
                </a>
            </li>
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
<div class="footer-bottom py-3">
    <div class="container">
        <div
            class="d-flex flex-wrap align-items-center justify-content-between gap-3"
        >
            <p>جميع الحقوق محفوظة © لـ 2022</p>
            <img src="{{asset('')}}/img/footer/copy.png" alt="" />
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
