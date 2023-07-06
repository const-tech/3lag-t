<div class="modal fade " id="modal-repeat-{{$patient->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
    <x-alert></x-alert>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ __('Transfer of the patient')}}
                    {{$patient->name }}
                    {{ __('to the doctor')}}
                </h5>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input name="employee_id" type="hidden" value="{{auth()->id()}}">
                <div class="d-flex gap-3 align-items-center mt-3 ">
                    <small class="ms-2">
                        {{ __('Date')}} :
                        <span class="text-main-color">{{date('Y-m-d')}}</span>
                    </small>
                    <small class="ms-2">
                        {{ __('Day')}} :
                        <span class="text-main-color">{{Carbon::now()->translatedFormat("D")}}</span>
                    </small>
                    <small>
                        {{ __('Hour')}} :
                        <span class="text-main-color">{{date('H:i')}}</span>
                    </small>
                </div>
                <hr />
                <p class="mb-3">{{ __('Direct Doctor Transfer')}}</p>
                {{--
                    <livewire:select-doctor-for-transfer /> --}}
                <div class="row g-3">
                    <div class="col-md-4 text-end">
                        <label class="small-label mb-2" for=""> {{ __('Clinic')}} </label>
                        <select wire:model="clinic_id" class="main-select w-100 trans-select-color" id="">
                            <option value="">{{ __('admin.Clinic') }}</option>
                            @foreach(\App\Models\Department::all() as
                            $department)
                            <option value="{{$department->id}}">
                                {{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 text-end">
                        <label class="small-label mb-2" for=""> الطبيب </label>
                        <select wire:model="doctor_id" class="main-select w-100 trans-select-color" id="">
                            <option value="">{{ __('admin.dr') }}</option>
                            @foreach(\App\Models\Doctor::query()->where('department_id',$clinic_id)->get()
                            as $doctor)
                            <option value="{{$doctor->id}}">{{$doctor->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 text-end">
                        <label for="appointment_date" class="mb-2 small-label">{{__('Period')}}</label>
                        <select wire:model="appointment_duration" class="main-select w-100 trans-select-color">
                            <option value="">{{ __('admin.Period') }}</option>
                            <option value="morning">{{ __('admin.morning') }}</option>
                            @if(setting()->evening_status)
                            <option value="evening">{{ __('admin.evening') }}</option>
                            @endif
                        </select>

                    </div>
                    <div class="col-sm-3 text-end">
                        <label class="small-label" for=""> {{ __('waiting number')}} </label>
                        <input type="number" value="{{ $waiting }}" readonly class="form-control">
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn-main-sm">تحويل
                    وطباعة</button>--}}
                <button wire:click="transfer({{$patient}})" class="btn-main-sm px-5">{{ __('transfer')}}</button>
            </div>
        </div>
    </div>
</div>
