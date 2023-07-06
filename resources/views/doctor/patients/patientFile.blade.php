@extends('doctor.layouts.index')
@section('title')
    {{ __('admin.Patient files') }} | {{ $patient->name }}
@endsection


@push('css')
    <style>
        .medical-information .data-content {
            max-height: inherit !important;
        }

        .medical-information .more-info::after {
            content: '';
        }
    </style>
@endpush

@section('content')
    <section class="getHeight py-5">
        <div class="container">
            <div class="section_content bg-white shadow rounded-3 p-3">
                <div class="print-btn btn btn-sm btn-warning mb-3" id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                </div>
                <div id="prt-content" class="patientFile">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="fild-control mb-3">
                                <label for="" class="small-label">{{ __('admin.Civil number (10 digits)') }}</label>
                                <input type="text" id="Patient-id" class="form-control Patient-id" disabled
                                    value="{{ $patient->civil }}" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fild-control mb-3">
                                <label for="" class="small-label">{{ __('admin.name') }}</label>
                                <input type="text" id="Patient-name" class="form-control Patient-name" disabled
                                    value="{{ $patient->name }}" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fild-control mb-3">
                                <label for="" class="small-label">{{ __('admin.phone') }}</label>
                                <input type="tel" id="Patient-phone" class="form-control Patient-phone" disabled
                                    value="{{ $patient->phone }}" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fild-control mb-3">
                                <label for="" class="small-label">{{ __('admin.Gender') }}</label>
                                <select class="gender form-control " disabled id="gender">
                                    <option value=""></option>
                                    <option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>
                                        {{ __('admin.male') }}</option>
                                    <option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>
                                        {{ __('admin.female') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fild-control mb-3">
                                <label for="" class="small-label">{{ __('City') }}</label>
                                <input type="text" class="form-control" disabled value="{{ $patient->city->name }}" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fild-control mb-3">
                                <label for="" class="small-label">{{ __('admin.Hijri date of birth') }}</label>
                                <input type="text" class="birh-date form-control" value="{{ $patient->birthdate }}"
                                    id="birh-date" disabled />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fild-control mb-3">
                                <label for="" class="small-label">{{ __('admin.Age') }}</label>
                                <input type="number" id="age" value="{{ $patient->age }}" class="age form-control"
                                    disabled />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fild-control mb-3">
                                <label for="" class="small-label">{{ __('admin.Country') }}</label>
                                <input disabled type="text" class="form-control" disabled
                                    value="{{ $patient->country->name }}" />

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="fild-control mb-3">
                                <label for="" class="small-label">{{ __('File opening date') }}</label>
                                <input disabled type="text" class="form-control" disabled
                                    value="{{ $patient->created_at->isoFormat('D-MM-Y') }}" />

                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="small-label">{{ __('attached file') }}</label>
                            <div class="fild-control mb-3">
                                @if ($patient->files)
                                    @foreach ($patient->files as $file)
                                        <div>
                                            <a class="btn-sm btn-btn-success"
                                                href="{{ $file->file_path }}">{{ $file->file_name }}</a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                        <div class="col-md-3 check">
                            <div class="fild-control mb-3">
                                <input type="checkbox" {{ $patient->insurance ? 'checked' : '' }} id="patinet-file"
                                    class="" disabled />
                                <label for="" class="small-label">{{ __('admin.Is the patient insured?') }}</label>
                            </div>
                        </div>
                        <div class="col-md-3 check">
                            <div class="fild-control mb-3">
                                <input disabled type="checkbox" id="patinet-file" class=""
                                    {{ $patient->sugar ? 'checked' : '' }} />
                                <label for=""
                                    class="small-label">{{ __('admin.Diabetes or does a family member suffer from it?') }}</label>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end check">
                            <div class="fild-control mb-3">
                                <input disabled type="checkbox" id="patinet-file" class=""
                                    {{ $patient->is_pregnant == 1 ? 'checked' : '' }} />
                                <label for="">{{ __('Is the patient pregnant?') }}</label>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end check">
                            <div class="fild-control mb-3">
                                <input disabled type="checkbox" id="patinet-file" class=""
                                    {{ $patient->pressure ? 'checked' : '' }} />
                                <label for="">{{ __('High or low blood pressure?') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="medical-information">
                        <button class="more-info border-0 w-100 rounded-3 position-relative text-end">
                            {{ __('admin.Medical information about the patient') }}
                        </button>
                        <div class="data-content" wire:ignore.self>
                            <div wire:ignore.self>
                                <p> {{ __('admin.Are you allergic to penicillin or other medicines?') }} </p>
                                <div class="radioarea d-flex">
                                    <label class="radio-inline ms-2">
                                        <input disabled type="radio" wire:model="penicillin"
                                            id="sensitivity_penicillin1" value="1"
                                            {{ $patient->penicillin == 1 ? 'checked' : '' }} />
                                        <span>{{ __('admin.Yes') }}</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input disabled type="radio" wire:model="penicillin"
                                            id="sensitivity_penicillin2" value="0"
                                            {{ $patient->penicillin == 0 ? 'checked' : '' }} />
                                        <span>{{ __('admin.No') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <p> {{ __('admin.Have you ever had problems during and after dental treatment?') }}</p>
                                <div class="radioarea d-flex">
                                    <label class="radio-inline ms-2">
                                        <input disabled type="radio" wire:model="teeth_problems"
                                            id="sensitivity_penicillin1" value="1"
                                            {{ $patient->teeth_problems == 1 ? 'checked' : '' }} />
                                        <span>{{ __('admin.Yes') }}</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input disabled type="radio" wire:model="teeth_problems"
                                            id="sensitivity_penicillin2" value="0"
                                            {{ $patient->teeth_problems == 0 ? 'checked' : '' }} />
                                        <span>{{ __('admin.No') }}</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <p> {{ __('admin.Are you currently taking medication?') }}</p>
                                <div class="radioarea d-flex">
                                    <label class="radio-inline ms-2">
                                        <input disabled type="radio" wire:model="drugs" id="sensitivity_penicillin1"
                                            value="1" {{ $patient->drugs == 1 ? 'checked' : '' }} />
                                        <span>{{ __('admin.Yes') }}</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input disabled type="radio" wire:model="drugs" id="sensitivity_penicillin2"
                                            value="0" {{ $patient->drugs == 0 ? 'checked' : '' }} />
                                        <span>{{ __('admin.No') }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="wrapper">
                            <div class="parent">
                                <button class="more-info border-0 w-100 rounded-3 position-relative text-end">
                                    {{ __('admin.Notes on the health record') }}
                                </button>
                                <div class="data-content">
                                    <div class="pt-0">
                                        <textarea style="min-height: 100px;" disabled class="addnote form-control" wire:model.defer="notes_health_record"
                                            placeholder="{{ __('admin.Notes on the health record') }}" id=""> {{ $patient->notes_health_record }}
                                    </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="parent">
                                <button class="more-info border-0 w-100 rounded-3 position-relative text-end">
                                    {{ __('admin.the purpose from the visit') }}
                                </button>
                                <div class="data-content">
                                    <div class="pt-0">
                                        <textarea disabled class="addnote form-control" wire:model.defer="goal_of_visit"
                                            placeholder="{{ __('purpose of the visit') }}" id="" style="min-height: 200px;">{{ $patient->goal_of_visit }}
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="more-info border-0 w-100 rounded-3 position-relative text-end">
                            {{ __('admin.Have you ever had or currently suffer from?') }}
                        </button>
                        <div class="data-content" wire:ignore.self>
                            <div wire:ignore.self>
                                <div>
                                    <p>{{ __('admin.heart disease?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label class="radio-inline ms-2">
                                            <input type="radio" disabled wire:model="heart"
                                                id="sensitivity_penicillin1" value="1"
                                                {{ $patient->heart == 1 ? 'checked' : '' }} />
                                            <span>{{ __('admin.Yes') }}</span>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" disabled wire:model="heart"
                                                id="sensitivity_penicillin2" value="0"
                                                {{ $patient->heart == 0 ? 'checked' : '' }} />
                                            <span>{{ __('admin.No') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <p>{{ __('admin.Rheumatic fever?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label class="radio-inline ms-2">
                                            <input type="radio" disabled wire:model="fever"
                                                id="sensitivity_penicillin1" value="1"
                                                {{ $patient->fever == 1 ? 'checked' : '' }} />
                                            <span>{{ __('admin.Yes') }}</span>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" disabled wire:model="fever"
                                                id="sensitivity_penicillin2" value="0"
                                                {{ $patient->fever == 0 ? 'checked' : '' }} />
                                            <span>{{ __('admin.No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <p>{{ __('admin.Anemia and other blood diseases?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label class="radio-inline ms-2">
                                            <input type="radio" disabled wire:model="anemia"
                                                id="sensitivity_penicillin1" value="1"
                                                {{ $patient->anemia == 1 ? 'checked' : '' }} />
                                            <span>{{ __('admin.Yes') }}</span>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" disabled wire:model="anemia"
                                                id="sensitivity_penicillin2" value="0"
                                                {{ $patient->anemia == 0 ? 'checked' : '' }} />
                                            <span>{{ __('admin.No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <p>{{ __('admin.Thyroid disease?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label class="radio-inline ms-2">
                                            <input type="radio" wire:model="thyroid_glands"
                                                id="sensitivity_penicillin1" value="1" disabled
                                                {{ $patient->thyroid_glands == 1 ? 'checked' : '' }} />
                                            <span>{{ __('admin.Yes') }}</span>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" wire:model="thyroid_glands"
                                                id="sensitivity_penicillin2" value="0" disabled
                                                {{ $patient->thyroid_glands == 0 ? 'checked' : '' }} />
                                            <span>{{ __('admin.No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <p>
                                        {{ __('admin.Bile - hepatitis or any other liver disease?') }}
                                    </p>
                                    <div class="radioarea d-flex">
                                        <label class="radio-inline ms-2">
                                            <input type="radio" wire:model="liver" id="sensitivity_penicillin1"
                                                value="1" disabled {{ $patient->liver == 1 ? 'checked' : '' }} />
                                            <span>{{ __('admin.Yes') }}</span>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" wire:model="liver" id="sensitivity_penicillin2"
                                                value="0" disabled {{ $patient->liver == 0 ? 'checked' : '' }} />
                                            <span>{{ __('admin.No') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <p>{{ __('admin.Asthma - tuberculosis - or trouble breathing?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label class="radio-inline ms-2">
                                            <input type="radio" wire:model="tb" id="sensitivity_penicillin1"
                                                value="1" disabled {{ $patient->tb == 1 ? 'checked' : '' }} />
                                            <span>{{ __('admin.Yes') }}</span>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" wire:model="tb" id="sensitivity_penicillin2"
                                                value="0" disabled {{ $patient->tb == 0 ? 'checked' : '' }} />
                                            <span>{{ __('admin.No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <p>{{ __('admin.Kidney disease?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label class="radio-inline ms-2">
                                            <input type="radio" wire:model="kidneys" id="sensitivity_penicillin1"
                                                value="1" disabled {{ $patient->kidneys == 1 ? 'checked' : '' }} />
                                            <span>{{ __('admin.Yes') }}</span>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" wire:model="kidneys" id="sensitivity_penicillin2"
                                                value="0" disabled {{ $patient->kidneys == 0 ? 'checked' : '' }} />
                                            <span>{{ __('admin.No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <p>{{ __('admin.Cramping, conflict, or fainting?') }}</p>
                                    <div class="radioarea d-flex">
                                        <label class="radio-inline ms-2">
                                            <input type="radio" wire:model="convulsion" id="sensitivity_penicillin1"
                                                value="1" disabled
                                                {{ $patient->convulsion == 1 ? 'checked' : '' }} />
                                            <span>{{ __('admin.Yes') }}</span>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" wire:model="convulsion" id="sensitivity_penicillin2"
                                                value="0" disabled
                                                {{ $patient->convulsion == 0 ? 'checked' : '' }} />
                                            <span>{{ __('admin.No') }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="holder">
                                    <div class="py-0 special">
                                        <label class="mb-2">{{ __('admin.other diseases') }}</label>
                                        <textarea class="addnote form-control" disabled wire:model.defer="other_diseases"
                                            placeholder="{{ __('admin.other diseases') }}" id="" style="min-height: 200px">{{ $patient->other_diseases }}
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <button class="more-info border-0 w-100 rounded-3 position-relative text-end">
                            {{ __('admin.Patient files') }}
                        </button>

                        <div class="table-responsive mt-3">
                            <table class="table main-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('admin.name') }}</th>
                                        <th>{{ __('admin.Hour') }}</th>
                                        <th>{{ __('admin.Date') }}</th>
                                        <th>النوع</th>
                                        <th>{{ __('admin.Uploaded by') }}</th>
                                        <th>{{ __('admin.file') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patient->files as $file)
                                        <tr>
                                            <td>{{ $file->id }}</td>
                                            <td>{{ $file->file_name }}</td>
                                            <td>{{ $file->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $file->created_at->toTimeString() }}</td>
                                            <td>
                                                @if ($file->type == 'medical_files')
                                                    ملف طبي
                                                @elseif($file->type == 'sick_leave')
                                                    اجازة مرضية
                                                @else
                                                    وصفة طبية
                                                @endif
                                            </td>
                                            <td>{{ $file->employee->name }}</td>
                                            <td>
                                                <a href="{{ display_file($file->file_path) }}" download=""
                                                    class="btn btn-purple btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>



                        <button class="more-info border-0 w-100 rounded-3 position-relative text-end">
                            {{ __('admin.Patient diagnoses') }}
                        </button>
                        <div class="data-content" wire:ignore.self>
                            <div wire:ignore.self>
                                <div class="table-responsive">
                                    <table class="table main-table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('admin.Patient') }}</th>
                                                <th>{{ __('admin.dr') }}</th>
                                                <th>{{ __('admin.Hour') }}</th>
                                                <th>{{ __('admin.Day') }}</th>
                                                <th>{{ __('admin.Period') }}</th>
                                                <th>{{ __('admin.Clinic') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($patient->diagnoses as $diagnose)
                                                <tr>
                                                    <td>{{ $patient->name }}</td>
                                                    <td>{{ $diagnose->dr->name }}</td>
                                                    <td>{{ $diagnose->time }}</td>
                                                    <td>{{ $diagnose->day }}</td>
                                                    <td>{{ __($diagnose->period) }}</td>
                                                    <td>{{ $diagnose->department->name }}</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="6">
                                                        <div class="p-3">
                                                            <div class="row row-gap-24">
                                                                <div class="col-12">
                                                                    <label for="diagnosis"
                                                                        class="option-name mb-2">{{ __('admin.Diagnose') }}
                                                                        :</label>
                                                                    <textarea readonly class="w-100 form-control" id="diagnosis">{{ $diagnose->treatment }}</textarea>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="action-taken"
                                                                        class="option-name mb-2">{{ __('admin.Action taken') }}
                                                                        :</label>
                                                                    <textarea readonly class="w-100 form-control" id="action-taken">{{ $diagnose->taken }}</textarea>
                                                                </div>
                                                                @if ($diagnose->tooth)
                                                                    <div class="col-12">
                                                                        <label for="action-taken"
                                                                            class="option-name mb-2">{{ __('admin.Tooth') }}
                                                                            :</label>
                                                                        <textarea readonly class="w-100 form-control" id="action-taken">
                                                                        @if (is_array($diagnose->tooth))
@foreach ($diagnose->tooth as $tooth)
{{ $tooth . ',' }}
@endforeach
@else
{{ $diagnose->tooth }}
@endif
                                                                    </textarea>
                                                                    </div>
                                                                @endif
                                                                @if ($diagnose->body)
                                                                    <div class="d-flex align-items-center ">
                                                                        <div class="content-section p-3">
                                                                            <div class="header mb-3">
                                                                                <div class="row">
                                                                                    <div class="col-1 px-0">
                                                                                        <div class="right-side text-start">
                                                                                            <img src="{{ asset('img/human/right_side.png') }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-1 px-0">
                                                                                        <div class="left-side">
                                                                                            <img src="{{ asset('img/human/left_side.png') }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="body">
                                                                                <div class="row">
                                                                                    <div class="col-4 ">
                                                                                        <div class="body-front text-start">
                                                                                            <img src="{{ asset('img/human/body-back.png') }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-4 ">
                                                                                        <div class="body-back">
                                                                                            <img src="{{ asset('img/human/body-front.png') }}"
                                                                                                alt="">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <hr class="line">
                                                                            <div
                                                                                class="inputs_holder d-flex aling-items-center gap-2 mb-2">


                                                                                @for ($i = 1; $i < 8; $i++)
                                                                                    <div class="inp_holder text-center">
                                                                                        <!-- <label for="" class="small-label">{{ $i }}</label> -->
                                                                                        <input type="text"
                                                                                            value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                                                            disabled
                                                                                            class="inp-blue form-control">
                                                                                    </div>
                                                                                @endfor

                                                                            </div>
                                                                            <div
                                                                                class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                                                                @for ($i = 8; $i < 15; $i++)
                                                                                    <div class="inp_holder text-center">
                                                                                        <!-- <label for="" class="small-label">{{ $i }}</label> -->
                                                                                        <input type="text" disabled
                                                                                            value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                                                            class="inp-blue form-control">
                                                                                    </div>
                                                                                @endfor
                                                                            </div>
                                                                            <div
                                                                                class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                                                                @for ($i = 15; $i < 22; $i++)
                                                                                    <div class="inp_holder text-center">
                                                                                        <!-- <label for="" class="small-label">{{ $i }}</label> -->
                                                                                        <input type="text" disabled
                                                                                            value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                                                            class="inp-blue form-control">
                                                                                    </div>
                                                                                @endfor
                                                                            </div>
                                                                            <div
                                                                                class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                                                                @for ($i = 22; $i < 29; $i++)
                                                                                    <div class="inp_holder text-center">
                                                                                        <!-- <label for="" class="small-label">{{ $i }}</label> -->
                                                                                        <input type="text" disabled
                                                                                            value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                                                            class="inp-blue form-control">
                                                                                    </div>
                                                                                @endfor
                                                                            </div>

                                                                            <div
                                                                                class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                                                                @for ($i = 29; $i < 36; $i++)
                                                                                    <div class="inp_holder text-center">
                                                                                        <!-- <label for="" class="small-label">{{ $i }}</label> -->
                                                                                        <input type="text" disabled
                                                                                            value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                                                            class="inp-blue form-control">
                                                                                    </div>
                                                                                @endfor
                                                                            </div>

                                                                            <div
                                                                                class="inputs_holder d-flex aling-items-center gap-2 mb-2">
                                                                                @for ($i = 36; $i < 39; $i++)
                                                                                    <div class="inp_holder text-center">
                                                                                        <!-- <label for="" class="small-label">{{ $i }}</label> -->
                                                                                        <input type="text" disabled
                                                                                            value="{{ isset($diagnose->body[$i]) ? $diagnose->body[$i] : '' }}"
                                                                                            class="inp-blue form-control">
                                                                                    </div>
                                                                                @endfor
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('js')
        {{--  <script>
            const moreInfoBtn = document.querySelectorAll(".more-info");
            if (moreInfoBtn) {
                moreInfoBtn.forEach((ele) => {
                    ele.addEventListener("click", (e) => {
                        e.target.classList.toggle("active")
                        const dataContent = e.target.nextElementSibling;
                        if (dataContent.style.maxHeight) {
                            dataContent.style.maxHeight = null;
                        } else {
                            dataContent.style.maxHeight = dataContent.scrollHeight + "px";
                        }
                        e.preventDefault();
                    });
                });
            }
        </script> --}}
    @endpush
@endsection
