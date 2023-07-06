<div>
    {{-- allert if session success --}}
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <x-alert></x-alert>
    @include('front.unpaidInvoicePop')
    <div class="row g-3">
        <div class="col-md-4 ">
            <label for="" class="small-label mb-2">{{ __('Search by medical number or patient number') }}</label>
            <input type="text" wire:model="patient_key" wire:keyup.debounce.300ms='get_patient' class="form-control">
        </div>
        <div class="col-md-4 ">
            <label for="patient_id" class="small-label mb-2">{{ __('Patient name') }}</label>
            <input type="text" value="{{ $patient ? $patient->name : '' }}" readonly id="" class="form-control w-100" />
        </div>

        <div class="col-md-4 ">
            <label for="" class="small-label">{{ __('admin.phone') }}</label>
            <input type="tel" value="{{ $patient ? $patient->phone : '' }}" name="phone" readonly id="" class="form-control w-100" />
        </div>
        <div class="col-md-4">
            <label for="clinic_id" class="small-label mb-2">{{ __('admin.clinic') }}</label>
            <select wire:model="clinic_id" id="clinic_id" class="main-select w-100">
                <option>{{ __('Choose a clinic') }}</option>
                @foreach (\App\Models\Department::where('appointmentstatus', 1)->get() as $clinic)
                <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                @endforeach
            </select>

        </div>
        <div class="col-md-4">
            <label for="doctor_id" class="small-label mb-2">{{ __('admin.doctor') }}</label>
            <select wire:model="doctor_id" id="doctor_id" class="main-select w-100">
                <option>{{ __('Choose a doctor') }}</option>
                @if ($clinic_id)
                @foreach (\App\Models\User::doctors()->where('department_id', $clinic_id)->get() as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
                @endif
            </select>

        </div>

        <div class="col-md-4 ">
            <label for="appointment_status">{{ __('admin.appointment_status') }}</label>
            <select wire:model="appointment_status" id="appointment_status" class="form-control">
                <option value="">اختر</option>
                <option value="pending" {{ $appointment->appointment_status == 'pending' ? 'selected' : '' }}>
                    {{ __('admin.pending') }}</option>
                <option value="confirmed" {{ $appointment->appointment_status == 'confirmed' ? 'selected' : '' }}>
                    {{ __('admin.confirmed') }}</option>
                <option value="cancelled" {{ $appointment->appointment_status == 'cancelled' ? 'selected' : '' }}>
                    {{ __('admin.cancelled') }}</option>
                <option value="transferred" {{ $appointment->appointment_status == 'transferred' ? 'selected' : '' }}>
                    {{ __('admin.transferred') }}</option>
                <option value="examined" {{ $appointment->appointment_status == 'examined' ? 'selected' : '' }}>
                    {{ __('admin.examined') }}</option>
            </select>
            @error('appointment_status')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-4 ">
            <label for="appointment_time" class="small-label mb-2">{{ __('Period') }}</label>
            <select wire:model="appointment_duration" id="" class="form-control">
                <option value="">{{ __('admin.Period') }}</option>
                <option value="morning">{{ __('admin.morning') }}</option>
                @if (setting()->evening_status == 1)
                <option value="evening">{{ __('admin.evening') }}</option>
                @endif
            </select>

        </div>

        <div class="col-md-4 d-flex flex-column justify-content-end">
            <label for="appointment_date" class="small-label mb-2">{{ __('admin.appointment_date') }}</label>
            <input type="date" wire:model="appointment_date" id="appointment_date" class="form-control">

        </div>
        <div class="col-md-4 ">
            <label for="appointment_time" class="small-label mb-2">{{ __('admin.appointment_time') }}</label>
            <select wire:model="appointment_time" id="" class="form-control">
                <option value="">{{ __('admin.appointment_time') }}</option>
                @foreach ($times as $time)
                @if (!in_array($time, $reservedTimes))
                <option value="{{ $time }}">{{ date('G:iA', strtotime($time)) }}</option>
                @endif
                @endforeach
                <!-- <input type="time" wire:model="appointment_time" id="appointment_time" class="form-control"> -->
            </select>
        </div>
        <div class="col-md-4 d-flex flex-column justify-content-center">
            <label for="appointment_date" class="small-label mb-2">مراجعة

                <input type="checkbox" wire:model.defer="review" id="review" class="">
            </label>

        </div>

        <div class="col-4 d-flex justify-content-center col-md-12">
            <button type="submit" wire:click="save" class="btn btn-sm btn-success w-50">{{ __('admin.save') }}</button>
        </div>
    </div>
    {{-- Because she competes with no one, no one can compete with her. --}}


    @push('js')
    <script>
        window.livewire.on('unpaid', () => {
            var myModal = new bootstrap.Modal(document.getElementById("unpaid_invoice"), {});
            myModal.show();
        });

    </script>
    @endpush

    @push('js')
    <script>
        window.livewire.on('partiallyPaid', () => {
            var myModal = new bootstrap.Modal(document.getElementById("partiallyPaid_invoice"), {});
            myModal.show();
        });

    </script>
    @endpush

</div>
