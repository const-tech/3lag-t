@extends('front.layouts.front')
@section('title')
    {{ __('admin.Scan Requests') }}
@endsection
@section('content')
    <section class=" main-section pt-4">
        <div class="container">
            <h4 class="main-heading mb-4">{{ __('admin.Scan Requests') }}</h4>
            <div class="bills-content bg-white p-4 rounded-2 shadow">
                <div class="table-responsive">
                    <table class="table main-table" >
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.Patient') }}</th>
                            <th>{{ __('admin.Requested by') }}</th>
                            <th>{{ __('admin.Requested at') }}</th>
                            <th>{{ __('admin.Scanned at') }}</th>
                            <th>{{ __('admin.Delivered at') }}</th>
                            <th>{{ __('admin.Status') }}</th>
                            <th>{{ __('admin.Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($scanRequests as $request)
                            <tr>
                                <td>#</td>
                                <td>{{ $request->patient->name }}</td>
                                <td>{{ $request->doctor->name }}</td>
                                <td>{{ $request->created_at }}</td>
                                <td>{{ $request->scanned_at }}</td>
                                <td>{{ $request->delivered_at }}</td>
                                <td>{{ __('admin.status.'.$request->status) }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#scannerModal{{$request->id}}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <div class="modal fade" id="scannerModal{{$request->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{$request->patient->name}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $request->content !!}
                                                    <form id="scan-form-{{$request->id}}" action="{{route('front.scan-requests.update',$request)}}" method="POST">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="scanned">
                                                    </form>
                                                    <form id="deliver-form-{{$request->id}}" action="{{route('front.scan-requests.update',$request)}}" method="POST">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="status" value="delivered">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">اغلاق</button>
                                                    @if($request->status == 'pending')
                                                        <button type="submit"  form="scan-form-{{$request->id}}" class="btn btn-primary btn-sm">مسح</button>
                                                    @endif
                                                    @if($request->status == 'scanned')
                                                        <button type="submit"  form="deliver-form-{{$request->id}}" class="btn btn-primary btn-sm">تسليم</button>
                                                    @endif
                                                </div>
                                            </div>
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
    </section>
@endsection
