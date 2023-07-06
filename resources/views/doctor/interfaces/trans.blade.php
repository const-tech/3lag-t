<section class="row row-gap-24 g-2">
    <div class="col-md-4 ">
        <label for="doctor_id">{{__('admin.doctor')}}</label>
        <select name="doctor_id" wire:model="new_appointment.doctor_id" id="doctor_id" class="main-select w-100">
            <option disabled selected>{{ __('Choose a doctor')}}</option>
            @foreach(\App\Models\Doctor::all() as $doctor)
            <option value="{{$doctor->id}}">{{$doctor->name}}</option>
            @endforeach
        </select>
        @error('doctor_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-4 ">
        <label for="clinic_id">{{__('admin.clinic')}}</label>
        <select name="clinic_id" wire:model="new_appointment.clinic_id" id="clinic_id" class="main-select w-100">
            <option disabled selected>{{ __('Choose a clinic')}}</option>
            @foreach(\App\Models\Department::all() as $clinic)
            <option value="{{$clinic->id}}">{{$clinic->name}}</option>
            @endforeach
        </select>
        @error('clinic_id')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-4 ">
        <label for="appointment_time">{{__('admin.appointment_time')}}</label>
        <input type="time" name="appointment_time" wire:model="new_appointment.appointment_time" id="appointment_time"
            class="form-control">
        @error('appointment_time')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-4 ">
        <label for="appointment_date">{{__('admin.appointment_date')}}</label>
        <input type="date" name="appointment_date" wire:model="new_appointment.appointment_date" id="appointment_date"
            class="form-control">
        @error('appointment_date')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-12 d-flex justify-content-end">
        <button type="submit" wire:click="transferPatient" class="btn btn-sm trans-btn w-25">
            {{ __('transfer')}}
        </button>
    </div>
</section>
