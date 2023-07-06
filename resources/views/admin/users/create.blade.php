@extends('admin.layouts.admin')
@section('title')
    {{ __('admin.Add user') }}
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Add user') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>{{ __('admin.Add user') }}</b>
        <hr>
        <form class="row row-gap-24" action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="col-sm-6 col-md-3">
                <label for="">{{ __('admin.name') }}</label>
                <input class="form-control" type="text" name="name">
            </div>
            <div class="col-sm-6 col-md-3">
                <label class="main-lable" for="">{{ __('admin.email') }}</label>
                <input class="form-control" type="email" name="email">
            </div>
            <div class="col-sm-6 col-md-3">
                <label class="main-lable" for="">{{ __('admin.type') }}</label>
                <select class="main-select w-100" name="type" id="">
                    <option value="">{{ __('admin.select type') }}</option>
                    <option value="recep">{{ __('admin.recep') }}</option>
                    <option value="dr">{{ __('admin.dr') }}</option>
                    <option value="accountant">{{ __('admin.accountant') }}</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <label class="main-lable" for="">{{ __('admin.group') }}</label>
                <select class="main-select w-100" name="group" id="">
                    <option value="">{{ __('admin.select group') }}</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 col-md-3">
                <label class="main-lable" for="">{{ __('admin.department') }}</label>
                <select class="main-select w-100" name="department_id" id="">
                    <option value="">{{ __('admin.Choose the department') }}</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 col-md-4">
                <label class="main-lable" for="">{{ __('admin.session_duration') }}</label>
                <input class="form-control" type="text" name="session_duration">
            </div>
            <div class="col-sm-6 col-md-4">
                <label class="main-lable" for="">{{ __('admin.salary') }}</label>
                <input class="form-control" type="number" name="salary">
            </div>

            <div class="col-sm-6 col-md-3">
                <label for="">نوع النسبه</label>
                <select class="form-control" name="rate_type" id="rate_type">
                    <option {{ old('rate_type') == 'without_rate' ? 'selected' : '' }} value="without_rate">راتب بدون نسبه
                    </option>
                    <option {{ old('rate_type') == 'rating_after_salary' ? 'selected' : '' }} value="rating_after_salary">
                        نسبه بعد الراتب</option>
                    <option {{ old('rate_type') == 'rating_starting_salary' ? 'selected' : '' }}
                        value="rating_starting_salary">النسبه من البدايه</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-4 d-none" id="target">
                <label class="main-lable" for="">التارجت</label>
                <input class="form-control" type="number" step="0.1" name="target" placeholder="0"
                    value="{{ old('target') }}">
            </div>
            <div class="col-sm-6 col-md-4">
                <label class="main-lable" for="">{{ __('admin.rate') }}</label>
                <input class="form-control" type="number" name="rate" placeholder="0" value="{{ old('rate') }}">
            </div>

            <div class="col-sm-6 col-md-4">
                <label class="main-lable" for="">{{ __('admin.password') }}</label>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="alert alert-primary p-1 mb-1 fs-11">
                    يمكن تحديد الاقسام التي يمكن للموظف اصدار فواتير
                </div>
                <label class="main-lable" for="">عرض خدمات:</label>
                @foreach ($departments as $department)
                    <label for="">{{ $department->name }}</label>
                    <input class="" type="checkbox" value="{{ $department->id }}" name="show_department_products[]">
                @endforeach
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="alert alert-primary p-1 mb-1 fs-11">
                    في حال كان الموظف طبيب اسنان يتم اختيار الحقل ليظهر صورة تشخيص الاسنان
                </div>
                <label class="main-lable" for="">هل هو طبيب أسنان؟</label>
                <input class="" type="checkbox" value="1" name="is_dentist">
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="alert alert-primary p-1 mb-1 fs-11">
                    في حال كان الموظف طبيب جلدية يتم اختيار الحقل ليظهر صورة تشخيص الجسم
                </div>
                <label class="main-lable" for="">هل هو طبيب جلدية؟</label>
                <input class="" type="checkbox" value="1" name="is_dermatologist">
            </div>

            <div class="col-12 mt-5 text-center">
                <button class="btn btn-primary">{{ __('admin.Add') }}</button>
            </div>
        </form>
    </div>

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
            $('#rate_type').change(function() {
                if ($(this).val() == 'rating_after_salary') {
                    $('#target').removeClass('d-none');
                } else {
                    $('#target').addClass('d-none');
                }
            })
        </script>
    @endpush
@endsection
