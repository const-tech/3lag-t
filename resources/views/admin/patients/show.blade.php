@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Show patient') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3">
        <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Show patient') }}
        </li>

    </ol>
</nav>



<div class="col-12">
    <b>{{ __('admin.Edit patient') }}</b>
    <hr>
</div>
<div class=" col-sm-12">
    <label class="main-lable fs-5" for="">{{ __('admin.department') }}</label>
    <input disabled type="date" class="form-control" name="date"  value="{{ $patient->department?->name }}">

</div>
{{-- <div class="col-sm-6 col-md-4">
    <label class="main-lable" for="">
        الرقم الطبي
    </label>
    <input type="number" class="form-control" value="{{ App\Models\Patient:: }}">
</div> --}}
<div class="col-sm-6 col-md-4">
    <label class="main-lable" for="">
        {{ __('admin.The date the record was added') }}
    </label>
    <input disabled type="date" class="form-control" name="date" placeholder="{{ __('admin.The date the record was added') }}"
        value="{{ $patient->date }}">
</div>
<div class="col-sm-6 col-md-4">
    <label class="main-lable" for="">
        {{ __('admin.Civil number') }}
    </label>
    <input disabled type="number" class="form-control" name="civil" placeholder="{{ __('admin.Civil number') }}"
        value="{{ $patient->civil }}">
</div>
<div class="col-sm-6 col-md-4">
    <label class="main-lable" for="">
        {{ __('admin.phone') }}
    </label>
    <input disabled type="text" class="form-control" name="phone" placeholder="{{ __('admin.phone') }}"
        value="{{ $patient->phone }}">
</div>
<div class="col-12">
    <hr class="m-0">
</div>

<div class="col-sm-6 col-md-3">
    <label class="main-lable" for="">
        {{ __('admin.name') }}
    </label>
    <input disabled value="{{ $patient->first_name }}" type="text" class="form-control" placeholder="{{ __('admin.name') }}"
        name="first_name">
</div>
<div class="col-sm-6 col-md-3">
    <label class="main-lable" for="">
        {{ __('admin.Parent name') }}
    </label>
    <input disabled type="text" class="form-control" placeholder="{{ __('admin.Parent name') }}" name="parent_name"
        value="{{ $patient->parent_name }}">
</div>
<div class="col-sm-6 col-md-3">
    <label class="main-lable" for="">
        {{ __('admin.Grandfather name') }}
    </label>
    <input disabled type="text" class="form-control" placeholder="{{ __('admin.Grandfather name') }}" name="grand_name"
        value="{{ $patient->grand_name }}">
</div>
<div class="col-sm-6 col-md-3">
    <label class="main-lable" for="">
        {{ __('admin.Last name') }}
    </label>
    <input disabled type="text" class="form-control" placeholder="{{ __('admin.Last name') }}" name="last_name"
        value="{{ $patient->last_name }}">
</div>

<div class="col-12">
    <hr class="m-0">
</div>

<div class="col-sm-6 col-md-4">
    <label class="main-lable" for="">
        {{ __('admin.relationship') }}
    </label>
    <input disabled type="text" name="birthdate" class="form-control" id=""
        value="{{ __($patient->relationship?->name) }}">
</div>
<div class="col-sm-6 col-md-4">
    <label class="main-lable" for="">
        {{ __('admin.Gender') }}
    </label>
    <input disabled type="text" name="birthdate" class="form-control" id="" value="{{ __($patient->male) }}">
</div>
<div class="col-sm-6 col-md-4">
    <label class="main-lable" for="">
        {{ __('admin.nationality') }}
    </label>
    <input disabled type="text" name="birthdate" class="form-control" id="" value="{{ $patient->country?->name }}">
</div>

<div class="col-12">
    <hr class="m-0">
</div>

<div class="col-sm-6 ">
    <label class="main-lable" for="">
        {{ __('admin.Hijri date of birth') }}
    </label>
    <input disabled type="date" name="birthdate" class="form-control" id="" value="{{ $patient->birthdate }}">
</div>
<div class="col-sm-6 ">
    <label class="main-lable" for="">
        {{ __('admin.Age') }}
    </label>
    <input disabled type="number" name="age" placeholder="{{ __('admin.Age') }}" class="form-control" id=""
        value="{{ $patient->age }}">
</div>

<div class="col-12">
    <hr class="m-0">
</div>

<div class="col-sm-6 ">
    <div class="row row-gap-24">
        <div class="col-12">
            <label class="main-lable" for="">
                {{ __('admin.The name of a relative') }}
            </label>
            <input disabled type="text" name="near_name" placeholder="{{ __('admin.The name of a relative') }}"
                class="form-control" id="" value="{{ $patient->near_name }}">
        </div>
        <div class="col-12">
            <label class="main-lable" for="">
                {{ __('admin.The mobile of a relative') }}
            </label>
            <input disabled type="number" name="near_mobile" placeholder="{{ __('admin.The mobile of a relative') }}"
                class="form-control" id="" value="{{ $patient->near_mobile }}">
        </div>
    </div>
</div>
<div class="col-sm-6 ">
    <label class="main-lable" for="">
        {{ __('admin.Notes on the health record') }}
    </label>
    <textarea disabled class="form-control" name="notes_health_record"
        placeholder="{{ __('admin.Notes on the health record') }}" id=""
        rows="5">{{ $patient->notes_health_record }}"</textarea>
</div>

<div class="col-12">
    <hr class="m-0">
</div>

<div class="col-sm-6 ">
    <div class="row row-gap-24">
        <div class="col-12">
            <label class="main-lable" for="">
                {{ __('admin.Are you allergic to penicillin or other medicines?') }}
            </label>
            <span>{{ $patient->penicillin==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-12">
            <label class="main-lable" for="">
                {{ __('admin.Have you ever had problems during and after dental treatment?') }}
            </label>
            <span>{{ $patient->teeth_problems==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-12">
            <label class="main-lable" for="">
                {{ __('admin.Are you currently taking medication?') }}
            </label>
            <span>{{ $patient->drugs==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-sm-6 ">
            <label class="main-lable" for="">
                {{ __('admin.the purpose from the visit') }}
            </label>
            <textarea disabled class="form-control" name="goal_of_visit" id="" rows="9"
                placeholder="{{ __('admin.the purpose from the visit') }}">{{ $patient->goal_of_visit }}</textarea>
        </div>

        <div class="col-12">
            <hr class="m-0">
        </div>

        <div class="col-md-12 text-center mt-3">
            <h5 class="mx-auto w-fit line-bottom-blue mb-4"> {{ __('admin.Have you ever had or currently suffer from?')
                }}</h5>
        </div>

        <div class="col-sm-6">
            <label class="main-lable" for="">
                {{ __('admin.heart disease?') }}
            </label>
            <span>{{ $patient->heart==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-sm-6">
            <label class="main-lable" for="">
                {{ __('admin.High or low blood pressure?') }}
            </label>
            <span>{{ $patient->pressure==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-sm-6">
            <label class="main-lable" for="">
                {{ __('admin.Rheumatic fever?') }}
            </label>
            <span>{{ $patient->fever==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-sm-6">
            <label class="main-lable" for="">
                {{ __('admin.Anemia and other blood diseases?') }}
            </label>
            <span>{{ $patient->anemia==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-sm-6">
            <label class="main-lable" for="">
                {{ __('admin.Thyroid disease?') }}
            </label>
            <span>{{ $patient->thyroid_glands==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-sm-6">
            <label class="main-lable" for="">
                {{ __('admin.Bile - hepatitis or any other liver disease?') }}
            </label>
            <span>{{ $patient->liver==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-sm-6">
            <label class="main-lable" for="">
                {{ __('admin.Diabetes or does a family member suffer from it?') }}
            </label>
            <span>{{ $patient->sugar==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-sm-6">
            <label class="main-lable" for="">
                {{ __('admin.Asthma - tuberculosis - or trouble breathing?') }}
            </label>
            <span>{{ $patient->tb==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-sm-6">
            <label class="main-lable" for="">
                {{ __('admin.Kidney disease?') }}
            </label>
            <span>{{ $patient->kidneys==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-sm-6">
            <label class="main-lable" for="">
                {{ __('admin.Cramping, conflict, or fainting?') }}
            </label>
            <span>{{ $patient->convulsion==1?__('Yes'):__('No')}}</span>
        </div>
        <div class="col-sm-12">
            <label class="main-lable" for="">
                {{ __('admin.other diseases') }}
            </label>
            <textarea disabled name="other_diseases" placeholder="{{ __('admin.other diseases') }}" id=""
                class="form-control" rows="5">{{ $patient->other_diseases }}</textarea>
        </div>

        @endsection