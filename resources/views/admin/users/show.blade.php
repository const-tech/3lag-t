@extends('admin.layouts.admin')
@section('title')
    {{ __('admin.Show user') }}
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Show user') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>{{ __('admin.Show user') }}</b>
        <hr>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.name') }}</label>
                <input disabled class="form-control" type="text" name="name" value="{{ $user->name }}">
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.email') }}</label>
                <input disabled class="form-control" type="email" name="email" value="{{ $user->email }}">
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.type') }}</label>
                <input disabled class="form-control" type="text" name="session_duration" value="{{ __($user->type) }}">
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.group') }}</label>
                <input disabled class="form-control" type="text" name="session_duration" value="{{ $user->role?->name }}">
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.department') }}</label>
                <input disabled class="form-control" type="text" name="session_duration" value="{{ $user->department?->name }}">
            </div>

            <div class="col-sm-6 col-md-4">
                <label class="main-lable" for="">{{ __('admin.session_duration') }}</label>
                <input disabled class="form-control" type="text" name="session_duration" value="{{ $user->session_duration }}">
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.salary') }}</label>
                <input disabled class="form-control" type="number" name="salary" value="{{ $user->salary }}">
            </div>


            <div class="col-sm-6 col-md-3">
                <label for="">نوع النسبه</label>
                <select disabled class="form-control" name="rate_type" id="rate_type">
                    <option {{ $user->rate_type == 'without_rate' ? 'selected' : '' }} value="without_rate">راتب بدون نسبه
                    </option>
                    <option {{ $user->rate_type == 'rating_after_salary' ? 'selected' : '' }} value="rating_after_salary">
                        نسبه بعد الراتب</option>
                    <option {{ $user->rate_type == 'rating_starting_salary' ? 'selected' : '' }}
                        value="rating_starting_salary">النسبه من البدايه</option>
                </select>
            </div>

            <div class="col-sm-6 col-md-4 {{ $user->rate_type == 'rating_after_salary' ? '' : 'd-none' }}" id="target">
                <label class="main-lable" for="">التارجت</label>
                <input disabled class="form-control" type="number" step="0.1" name="target" placeholder="0"
                    value="{{ $user->target }}">
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.rate') }}</label>
                <input disabled class="form-control" type="number" name="rate" value="{{ $user->rate }}">
            </div>

            <div class="col-sm-6 col-md-4">
                <label class="main-lable" for="">عرض خدمات:</label>
                @foreach ($departments as $department)
                    <label for="">{{ $department->name }}</label>
                    <input disabled {{ in_array($department->id, $user->show_department_products ?? []) ? 'checked' : '' }}
                        type="checkbox" value="{{ $department->id }}" name="show_department_products[]">
                @endforeach
            </div>
            <div class="col-sm-6 col-md-4">
                <label class="main-lable" for="">هل هو طبيب أسنان؟</label>
                <span>{{ $user->is_dentist?__('admin.Yes'):__('admin.No') }}</span>
            </div>
            <div class="col-sm-6 col-md-4">
                <label class="main-lable" for="">هل هو طبيب جلدية؟</label>
                <span>{{ $user->is_dermatologist?__('admin.Yes'):__('admin.No') }}</span>
            </div>


    </div>
@endsection
