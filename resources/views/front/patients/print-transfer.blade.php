@extends('front.layouts.front')
@section('title')
{{ __("طباعة تحويلة المريض") }}
@endsection
@section('content')
<section class="main-section py-5">
    <div class="container">
        <div class="section-content bg-white  rounded-3 p-4">
            <div class="content" id="prt-contenst">
                    <div class="d-flex align-items-start justify-content-start flex-column flex-md-row align-items-md-center gap-2 mb-3">
                        <div class="bg-black text-white rounded-3 px-3 py-2 mb-1 mb-md-0" id="staticBackdropLabel">
                            <span>
                            {{ __('Transfer of the patient')}}
                            {{$appointment->patient?->name }}
                            {{ __('to the doctor')}}
                            </span>
                        </div>
                            <div class="date text-white rounded-3 px-3 py-2 mb-1 mb-md-0 bg-black">
                                <small class="ms-2">
                                {{ __('Date')}} :
                                    <span class="">{{date('Y-m-d')}}</span>
                                </small>
                                <small class="ms-2">
                                {{ __('Day')}} :
                                    <span class="">{{Carbon::now()->translatedFormat("D")}}</span>
                                </small>
                                <small>
                                {{ __('Hour')}} :
                                    <span class="">{{date('H:i')}}</span>
                                </small>
                            </div>
                            {{--<livewire:select-doctor-for-transfer /> --}}
                        <div class=" rounded-3 px-3 py-2 text-white bg-black">{{ __('Direct Doctor Transfer')}}</div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4 text-end">
                            <div class="d-flex flex-column">
                                <label class="small-label mb-2" for=""> {{ __('Clinic')}} </label>
                                <input readonly type="text" class="form-control" value="{{ $appointment->clinic?->name }}" id="">
                            </div>
                        </div>

                        <div class="col-md-4 text-end">
                            <div class="d-flex flex-column">
                                <label class="small-label mb-2" for=""> {{ __('the Doctor')}} </label>
                                <input readonly class="form-control" type="text" value="{{ $appointment->doctor?->name }}" id="">
                            </div>
                        </div>

                        <div class="col-md-4 text-end">
                            <div class="d-flex flex-column">
                                <label for="appointment_date" class="mb-2 small-label">{{__('Period')}}</label>
                                <input type="text" class="form-control" readonly value="{{ __($appointment->appointment_duration) }}" id="">
                            </div>
                        </div>

                        <div class="col-sm-3 text-end">
                            <label class="small-label" for=""> {{ __('waiting number')}} </label>
                            <input type="number" value="{{ request('waiting') }}" readonly class="form-control">
                        </div>
                    </div>
                    <button class="not-print btn btn-warning btn-sm px-3 mt-4" id="print-btn" onclick="print()">
                        {{ __('print')}}
                    </button>
            </div>
        </div>
    </div>
</section>
@push('js')

@endpush
@endsection
