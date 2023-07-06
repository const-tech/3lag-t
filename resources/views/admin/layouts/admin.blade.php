@include('admin.layouts.header')
@include('admin.layouts.navbar')

<div class="app">
    @include('admin.layouts.menu')
    <div class="main-side">
        <div class="content">
        <x-message-admin></x-message-admin>
        @yield('content')
        </div>
        <div class="footer-app d-flex align-items-center justify-content-end gap-2">
            <a href="https://www.const-tech.org/">
                جميع الحقوق محفوظة لـ كوكبة التقنية 2022
                <img src="{{ asset('img/footer/copy.png') }}" class="logo me-2" alt="logo_login">
            </a>
        </div>
    </div>
</div>
@include('admin.layouts.footer')
