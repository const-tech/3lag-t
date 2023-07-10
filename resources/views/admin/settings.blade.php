@extends('admin.layouts.admin')
@section('title')
    {{ __('admin.Settings') }}
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Settings') }}</li>
        </ol>
    </nav>

    <form class="row row-gap-24 p-3 shadow rounded-3 bg-white w-100 mx-auto" action="{{ route('admin.settings.update') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12">
            <b>{{ __('admin.Settings') }}</b>
            <hr>
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.Site name') }}</label>
            <input type="text" name="site_name" placeholder="{{ __('admin.Site name') }}" class="form-control"
                value="{{ setting()->site_name }}">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.url') }}</label>
            <input type="url" name="url" placeholder="{{ __('admin.url') }}" class="form-control"
                value="{{ setting()->url }}">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.SMS status') }}</label>
            <select name="sms_status" id="" class="main-select w-100">
                <option value="open" {{ setting()->sms_status == 'open' ? 'selected' : '' }}>{{ __('admin.open') }}
                </option>
                <option value="close" {{ setting()->sms_status == 'close' ? 'selected' : '' }}>{{ __('admin.close') }}
                </option>
            </select>
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.phone') }}</label>
            <input type="text" name="phone" placeholder="{{ __('admin.phone') }}" class="form-control"
                value="{{ setting()->phone }}">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.SMS Username') }}</label>
            <input type="text" name="sms_username" placeholder="{{ __('admin.SMS Username') }}" class="form-control"
                value="{{ setting()->sms_username }}">
        </div>
        {{-- <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.SMS Sender') }}</label>
    <input type="text" name="sms_sender" placeholder="{{ __('admin.SMS Sender') }}" class="form-control" value="{{ setting()->sms_sender }}">
    </div>

    <div class="form-group col-sm-6 col-md-3">
        <label class="main-lable" for="">{{ __('admin.SMS Password') }}</label>
        <input type="text" name="sms_password" placeholder="{{ __('admin.SMS Password') }}" class="form-control" value="{{ setting()->sms_password }}">
    </div> --}}
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.email') }}</label>
            <input type="email" name="email" placeholder="{{ __('admin.email') }}" class="form-control"
                value="{{ setting()->email }}">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.Tax enabled') }}</label>
            <select name="tax_enabled" id="" class="main-select w-100">
                <option value="1" {{ setting()->tax_enabled == 1 ? 'selected' : '' }}>{{ __('admin.Yes') }}</option>
                <option value="0" {{ setting()->tax_enabled == 0 ? 'selected' : '' }}>{{ __('admin.لا') }}</option>
            </select>
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.Tax rate') }}</label>
            <input type="number" name="tax_rate" placeholder="{{ __('admin.Tax rate') }}" class="form-control"
                value="{{ setting()->tax_rate }}" step="0.01">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.Tax number') }}</label>
            <input type="text" name="tax_no" placeholder="{{ __('admin.Tax number') }}" class="form-control"
                value="{{ setting()->tax_no }}">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.address') }}</label>
            <input type="text" name="address" placeholder="{{ __('admin.address') }}" class="form-control"
                value="{{ setting()->address }}">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.Build number') }}</label>
            <input type="text" name="build_num" placeholder="{{ __('admin.Build number') }}" class="form-control"
                value="{{ setting()->build_num }}">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.Unit number') }}</label>
            <input type="text" name="unit_num" placeholder="{{ __('admin.Unit number') }}" class="form-control"
                value="{{ setting()->unit_num }}">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.Postal code') }}</label>
            <input type="text" name="postal_code" placeholder="{{ __('admin.Postal code') }}" class="form-control"
                value="{{ setting()->postal_code }}">
        </div>

        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.Extra number') }}</label>
            <input type="text" name="extra_number" placeholder="{{ __('admin.Extra number') }}" class="form-control"
                value="{{ setting()->extra_number }}">
        </div>
        <?php $setting = \App\Models\Setting::latest()->first(); ?>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.Logo') }}</label>
            <input type="file" name="logo" placeholder="{{ __('admin.Logo') }}" class="form-control img"
                value="{{ $setting->logo ?? null }}">
            <img src="{{ display_file(setting()->logo) }}" alt="{{ $setting->logo ?? null }}"
                class="img-thumbnail img-preview" width="100px">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.Icon') }}</label>
            <input type="file" name="icon" placeholder="{{ __('admin.Icon') }}" class="form-control">
            <img src="{{ display_file(setting()->icon) }}" alt="{{ $setting->icon ?? null }}"
                class="img-thumbnail img-preview" width="100px">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('capital') }} </label>
            <input type="number" name="capital" placeholder="{{ __('capital') }}" class="form-control"
                value="{{ setting()->capital }}">
        </div>

        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">{{ __('admin.حالة الموقع') }}</label>
            <select name="status" id="" class="main-select w-100">
                <option value="open" {{ setting()->status == 'open' ? 'selected' : '' }}>{{ __('admin.مفتوح') }}
                </option>
                <option value="close" {{ setting()->status == 'close' ? 'selected' : '' }}>{{ __('admin.مغلق') }}
                </option>
            </select>
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">نوع تاريخ الميلاد</label>
            <select name="birthdate_type" id="" class="main-select w-100">
                <option value="hijri" {{ setting()->birthdate_type == 'hijri' ? 'selected' : '' }}>هجري
                </option>
                <option value="gregorian" {{ setting()->birthdate_type == 'gregorian' ? 'selected' : '' }}>ميلادي
                </option>
            </select>
        </div>
        <div class="form-group col-sm-6 col-md-3 mt-4">
            <label class="main-lable" for="">تفعيل تاريخ الميلاد</label>
            <input type="checkbox" name="activate_birthdate" value="1"
                {{ setting()->activate_birthdate ? 'checked' : '' }}>
        </div>
        <div class="form-group col-sm-6 col-md-6">
            {{-- <label class="main-lable" for="">{{ __('age_or_gender') }} </label> --}}
            <label for="" class="p-2">
                عرض حقول الجنس
                <input type="radio" name="age_or_gender" value="sex" id=""
                    {{ setting()->age_or_gender == 'sex' ? 'checked' : '' }}>
            </label>
            <label for="" class="p-2">
                عرض حقول العمر
                <input type="radio" name="age_or_gender" value="age"
                    {{ setting()->age_or_gender == 'age' ? 'checked' : '' }} id="">
            </label>
            <label for="" class="p-2">
                عرض العمر و الجنس
                <input type="radio" name="age_or_gender" value="all"
                    {{ setting()->age_or_gender == 'all' || !setting()->age_or_gender ? 'checked' : '' }} id="">
            </label>
            {{-- <select name="age_or_gender" class="form-select" id="">
            <option value="">اختر نوع العرض</option>
            <option {{ setting()->age_or_gender == 'sex' ? 'selected' : '' }} value="sex">عرض حقول الجنس</option>
        <option {{ setting()->age_or_gender == 'age' ? 'selected' : '' }} value="age">عرض حقول العمر</option>
        <option {{ setting()->age_or_gender == 'all' ? 'selected' : '' }} value="all">عرض الكل</option>
        </select> --}}
        </div>
        <div class="form-group col-12">
            <label class="main-lable" for="">إظهار حقل الشكوى والكشف السريري في التشخيص</label>
            <input type="checkbox" name="complaint" value="1" {{ setting()->complaint ? 'checked' : '' }}>
        </div>
        <div class="form-group col-12">
            <label class="main-lable" for="">{{ __('admin.Delete transfer patients') }}</label>
            <input type="checkbox" name="delete_transfer" @if (setting()->delete_transfer) checked @endif>
        </div>
        <div class="form-group col-12">
            <label class="main-lable" for="">تفعيل الطابعة الحرارية</label>
            <input type="checkbox" name="new_invoice_form" value="1"
                {{ setting()->new_invoice_form ? 'checked' : '' }}>
        </div>



        <div class="form-group col-sm-12">
            <label class="main-lable" for="">{{ __('admin.Message status') }}</label>
            <textarea name="message_status" rows="5" class="form-control" placeholder="{{ __('admin.Message status') }}">{{ setting()->message_status }}</textarea>
        </div>
        <div class="col-md-12 text-center mt-3">
            <h5 class="mx-auto w-fit line-bottom-blue mb-4">إعدادات شركة تمارا</h5>
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">اسم الشركة</label>
            <input type="text" name="installment_company_name" placeholder="اسم الشركة" class="form-control"
                value="{{ setting()->installment_company_name }}">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">رسوم العمليات الادارية</label>
            <input type="number" name="installment_company_tax" placeholder="رسوم العمليات الادارية"
                class="form-control" value="{{ setting()->installment_company_tax }}" step="0.01">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">رسوم أقل مبلغ</label>
            <input type="number" name="installment_company_min_amount_tax" placeholder="رسوم أقل مبلغ"
                class="form-control" value="{{ setting()->installment_company_min_amount_tax }}" step="0.01">
        </div>
        <div class="form-group col-sm-6 col-md-3">
            <label class="main-lable" for="">رسوم أعلى مبلغ</label>
            <input type="number" name="installment_company_max_amount_tax" placeholder="رسوم أعلى مبلغ"
                class="form-control" value="{{ setting()->installment_company_max_amount_tax }}" step="0.01">
        </div>
        <div class="form-group col-12">
            <label class="main-lable" for="">تفعيل بوابات الدفع</label>
            <input type="checkbox" name="payment_gateways" value="1"
                {{ setting()->payment_gateways ? 'checked' : '' }}>
        </div>
        <div class="col-md-12 text-center mt-3">
            <h5 class="mx-auto w-fit line-bottom-blue mb-4">{{ __('admin.Morning and evening settings') }}</h5>
        </div>

        <div class="form-group col-md-6">

            <h6 class="text-center mb-3">{{ __('admin.Morning time') }}</h6>
            <div class="row">
                <div class="col-md-6">
                    <label class="main-lable" for="">{{ __('admin.from') }}</label>
                    <input type="time" name="from_morning" class="form-control"
                        value="{{ setting()->from_morning }}">
                </div>
                <div class="col-md-6">
                    <label class="main-lable" for="">{{ __('admin.to') }}</label>
                    <input type="time" name="to_morning" class="form-control" value="{{ setting()->to_morning }}">

                </div>
            </div>
        </div>

        <div class="form-group col-md-6 ">
            <h6 class="text-center mb-3">{{ __('admin.Evening time') }}</h6>
            <div class="row">
                <div class="col-md-4">
                    <label class="main-lable" for="">{{ __('admin.from') }}</label>
                    <input type="time" name="from_evening" id="from_evening" class="form-control"
                        value="{{ setting()->from_evening }}">

                </div>
                <div class="col-md-4">
                    <label class="main-lable" for="">{{ __('admin.to') }}</label>
                    <input type="time" name="to_evening" id="to_evening" class="form-control"
                        value="{{ setting()->to_evening }}">

                </div>
                <div class="col-md-4">
                    <label class="main-lable" for="">{{ __('admin.evening_status') }}</label>
                    <input type="hidden" name="evening_status" value="0">
                    <input type="checkbox" {{ setting()->evening_status ? 'checked' : '' }} name="evening_status"
                        id="evening_status" class="form-check" value="1">
                </div>
            </div>
        </div>
        <div class="col-12 text-center mt-5">
            <button type="submit" class="btn btn-primary">{{ __('admin.Save') }}</button>
        </div>
    </form>
    <div class="col-12 text-center mt-5">

        <form action='{{ route('backup-database') }}' method='post'>
            @csrf
            <button type="submit" class="btn btn-primary">{{ __('admin.تصدير قواعد بيانات الموقع') }}</button>
        </form>
    </div>
@endsection
@push('js')
    <script>
        // $(".img").change(function() {
        //     if (this.files && this.files[0]) {
        //         var reader = new FileReader();
        //         reader.onload = function(e) {
        //             $(".img-preview").attr('src', e.target.result);
        //         }
        //         reader.readAsDataURL(this.files[0]);
        //     }
        // });
        var status = document.getElementById("evening_status");
        status.addEventListener('change', function() {
            document.getElementById("#from_evening").disabled = !element.disabled;
            document.getElementById("#to_evening").disabled = !element.disabled;
        })
    </script>
@endpush
