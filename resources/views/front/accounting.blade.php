@extends('front.layouts.front')
@section('title')
    {{ __('accounting') }}
@endsection
@section('content')
    <section class="main-section notice">
        <div class="container">
            <h4 class="main-heading">{{ __('accounting') }}</h4>
            <div class="bg-white p-3 rounded-2 shadow">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.Financial_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('General account statement') }}</p>
                                <img src="{{ asset('img/report-8.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.Clidoc_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('clinic and the doctor') }}</p>
                                <img src="{{ asset('img/consultation.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ url('/treasury') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Treasury report') }}</p>
                                <img src="{{ asset('img/report-1.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.installment_company') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Tamara Corporation') }}</p>
                                <img src="{{ asset('img/report-9.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.purchases_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Procurement report') }}</p>
                                <img src="{{ asset('img/report-6.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.insurances_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Insurance companies') }}</p>
                                <img src="{{ asset('img/hospital.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.reception_staff_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('reception') }}</p>
                                <img src="{{ asset('img/information-desk.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.patient_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Patient report') }}</p>
                                <img src="{{ asset('img/patient-report.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.not_sudies') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Non-Saudi patients') }}</p>
                                <img src="{{ asset('img/patient.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.salaries.index') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Salary report') }}</p>
                                <img src="{{ asset('img/report-10.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.expenses_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Expense report') }}</p>
                                <img src="{{ asset('img/report-7.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.expenses.index') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('admin.Expenses') }}</p>
                                <img src="{{ asset('img/report-2.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.patient_groups_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">تقرير مجموعات المرضى</p>
                                <img src="{{ asset('img/patient-report.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
