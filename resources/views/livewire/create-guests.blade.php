<section class="addPatient-section py-5">
    <x-alert></x-alert>
    <div class="container">
        <div class="alert alert-warning" role="alert">
            {{ __('The service of booking an appointment for the visitor through the clinic website, and it will be delivered after any waiting for him')}}
        </div>
        <h4 class="main-heading ">{{ __('admin.Add Appointment For Guest') }}</h4>
    </div>
    <div class="container pt-0 p-3 bg-white vh-min-100 rounded-3 shadow">
        <div class="addPatient-content p-4">
            <h4 class="section-title p-3 rounded-3 mb-4 text-center">
                {{ __('admin.Personal information about the Guest') }}
            </h4>
            <form class="Patient-form-data">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="fild-control mb-3">
                            <input type="text" id="Patient-id" class="form-control Patient-id" wire:model.lazy="civil" placeholder="{{ __('admin.Civil number (10 digits)') }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="fild-control mb-3">
                            <input type="text" id="Patient-name" class="form-control Patient-name" wire:model.lazy="first_name" placeholder="{{ __('admin.name') }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="fild-control mb-3">
                            <input type="tel" id="Patient-phone" class="form-control Patient-phone" wire:model.lazy="phone" placeholder="{{ __('admin.phone') }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="fild-control mb-3">
                            <select class="gender form-control" id="gender" wire:model.lazy="gender">
                                <option value="">{{ __('admin.Gender') }}</option>
                                <option value="male">{{ __('admin.male') }}</option>
                                <option value="female">{{ __('admin.female') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="fild-control mb-3">
                            <label for="doctor_id" class="small-label mb-2">{{__('admin.doctor')}}</label>
                            <select name="doctor_id" wire:model="doctor_id" id="doctor_id" class="main-select w-100">
                                <option selected>{{ __('Choose a doctor')}}</option>
                                @foreach(\App\Models\Doctor::all() as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                @endforeach
                            </select>
                            @error('doctor_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="fild-control mb-3">
                            <label for="clinic_id" class="small-label mb-2">{{__('admin.clinic')}}</label>
                            <select name="clinic_id" wire:model="clinic_id" id="clinic_id" class="main-select w-100">
                                <option selected>{{ __('Choose a clinic')}}</option>
                                @foreach(\App\Models\Department::all() as $clinic)
                                <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                @endforeach
                            </select>
                            @error('clinic_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
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
                        {{-- @dump($reservedTimes,$appointment_duration) --}}
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
                    {{-- <div class="col-md-6">
                        <div class="fild-control mb-3">
                            <label for="appointment_time" class="small-label mb-2">{{__('admin.appointment_time')}}</label>
                    <input type="time" name="appointment_time" wire:model="appointment_time" id="appointment_time" class="form-control">
                    @error('appointment_time')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
        </div>
        <div class="col-md-6">
            <div class="fild-control mb-3">
                <label for="appointment_date" class="small-label mb-2">{{__('admin.appointment_date')}}</label>
                <input type="date" name="appointment_date" wire:model="appointment_date" id="appointment_date" class="form-control">
                @error('appointment_date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div> --}}
    </div>
    <div class="w-100 d-flex align-items-center justify-content-center mt-2">
        <button class="send-data btn btn-success w-25" wire:click.prevent='save'>حفظ البيانات</button>
    </div>
    </form>
    </div>
    </div>
</section>
