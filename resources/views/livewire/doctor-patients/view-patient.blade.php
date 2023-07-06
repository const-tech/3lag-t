<section class="main-section users">
    <!-- @if ($errors->any())
    @foreach ($errors->all() as $error)
<div class="alert alert-warning">{{ $error }}</div>
@endforeach
    @endif -->
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __('admin.View patient') }}</h4>
        <div class="row row-gap-24">
            <div class="col-lg-3">
                <div class="list-group main-list-group">
                    <button wire:click='$set("screen","data")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'data' ? 'active' : '' }}">
                        {{ __('admin.Patient data') }}
                    </button>
                    <button wire:click='$set("screen","invoices")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'invoices' ? 'active' : '' }}">
                        {{ __('Patient invoices') }}
                        <div class="badge-count">
                            {{ $patient->invoices()->count() }}
                        </div>
                    </button>
                    <button wire:click='$set("screen","appointments")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'appointments' ? 'active' : '' }}">
                        {{ __('admin.Patient appointments') }}
                        <div class="badge-count">
                            {{ $patient->appointments()->count() }}
                        </div>
                    </button>
                    <button wire:click='$set("screen","diagnoses")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'diagnoses' ? 'active' : '' }}">
                        {{ __('admin.Patient diagnoses') }}
                        <div class="badge-count">
                            {{ $patient->diagnoses()->count() }}
                        </div>
                    </button>
                    <button wire:click='$set("screen","files")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'files' ? 'active' : '' }}">
                        {{ __('admin.Patient files') }}
                        <div class="badge-count">
                            {{ $patient->files()->count() }}
                        </div>
                    </button>
                    <button wire:click='$set("screen","scan-requests")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'scan-requests' ? 'active' : '' }}">
                        {{ __('Radiology Requests') }} <div class="badge-count">
                            {{ $patient->scanRequests()->count() }}
                        </div>
                    </button>
                    <button wire:click='$set("screen","labs")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'labs' ? 'active' : '' }}">
                        {{ __('Lap Requests') }} <div class="badge-count">
                            {{ $patient->labRequests()->count() }}
                        </div>
                    </button>
                    <button wire:click='$set("screen","contact")' type="button"
                        class="list-group-item list-group-item-action {{ $screen == 'contact' ? 'active' : '' }}">
                        {{ __('admin.Contact data') }}
                    </button>
                </div>
            </div>

            <div class="col-lg-9">
                @include('doctor.patients.show-screens.' . $screen)
                <div class="row">
                    <div class="col-4">
                        {{ __('Number') }}:
                        <span class="text-main-color">{{ $patient->id }}</span>
                    </div>
                    <div class="col-4">
                        {{ __('admin.employee') }}:
                        <span class="text-main-color">{{ $patient->user->name }}</span>
                    </div>
                    <div class="col-4">
                        {{ __('Latest employee update:') }}
                        <span class="text-main-color">{{ $patient->user->name }}</span>
                    </div>
                </div>
                @can('عرض الملف الشخصي للمريض')
                    <div class="btn_holder d-flex align-items-center justify-content-center my-3">
                        <a href="{{ route('doctor.patientFile', $patient->id) }}" class="btn btn-sm btn-purple">
                            <i class="fa fa-eye"></i>
                            {{ __('View the patient is medical file') }}
                        </a>
                    </div>
                @endcan

            </div>
        </div>
    </div>
</section>
