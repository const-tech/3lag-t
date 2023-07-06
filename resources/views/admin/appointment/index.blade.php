@extends('admin.layouts.admin')
@section('title')
    {{ __('admin.appointments') }}
@endsection
@section('content')
    {{--  appointments table  --}}
    <div>
        <h3>{{__('appointments')}}</h3>
    </div>
    <div>
        <table class="table table-bordered table-striped text-center">
            <thead>
            <th>{{__('admin.appointment_number')}}</th>
            <th>{{__('admin.patient')}}</th>
            <th>{{__('admin.employee')}}</th>
            <th>{{__('admin.doctor')}}</th>
            <th>{{__('admin.clinic')}}</th>
            <th>{{__('admin.appointment_status')}}</th>
            <th>{{__('admin.appointment_time')}}</th>
            <th>{{__('admin.appointment_date')}}</th>
            </thead>
            <tbody>
            @forelse($appointments as $appointment)
                <tr>
                    <td>{{$appointment->appointment_number ?? "لم يحدد"}}</td>
                    <td>{{$appointment->patient->name ?? "لم يحدد"}}</td>
                    <td>{{$appointment->employee->name ?? "لم يحدد"}}</td>
                    <td>{{$appointment->doctor->name ?? "لم يحدد"}}</td>
                    <td>{{$appointment->clinic->name ?? "لم يحدد"}}</td>
                    <td>{{$appointment->appointment_status ?? "لم يحدد"}}</td>
                    <td>{{$appointment->appointment_time ?? "لم يحدد"}}</td>
                    <td>{{$appointment->appointment_date ?? "لم يحدد"}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">{{__('admin.no_appointments')}}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
