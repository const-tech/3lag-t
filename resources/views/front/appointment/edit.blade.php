@extends('front.layouts.front')
@section('title')
    {{ __('admin.appointments') }}
@endsection
@section('content')
    <div class="py-5 section-height main-section">
        {{--  appointments table  --}}
        <div class="container">
            <h4 class="main-heading mb-4">{{ __('Edit appointment')}}</h4>
            <div class="section-content p-4 shadow rounded-3 bg-white">
                <div class="d-flex align-items-center justify-content-end">
                    <a href="{{route('front.appointments.index')}}" class="btn-main-sm">
                    {{ __('Appointments')}}
                    </a>
                </div>
                <div>
                    {{--            edit appointment form--}}
                    <livewire:appointment-form :appointment="$appointment"/>
                </div>
            </div>
        </div>
    </div>

@endsection
