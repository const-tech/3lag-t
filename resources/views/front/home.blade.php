@extends('front.layouts.front')
@section('title')
{{ __('admin.home') }}
@endsection
@section('content')
<section class="main-section home">
  <div class="container">
    <h4 class="main-heading">{{ __('admin.home') }}</h4>
    <div class="row g-3 mb-4 boxes-info">
      <div class="col-sm-6 col-lg-3">
        <a href="{{ route('front.patients.index') }}">
          <div class="box-info blue">
            <i class="fas fa-solid fa-bed-pulse bg-icon"></i>
            <div class="num">{{ App\Models\Patient::count() }}</div>
            <div class="text">{{ __('admin.All patients') }}</div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <a href="{{ route('front.patients.index',['toDay'=>true]) }}">
          <div class="box-info green">
            <i class="fas fa-solid fa-address-card bg-icon"></i>
            <div class="num">{{ App\Models\Patient::where('created_at',toDay())->count() }}</div>
            <div class="text">{{ __('admin.Registered today') }}</div>
        </div>
    </a>
      </div>
      <div class="col-sm-6 col-lg-3">
          <a href="{{ route('front.patients.index',['saudi'=>true]) }}">
              <div class="box-info green">
            <i class="fas fa-solid fa-address-card bg-icon"></i>
            <div class="num">{{ App\Models\Patient::where('country_id',1)->count() }}</div>
            <div class="text">{{ __('Saudi Patients') }}</div>
        </div>
    </a>
      </div>
      <div class="col-sm-6 col-lg-3">
          <a href="{{ route('front.patients.index',['saudi'=>'false']) }}">
              <div class="box-info green">
                  <i class="fas fa-solid fa-address-card bg-icon"></i>
                  <div class="num">{{ App\Models\Patient::where('country_id','<>',1)->count() }}</div>
                  <div class="text">{{ __('Non-Saudi patients') }}</div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <a href="{{ route('front.appointments.index',['today'=>true]) }}">
        <div class="box-info pur">
          <i class="fas fa-solid fa-calendar-check bg-icon"></i>
          <div class="num">{{ App\Models\Appointment::today()->count() }}</div>
          <div class="text">{{ __('admin.Today appointments') }}</div>
        </div>
      </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <a href="{{ route('front.pay_visit') }}">
        <div class="box-info red">
          <i class="fas fa-solid fa-file-invoice-dollar bg-icon"></i>
          <div class="num">{{ App\Models\Invoice::whereRelation('employee','type','dr')->where('status','Unpaid')->count() }}</div>
          <div class="text">{{ __('admin.Pay visits') }}</div>
        </div>
      </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <a href="{{ route('front.appointment.transferred') }}">
        <div class="box-info pur">
          <i class="fas fa-solid fa-calendar-check bg-icon"></i>
          <div class="num">{{ App\Models\Appointment::transferred()->count() }}</div>
          <div class="text">{{ __('admin.Transferred patients') }}</div>
        </div>
      </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <a href="{{ route('front.scan_requests') }}">
        <div class="box-info pur">
          <!-- <i class="fas fa-solid fa-tv bg-icon"></i> -->
          <i class="fa-solid fa-money-bill-trend-up bg-icon"></i>
          <div class="num">{{ \App\Models\ScanRequest::query()->pending()->count() }}</div>
          <div class="text">{{ __('admin.Unpaid bills') }}</div>
        </div>
      </a>
      </div>
    </div>

    <h4 class="main-heading">{{ __('admin.Latest appointments') }}</h4>
    <div class="latestAppointments-content bg-white p-3 rounded-2 shadow">
      <div class="table-responsive">
        <table class="table main-table">
            <thead>
                <th>{{__('admin.patient')}}</th>
                <th>{{__('admin.doctor')}}</th>
                <th>{{__('admin.clinic')}}</th>
                <th>{{__('admin.appointment_status')}}</th>
                <th>{{__('admin.appointment_time')}}</th>
                <th>{{__('admin.appointment_date')}}</th>

            </thead>
            <tbody>
                @forelse(App\Models\Appointment::today()->get() as $appointment)
                <tr>
                <td>{{ $appointment->patient?->name }}</td>
                <td>{{ $appointment->doctor?->name }}</td>
                <td>{{ $appointment->clinic?->name }}</td>
                <td>{{ __($appointment->appointment_status) }}</td>
                <td>{{ $appointment->appointment_time }}</td>
                <td>{{ $appointment->appointment_date }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="12">{{__('There are no appointments')}}</td>
            </tr>
            @endforelse
        </tbody>
        </table>
        </div>
    </div>
  </div>
</section>

@endsection
