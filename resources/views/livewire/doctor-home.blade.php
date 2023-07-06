<div class="dr-main-section">
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('admin.home') }}</h4>
        <div class="boxes-info-5 mb-4">
            <a href="{{ route('doctor.patients.index') }}">
                <div class="box-info blue">
                    <i class="fas fa-user-injured bg-icon"></i>
                    <div class="num">{{ doctor()->appointments()->examined()->count() }}</div>
                    <div class="text">{{ __('All patients') }}</div>
                </div>
            </a>
            <a href="{{ route('doctor.appointments.today_appointments') }}">
                <div class="box-info green">
                    <i class="far fa-calendar-alt bg-icon"></i>
                    <div class="num">
                        {{ doctor()->appointments()->today()->where('appointment_status', 'confirmed')->count() }}</div>
                    <div class="text">{{ __('Today appointments') }}</div>
                </div>
            </a>
            <a href="{{ route('doctor.interface') }}">
                <div class="box-info pur">
                    <i class="fas fa-user-injured fs-75px fa-beat bg-icon"></i>
                    <div class="num">
                        {{ doctor()->appointments()->thisHour()->count() + doctor()->appointments()->Transferred()->count() }}
                    </div>
                    <div class="text">{{ __('online patients') }}</div>
                </div>
            </a>
            <a href="{{ route('doctor.invoices.index') }}">
                <div class="box-info red">
                    <i class="fas fa-file-invoice-dollar bg-icon"></i>
                    <div class="num">{{ doctor()->invoices()->count() }}</div>
                    <div class="text">{{ __('All Invoices') }}</div>
                </div>
            </a>
            <a href="{{ route('doctor.invoices.index') }}">
                <div class="box-info orange">
                    <i class="fas fa-file-invoice bg-icon"></i>
                    <div class="num">{{ doctor()->invoices()->pending()->count() }}</div>
                    <div class="text">{{ __('Unpaid bills') }}</div>
                </div>
            </a>
        </div>
        <h4 class="small-heading mb-4">{{ __('Today appointments') }}</h4>
        <div class="tabla-content p-4 bg-white shadow rounded-3">
            <div class="table-responsive">
                <table class="table main-table mb-0">
                    <thead>
                        <th>{{ __('admin.patient') }}</th>
                        <th>{{ __('admin.appointment_status') }}</th>
                        <th>{{ __('admin.appointment_time') }}</th>
                        <th>{{ __('admin.appointment_date') }}</th>
                        <th>{{ __('actions') }}</th>
                    </thead>
                    <tbody>
                        @forelse ($appoints as $appoint)
                        <tr>
                            <td>{{ $appoint->patient->name }}</td>
                            <td>{{ __($appoint->appointment_status) }}</td>
                            <td>{{ $appoint->appointment_time }}</td>
                            <td>{{ $appoint->appointment_date }}</td>
                            <td>

                                @if ($appoint->appointment_status == 'pending')
                                <button class="btn btn-sm btn-info" wire:click="cancel({{ $appoint->id }})">الغاء</button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="small-label">{{ __('admin.Sorry, there are no results') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
