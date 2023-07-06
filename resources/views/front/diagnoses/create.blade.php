@extends('front.layouts.front')
@section('title')
    {{ __('admin.appointments') }}
@endsection
@section('content')
    <section class="main-section py-5">
    <div class=" container">
        {{--  appointments table  --}}
            <h3 class="main-heading">{{ __('Add appointment')}}</h3>

        <div class="d-flex justify-content-end mb-2">
            <a  href="{{route('front.appointments.index')}}"            class="btn-main-sm"
>
{{ __('Appointments')}}


        </a>
            </div>
        <div class="bg-white p-3 rounded-2 shadow">
            {{--            create appointment form--}}
            <livewire:appointment-form/>
        </div>
    </div>
    </section>

@endsection
