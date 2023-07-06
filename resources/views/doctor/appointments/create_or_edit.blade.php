<div>
    <x-alert></x-alert>
    <button wire:click="$set('screen','index')" class="btn-main-sm mb-3 ">
        {{ __('admin.Appointments') }}</button>
    <div class="row g-3">
        <div class="col-md-4 ">
            <label for="" class="small-label">{{ __('admin.Patient file number or ID number') }}</label>
            <input type="text" wire:model="patient_key" class="form-control w-100" wire:keyup='get_patient' />

        </div>
        <div class="col-md-4">
            <label for="" class="small-label">{{ __('admin.patient') }}</label>
            <input type="text" value="{{ $patient ? $patient->name : '' }}" readonly id="" class="form-control w-100" />
        </div>
        @can('رؤية جوال المريض')
        <div class="col-md-4">
            <label for="" class="small-label">{{ __('admin.phone') }}</label>
            <input type="tel" value="{{ $patient ? $patient->phone : '' }}" readonly id="" class="form-control w-100" />
        </div>
        @endcan

        <div class="col-md-6">
            <label for="clinic_id" class="mb-2">{{__('admin.clinic')}}</label>
            <select wire:model="clinic_id" id="clinic_id" class="main-select w-100">
                <option>{{ __('Choose a clinic')}}</option>
                @foreach(\App\Models\Department::all() as $clinic)
                <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                @endforeach
            </select>

        </div>
        {{-- <div class="col-md-4 ">--}}
        {{-- <label for="appointment_status">{{__('admin.appointment_status')}}</label>--}}
        {{-- <select name="appointment_status" wire:model="appointment.appointment_status" id="appointment_status" class="form-control">--}}
        {{-- <option value="{{__('admin.pending')}}">{{__('admin.pending')}}</option>--}}
        {{-- <option value="{{__('admin.confirmed')}}">{{__('admin.confirmed')}}</option>--}}
        {{-- <option value="{{__('admin.canceled')}}">{{__('admin.canceled')}}</option>--}}
        {{-- </select>--}}

        {{-- </div>--}}

        <div class="col-md-6 ">
            <label for="appointment_date" class="mb-2">{{__('admin.appointment_date')}}</label>
            <input type="date" name="appointment_date" wire:model="appointment_date" id="appointment_date" class="form-control">

        </div>
        <div class="col-md-6 ">
            <label for="appointment_date" class="mb-2">{{__('Period')}}</label>
            <select wire:model="appointment_duration" class="form-control">
                <option value="">{{ __('admin.Period') }}</option>
                <option value="morning">{{ __('admin.morning') }}</option>
                @if(setting()->evening_status)
                <option value="evening">{{ __('admin.evening') }}</option>
                @endif
            </select>

        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center mb-3">
                <label for="appointment_time" class="small-label ">{{__('admin.appointment_time')}}</label>
                <div class="alert alert-warning resize_ale mb-0 me-3" role="alert">
                    {{ __('You can shade more than one patient appointment')}}
                </div>
            </div>
            <select wire:model.defer="appointment_time" id="" class="form-control appointment_time" multiple>
                <option value="">{{ __('admin.appointment_time') }}</option>
                @foreach($times as $time)
                @if(!in_array($time,$reservedTimes))
                <option value="{{$time}}">{{date("g:iA", strtotime($time))}}</option>
                @endif
                @endforeach
                <!-- <input type="time" wire:model="appointment_time" id="appointment_time" class="form-control"> -->
            </select>
        </div>

        {{-- <div class="col-md-4 ">
            <label for="appointment_time" class="mb-2">{{__('admin.appointment_time')}}</label>
        <input type="time" name="appointment_time" wire:model="appointment_time" id="appointment_time" class="form-control">

    </div> --}}
    <div class="col-12 d-flex align-items-end">
        <button wire:click="submit" class="btn btn-sm btn-success w-100">{{__('Save')}}</button>
    </div>
</div>
{{-- Because she competes with no one, no one can compete with her. --}}


</div>
