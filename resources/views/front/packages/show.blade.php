@extends('front.layouts.master')
@section('title')
    الباكدجات | {{ $package->title }}
@endsection
@section('content')
    <section class="main-section">
        <div class="container">
            <h4 class="main-heading">{{ $package->title }}</h4>
            <div class="section-content bg-white rounded-3 shadow p-4">
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>التمرين</th>
                                <th>الوقت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($package->exercises as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->item }} </td>
                                    <td>{{ $item->time }}</td>
                                </tr>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="form-group mb-4">
                    <label for="">ملاحظات</label>
                    <textarea class="form-control" disabled rows="3">{{ $package->notes }}</textarea>
                </div>

                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>النصيحة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($package->advices as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->item }} </td>
                                </tr>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
