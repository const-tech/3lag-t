<nav class="top-nav not-print">
    <div class="container">
        <a href="#" class="tog-show" data-show=".top-nav .list-item"><i class="fa-solid fa-bars"></i></a>
        <ul class="list-item">
            <li>
                <div class="dropdown-hover item">
                    <a class="d-flex">{{ __('admin.Administration') }}
                        <div class="arrow-icon me-1">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </a>
                    <ul class="listis-item " id="dropdown-lang">
                        @can('الأقسام')
                        <li class="item-drop">
                            <a href="{{ route('front.departments.index') }}">
                                <p class="text">{{ __('admin.departments') }}</p>
                            </a>
                        </li>
                        <li class="item-drop">
                            <a href="{{ route('front.patient_groups.index') }}">
                                <p class="text">مجموعات المرضى</p>
                            </a>
                        </li>
                        @endcan
                        @can('الخدمات')
                        <li class="item-drop">
                            <a href="{{ route('front.products.index') }}">
                                <p class="text">{{ __('admin.Therapeutic services') }}</p>
                            </a>
                        </li>
                        @endcan
                        @can('العروض')
                        <li class="item-drop">
                            <a href="{{ route('front.offers.index') }}">
                                <p class="text">{{ __('admin.Offers') }}</p>
                            </a>
                        </li>
                        @endcan
                        @can('النماذج')
                        <li class="item-drop">
                            <a href="{{ route('front.forms.index') }}">
                                <p class="text">{{ __('admin.Forms') }}</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @can('المشتريات')
            <li>
                <a href="{{ route('front.purchases.index') }}" class="d-flex">{{ __('admin.Purchases') }}
                </a>
            </li>
            @endcan


            @can('المحولون')
            <li>
                <a href="{{ route('front.appointment.transferred') }}" class="d-flex">
                    {{ __('Transferred patients') }}
                    <div class="badge-count me-1 mb-1">
                        {{ App\Models\Appointment::where('appointment_status', 'transferred')->count() }}</div>
                </a>
            </li>
            @endcan
            @can('التقارير')
            <li>
                <a href="{{ route('front.accounting') }}" class="d-flex">
                    {{ __('accounting') }}
                </a>
            </li>
            @endcan
            <li>
                <a href="{{ route('front.guide') }}" class="d-flex">
                    دليل الاستخدام
                </a>
            </li>
            <li>
                <a href="{{ route('front.program_modules') }}" class="d-flex">
                    اضافات البرنامج
                </a>
            </li>
        </ul>
        <ul class="d-flex gap-3 align-items-center">
            @can('الاشعارات')
            <li>
                <a href="{{ route('front.notifications') }}" class="d-flex">
                    <div class=" position-relative d-flex">
                        <i class="i-item fa-solid fa-bell fs-5"></i>
                        <div class="badge-count position-absolute top-0 start-0 translate-middle">
                            {{ App\Models\Notification::where('seen', false)->count() }}</div>
                    </div>
                </a>
            </li>
            <li>
                @if (app()->getLocale() == 'ar')
                <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="d-flex">
                    <i class="fa-solid fa-language fs-5"></i>
                </a>
                @else
                <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="d-flex">
                    <i class="fa-solid fa-language fs-5"></i>
                </a>
                @endif

            </li>
            @endcan
            <li>
                <div class="dropdown-hover" data-show="dropdown-lang">
                    <div class="icon-drop">
                        <i class="fa-solid fa-user icon"></i>
                    </div>
                    <p class="text">{{ auth()->user()->name }}</p>
                    <div class="arrow-icon">
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <ul class="listis-item" id="dropdown-lang">
                        <li class="item-drop">
                            <a href="{{ route('front.profile.vacations') }}">
                                طلبات الاستئذان \ الاجازات
                            </a>
                        </li>
                        <li class="item-drop">
                            <a href="#">
                                <form class="w-100" action="{{ route('logout') }}" method="POST" id="logout-form">
                                    @csrf
                                    <button class="border-0 bg-transparent p-0">
                                        <p class="text  d-flex"> {{ __('log out') }}</p>
                                    </button>
                                </form>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
        </ul>

    </div>
</nav>
