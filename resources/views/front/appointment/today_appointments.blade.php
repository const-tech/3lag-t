@extends('front.layouts.front')
@section('title')
{{ __('admin.today_appointments') }}
@endsection
@section('content')
<div class="appoints-section main-section" wire:poll.30000ms>
    <div class="container">
        <h4 class="main-heading mb-4">
            {{ __('admin.today_appointments') }}
        </h4>
        <div class="appoints-content bg-white p-4 rounded-2 shadow">

            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        {{-- <th>{{__('admin.tax')}}</th> --}}
                        <th>{{ __('admin.medical_number') }}</th>
                        <th>{{ __('admin.patient') }}</th>
                        <th>{{ __('admin.patient_file') }}</th>
                        @can('رؤية جوال المريض')
                        <th>{{ __('admin.mobile') }}</th>
                        @endcan
                        <th>{{ __('admin.nationality') }}</th>
                        <th>{{ __('admin.doctor') }}</th>
                        <th>{{ __('admin.clinic') }}</th>
                        <th>{{ __('admin.appointment_status') }}</th>
                        <th>{{ __('admin.appointment_time') }}</th>
                        <th>{{ __('admin.appointment_date') }}</th>
                        <th class="not-print">{{ __('actions') }}</th>
                    </thead>
                    <tbody>
                        @forelse($appoints as $appointment)
                        <tr>
                            <td>{{ $appointment->patient->id ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->patient->name ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->patient->id ?? 'لم يحدد' }}</td>
                            @can('رؤية جوال المريض')
                            <td>{{ $appointment->patient->phone ?? 'لم يحدد' }}</td>
                            @endcan
                            <td>{{ $appointment->patient->country->name ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->doctor->name ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->clinic->name ?? 'لم يحدد' }}</td>
                            <td>{{ __($appointment->appointment_status) }}</td>
                            <td>{{ $appointment->appointment_time ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->appointment_date ?? 'لم يحدد' }}</td>
                            <td class="not-print d-flex gap-1">
                                <form id="delete-{{ $appointment->id }}-form" method="POST" action="{{ route('front.appointments.destroy', $appointment) }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @can('تحضير المرضى')
                                @if ($appointment->appointment_status == 'pending')
                                <form id="cancel-{{ $appointment->id }}-form" method="POST" action="{{ route('front.appointments.update', $appointment) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="appointment_status" value="cancelled">
                                </form>
                                @endif
                                @if (!$appointment->attended_at and $appointment->appointment_status != 'cancelled')
                                <form action="{{ route('front.appointments.presence',$appointment) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-success" type="submit">{{ __('admin.Presence') }}</button>
                                </form>

                                <form action="{{ route('front.appointments.notPresence',$appointment) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm closeBtn-Color text-white" type="submit">{{ __('admin.Did not attend') }}</button>
                                </form>
                                @endif
                                @endcan

                                @can('تعديل الموعد')
                                <a href="{{ route('front.appointments.edit', $appointment) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-pen-to-square"></i>
                                </a>
                                @endcan
                                @can('حذف الموعد')
                                <button class="btn btn-sm btn-danger" form="delete-{{ $appointment->id }}-form">
                                    <i class="fa fa-trash-can"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12">{{ __('admin.no_appointments') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection
