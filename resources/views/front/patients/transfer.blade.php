<div class="modal fade" id="trans" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div id="prt-contenst" class="modal-content">
            <div class="modal-header">
                @if ($trans_patient)
                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ __('Transfer of the patient') }}
                    {{ $trans_patient->name }}
                    {{ __('to the doctor') }}
                </h5>


            </div>
            @endif

            <div class="modal-body">
                <input name="employee_id" type="hidden" value="{{ auth()->id() }}">
                <div class="d-flex gap-3 align-items-center mt-3 ">
                    <small class="ms-2">
                        {{ __('Date') }} :
                        <span class="text-main-color">{{ date('Y-m-d') }}</span>
                    </small>
                    <small class="ms-2">
                        {{ __('Day') }} :
                        <span class="text-main-color">{{ Carbon::now()->translatedFormat('D') }}</span>
                    </small>
                    <small>
                        {{ __('Hour') }} :
                        <span class="text-main-color">{{ date('H:i') }}</span>
                    </small>
                </div>
                <hr />
                <p class="mb-3">{{ __('Direct Doctor Transfer') }}</p>
                @if ($trans_patient)
                @if ($trans_patient->invoices()->unpaid()->count() > 0)
                <div class=" px-3  mb-2 alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="me-4 mb-0 d-flex align-items-center gap-2 ">
                            يوجد لدى المريض فواتير غير مسددة
                            <i class="fa-solid fa-triangle-exclamation fa-fade fa-lg" style="--fa-animation-duration: 2s;"></i>

                        </p>
                        <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                @if ($trans_patient->invoices()->PartiallyPaid()->count() > 0)
                <div class=" px-3  mb-2 alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="me-4 mb-0 d-flex align-items-center gap-2 ">
                            يوجد لدى المريض فواتير مسددة جزئياً
                            <i class="fa-solid fa-triangle-exclamation fa-fade fa-lg" style="--fa-animation-duration: 2s;"></i>

                        </p>
                        <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif
                @endif
                {{--
                <livewire:select-doctor-for-transfer /> --}}
                <div class="row g-3">
                    <div class="col-md-4 text-end">
                        <label class="small-label mb-2" for=""> {{ __('Clinic') }} </label>
                        <select wire:model="clinic_id" class="main-select w-100 trans-select-color" id="">
                            <option value="">{{ __('admin.Clinic') }}</option>
                            @foreach (\App\Models\Department::whereTransferstatus(1)->get() as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 text-end">
                        <label class="small-label mb-2" for=""> {{ __('the Doctor') }} </label>
                        <select wire:model="doctor_id" class="main-select w-100 trans-select-color" id="">
                            <option value="">{{ __('admin.dr') }}</option>
                            @foreach (\App\Models\Doctor::query()->where('department_id', $clinic_id)->get() as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 text-end">
                        <label for="appointment_date" class="mb-2 small-label">{{ __('Period') }}</label>
                        <select wire:model="appointment_duration" class="main-select w-100 trans-select-color">
                            <option value="">{{ __('admin.Period') }}</option>
                            <option value="morning">{{ __('admin.morning') }}</option>
                            @if(setting()->evening_status)
                            <option value="evening">{{ __('admin.evening') }}</option>
                            @endif
                        </select>

                    </div>
                    <div class="col-sm-3 text-end">
                        <label class="small-label" for=""> {{ __('waiting number') }} </label>
                        <input type="number" value="{{ $waiting }}" readonly class="form-control">
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                <button wire:click="submit_transfer({{ setting()->active_transfer_print }})" class="btn-main-sm px-5" data-bs-dismiss="modal">{{ __('transfer') }}</button>
            </div>
        </div>
    </div>
</div>
