
@include('front.layouts.head')
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
    @endforeach
@endif

<section class="page-login">
    <form class="form-login"action="{{route('login')}}" method="POST">
        @csrf
        <div class="box-login">
            <div class="img-login">
                <img src="{{ asset('img/login/login-dr-user.webp') }}" alt="">
            </div>
            <div class="content-login">
                <div class="w-100">
                    <h3 class="title d-flex align-items-center justify-content-between">
                        {{ __('admin.Login') }}
                        <!-- <a href="#" class="lang-control">
                            <i class="fa-solid fa-language"></i>
                        </a> -->
                        @if (app()->getLocale() == 'ar')
                            <a class="lang-control" href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                                <i class="fa-solid fa-language"></i>
                            </a>
                        @else
                            <a class="lang-control" href="{{ LaravelLocalization::getLocalizedURL('ar') }}">
                                <i class="fa-solid fa-language"></i>
                            </a>
                        @endif
                    </h3>

                    <div class="lable">{{__('email')}}</div>
                    <input  required type="email"  name="email" placeholder="{{__('email')}}"class="form-control"  />

                    <div class="lable mt-3">{{ __('admin.password') }}</div>
                    <input  class="form-control"required="" type="password" placeholder="{{ __('admin.password') }}" name="password" />

                                    <!-- <a href="{{ route('register') }}" class="acc-new mt-3">{{ __('admin.Register') }}</a> -->

                                <button class="btn sub" type="submit">
                                    {{ __('admin.Login') }}
                                </button>
                                <hr class="my-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="https://www.const-tech.org/">
                                        برمجة وتطوير كوكبة التقنية

                                        <img src="{{ asset('img/login/LOGO3.png') }}" alt="" class="logo-footer">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

        <!-- <div class="footer">
            <div class="text">برمجة وتطوير _ كوكبة التقنية</div>
            <img src="{{ asset('images/login2.jpg') }}" alt="" />
        </div> -->
</section>






