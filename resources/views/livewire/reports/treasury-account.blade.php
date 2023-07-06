<section class="treasuryAccount-section main-section pt-5">

    <div class="container">
        <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <h4 class="main-heading">كشف حساب خزينة</h4>
        <div class="treasuryAccount-content bg-white p-4 rounded-2 shadow">
            <div class="row">
                <div class="col-12 col-lg-2">
                    <div class="box-info">
                        <label for="duration-from" class="report-name mt-3 mb-2">{{ __('from')}}</label>
                        <input type="date" class="form-control" name="from" id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="box-info">
                        <label for="duration-to" class="report-name mt-3 mb-2">{{ __('to')}}</label>
                        <input type="date" class="form-control" name="to" id="duration-to" />
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="box-info">
                        <label for="set-day" class="report-name mt-3 mb-2">اختر يوم</label>
                        <select class="main-select w-100 set-day" id="set-day">
                            <option value="">{{ __('admin.All') }}</option>
                            <option value="1">اليوم</option>
                            <option value="2">امس</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="box-info">
                        <label for="pay-way" class="report-name mt-3 mb-2">طريقة الدفع</label>
                        <select class="main-select w-100 pay-way" id="pay-way">
                            <option value="">{{ __('admin.All') }}</option>
                            <option value="cash">{{ __('cash')}}</option>
                            <option value="card">بطاقة شبكة / فيزا</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="box-info">
                        <label for="duration" class="report-name mt-3 mb-2">{{ __('Period')}}
                        </label>
                        <select class="main-select w-100 duration" id="duration">
                            <option value="">{{ __('admin.All') }}</option>
                            <option value="morning">{{ __('Morning time')}}</option>
                            @if(setting()->evening_status)
                            <option value="evening">{{ __('Evening time')}}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="box-info w-100 h-100 d-flex align-items-end justify-content-center">
                        <button type="submit" class="sec-btn-gre w-100 mt-4 mt-lg-0">
                            عرض
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
