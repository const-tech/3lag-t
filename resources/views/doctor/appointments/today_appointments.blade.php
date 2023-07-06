@extends('doctor.layouts.index')
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
                    <table class="table main-table"  >
                        <thead>
                            <th>{{ __('admin.department') }}</th>
                            <th>{{ __('admin.doctor') }}</th>
                            <th>{{ __('admin.patient') }}</th>
                            <th>{{ __('admin.patient_file') }}</th>
                            <th>{{ __('admin.appointment_status') }}</th>
                            <th>{{ __('admin.appointment_time') }}</th>
                            <th>{{ __('admin.appointment_date') }}</th>
                            <th class="not-print">{{ __('actions') }}</th>
                        </thead>
                        <tbody>
                            @forelse($appoints as $appointment)
                                <tr>
                                    <td>{{ $appointment->clinic->name ?? 'لم يحدد' }}</td>
                                    <td>{{ $appointment->doctor->name ?? 'لم يحدد' }}</td>
                                    <td>{{ $appointment->patient->name ?? 'لم يحدد' }}</td>
                                    <td>{{ $appointment->patient->id ?? 'لم يحدد' }}</td>
                                    <td>{{ __('admin.' . $appointment->appointment_status) }}</td>
                                    <td>{{ $appointment->appointment_time ?? 'لم يحدد' }}</td>
                                    <td>{{ $appointment->appointment_date ?? 'لم يحدد' }}</td>
                                    <td class="not-print">
                                        @can('تحضير المرضى')
                                        @if(!$appointment->attended_at and $appointment->appointment_status!='cancelled')
                                                <button class="btn btn-sm btn-success me-1"
                                                    wire:click="presence({{ $appointment }})">{{ __('admin.Presence') }}</button>
        
                                                    <button class="btn btn-sm closeBtn-Color text-white mx-1"
                                                    wire:click="notPresence({{ $appointment }})">{{ __('admin.Did not attend') }}</button>
                                            @endif
                                        @endcan
                                        @if ($appointment->patient)
                                            <a class="btn btn-success btn-sm" target="_blank"
                                                href="{{ route('front.patients.show', $appointment->patient->id) }}"><i
                                                    class="fa-solid fa-eye"></i></a>
                                        @endif
                                        <button data-bs-toggle="modal" data-bs-target="#add_or_update"
                                            class="btn btn-sm btn-info text-white py-2" wire:click='edit({{ $appointment }})'>
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        @if ($appointment->appointment_status == 'pending')
                                            <button class="btn btn-sm btn-info"
                                                wire:click="cancel({{ $appointment->id }})">الغاء</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">{{ __('admin.no_appointments') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
