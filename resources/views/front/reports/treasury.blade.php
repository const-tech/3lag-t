@extends('front.layouts.front')
@section('title')
الخزينة
{{ __('treasury')}}
@endsection
@section('content')
    <section class=" main-section pt-4">
        <div class="container">
        <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <div class="d-flex align-items-center">
        <h4 class="main-heading mb-4">{{ __('treasury')}}</h4>
           <div class="flex-fill">
           <div class="d-flex justify-content-center">
           <div class="alert alert-primary d-flex align-items-center" role="alert">
                {{ __('You can add the capital from the set-up control panel')}}
            </div>
           </div>
           </div>
        </div>
<div class="row g-3 mb-4 boxes-info justify-content-center boxes-bg-color">
      <div class="col-sm-6 col-lg-3">
        <a href="#">
          <div class="box-info blue">
            <i class="fa-solid fa-dollar-sign bg-icon"></i>
            <div class="num">{{ setting()->capital }}</div>
            <div class="text">{{ __('capital')}}</div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <a href="#">
          <div class="box-info green">
            <i class="fa-solid fa-money-bill-trend-up bg-icon"></i>
            <div class="num">{{ $profits }}</div>
            <div class="text"> {{ __('profit')}}</div>
          </div>
        </a>
      </div>
      {{-- <div class="col-sm-6 col-lg-3">
        <a href="#">
          <div class="box-info red">
            <i class="fa-solid fa-money-bill-trend-up fa-flip-vertical bg-icon"></i>
            <div class="num">{{ $losses }}</div>
            <div class="text">{{ __('Expenditure item')}}</div>
          </div>
        </a>
      </div> --}}
      <div class="col-sm-6 col-lg-3">
        <a href="#">
          <div class="box-info red">
            <i class="fa-solid fa-money-bill-trend-up fa-flip-vertical bg-icon"></i>
            <div class="num">{{ setting()->capital + $profits - $losses > 0 ? 0 :  -$losses }}</div>
            <div class="text">{{ __('losses')}}</div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <a href="#">
          <div class="box-info blue">
            <i class="fa-solid fa-money-bill-trend-up fa-flip-vertical bg-icon"></i>
            <div class="num">{{ setting()->capital + $profits }}</div>
            <div class="text">{{ __('capital and profits')}}</div>
          </div>
        </a>
      </div>
      <!-- <div class="col-sm-6 col-lg-3">
        <a href="#">
          <div class="box-info red">
            <i class="fa-solid fa-money-bill-trend-up fa-flip-vertical bg-icon"></i>
            <div class="num">{{ setting()->capital + $profits - $losses }}</div>
            <div class="text"> الصافى بعد استبعاد الخساره</div>
          </div>
        </a>
      </div>
      <div class="col-sm-6 col-lg-3">
        <a href="#">
          <div class="box-info green">
            <i class="fa-solid fa-money-bill-trend-up bg-icon"></i>
            <div class="num">{{ setting()->capital + $profits - $losses }}</div>
            <div class="text"> مبلغ الخزينه الحالى </div>
          </div>
        </a>
      </div> -->


</div>
<div class=" bg-white p-3 rounded-2 shadow">
    <canvas id="myChartDate" height="100"></canvas>
</div>

        </div>
    </section>
@endsection
