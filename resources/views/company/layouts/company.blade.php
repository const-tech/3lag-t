@include('company.layouts.header')
<div>

    <div class="app h-app">
        @include('company.layouts.menu')
        <div class="main-side">
            <div class="container-fluid">
                @include('company.layouts.navbar')
                <section class="py-3">
                    <x-message-admin></x-message-admin>
                    @yield('content')
                </section>
            </div>
            <div class="footer-app d-flex align-items-center justify-content-end gap-2">
                <a href="https://www.const-tech.org/">
                    جميع الحقوق محفوظة لـ كوكبة التقنية 2022
                    <img src="{{ asset('img/footer/copy.png') }}" class="logo me-2" alt="logo_login">
                </a>
            </div>
        </div>
    </div>

    @include('company.layouts.footer')
</div>
