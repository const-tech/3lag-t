<div class="appoints-section main-section">
    <div class="container">
        <h4 class="main-heading mb-4">
            @if($transferred)
            {{ __('admin.Transferred patients') }}
            @else
                {{ __('admin.Appointments') }}
            @endif
        </h4>
            @if($transferred)
                <div class="alert alert-warning" role="alert">
                    <p class="mb-0">
                        {{ __('You can delete all the transformed patients end of work or adjust the scan from the control settings of the machine scan')}}
                    </p>
                </div>
            @endif
        <div class="appoints-content bg-white p-4 rounded-2 shadow">
            <div class="available-appointments">
                <div class="row g-2">
                    @if(!$transferred)
                        <div class="col-12 col-md-4 d-flex align-items-end">
                            <div class="box-info w-100">
                                <label for="appoint-date" class="small-label mb-2">{{ __('admin.Date') }}</label>
                                <input type="date" class="form-control w-100" id="appoint-date" wire:model='date' />
                            </div>
                        </div>
                    @endif
                    <div class="col-12 col-md-4">
                        <div class="box-info">
                            <label for="linic-type" class="report-name small-label mt-3 mb-2">{{ __('admin.Clinic') }}
                            </label>
                            <select class="main-select w-100 Clinic type" id="Clinic type" wire:model='department'>
                                <option value="">{{ __('admin.Choose Clinic') }}</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="box-info">
                            <label for="the-doctor" class="report-name mt-3 mb-2 small-label">{{ __('admin.dr') }}</label>
                            <select class="main-select w-100 the-doctor" id="the-doctor" wire:model='dr'>
                                <option value="">{{ __('admin.Choose the doctor') }}</option>
                                @foreach ($doctors as $dr)
                                <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="box-info">
                            <label for="the-doctor" class="report-name mt-3 mb-2 small-label">{{ __('admin.Search by File number or mobile number') }}</label>
                            <input wire:model="search" class="form-control">
                        </div>
                    </div>
                    @if(!$transferred)
                        <div class="col-12 col-md-4">
                            <div class="box-info">
                                <label for="duration" class="report-name mt-3 mb-2 small-label">{{ __('admin.Period') }}
                                </label>
                                <select class="main-select w-100 duration" id="duration" wire:model='period'>
                                    <option value="">{{ __('admin.Period') }}</option>
                                    <option value="morning">{{ __('admin.morning') }}</option>
                                    <option value="evening">{{ __('admin.evening') }}</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="col-12 col-md-4 d-flex align-items-end">
                        <div class="btn-holder w-100 mt-4 mt-lg-0">
                            <button wire:click="resetAll" class="btn trans-btn w-100">{{ __('All Appointments')}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-end mb-2 mt-3">
                <button id="btn-prt-content" class="btn btn-sm btn-warning">
                    <i class="fa fa-print"></i>
                </button>
                @if(!$transferred)
                    <a href="{{ route('front.appointments.create') }}" class="btn-main-sm me-2">
                        {{ __('admin.Book a new appointment') }}</a>
                    <a href="{{ route('front.guests.create') }}" class="btn-main-sm me-2">
                        {{ __('admin.New Guest') }}</a>
                @endif
            </div>
            <div class="table-responsive" id="prt-content">
                <table class="table main-table">
                    <thead>
                        <th>{{__('admin.appointment_number')}}</th>
                        <th>{{__('admin.medical_number')}}</th>
                        <th>{{__('admin.civil')}}</th>
                        <th>{{__('admin.patient')}}</th>
                        @can('رؤية جوال المريض')
                        <th>{{__('admin.mobile')}}</th>
                        @endcan
                        <th>{{__('admin.nationality')}}</th>
                        <th>{{__('admin.doctor')}}</th>
                        <th>{{__('admin.clinic')}}</th>
                        <th>{{__('admin.appointment_status')}}</th>
                        <th>{{__('admin.appointment_time')}}</th>
                        <th>{{__('admin.appointment_date')}}</th>
                        <th class="not-print">{{__('actions')}}</th>
                    </thead>
                    <tbody>
                        @forelse($appoints as $appointment)
                        <tr>
                            <td>{{$appointment->appointment_number ?? "لم يحدد"}}</td>
                            <td>{{$appointment->patient->id ?? "لم يحدد"}}</td>
                            <td>{{$appointment->patient->civil ?? "لم يحدد"}}</td>
                            <td>{{$appointment->patient->name ?? "لم يحدد"}}</td>
                            @can('رؤية جوال المريض')
                            <td>{{$appointment->patient->phone ?? "لم يحدد"}}</td>
                            @endcan
                            <td>{{$appointment->patient->country->name ?? "لم يحدد"}}</td>
                            <td>{{$appointment->doctor->name ?? "لم يحدد"}}</td>
                            <td>{{$appointment->clinic->name ?? "لم يحدد"}}</td>
                            <td>{{__($appointment->appointment_status)}}</td>
                            <td>{{$appointment->appointment_time ?? "لم يحدد"}}</td>
                            <td>{{$appointment->appointment_date ?? "لم يحدد"}}</td>
                            <td class="not-print">
                                <form id="delete-{{$appointment->id}}-form" method="POST"
                                    action="{{route('front.appointments.destroy',$appointment)}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @if($appointment->appointment_status == "pending")
                                <form id="confirm-{{$appointment->id}}-form" method="POST"
                                    action="{{route('front.appointments.update',$appointment)}}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="appointment_status" value="confirmed">
                                </form>
                                <form id="cancel-{{$appointment->id}}-form" method="POST"
                                    action="{{route('front.appointments.update',$appointment)}}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="appointment_status" value="cancelled">
                                </form>

                                <button class="btn btn-sm btn-success me-1"
                                    form="confirm-{{$appointment->id}}-form">{{ __('admin.Presence') }}</button>

                                <button class="btn btn-sm closeBtn-Color text-white mx-1"
                                    form="cancel-{{$appointment->id}}-form">{{ __('admin.Did not attend') }}</button>
                                @endif

                                <button class="btn btn-sm btn-warning" id="btn-prt-content">
                                    <i class="fa fa-print"></i>
                                </button>
                                <a href="{{route('front.appointments.edit',$appointment)}}" class="btn btn-sm btn-info mx-1">
                                    <i class="fa fa-pen-to-square"></i>
                                </a>
                                <button class="btn btn-sm btn-danger" form="delete-{{$appointment->id}}-form">
                                    <i class="fa fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12">{{__('admin.no_appointments')}}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
