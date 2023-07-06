@extends('front.layouts.front')
@section('title')
{{ __('admin.appointments') }}
@endsection
@section('content')
<section class="main-section py-5">
    <div class=" container">
        {{-- appointments table  --}}
        <h4 class="main-heading mb-3">{{ __('Add appointment')}}</h3>
            <div class="bg-white p-3 rounded-2 shadow">
                <div class="d-flex justify-content-end mb-1">
                    <a href="{{route('front.appointments.index')}}" class="btn-main-sm">{{ __('Appointments')}}</a>
                </div>
                {{--create appointment form--}}
                <livewire:appointment-form  />
            </div>
    </div>
</section>

@endsection
