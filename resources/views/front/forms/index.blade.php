@extends('front.layouts.front')
@section('title')
    {{ __('admin.Forms') }}
@endsection
@section('content')
<section class="main-section users">
    <div class="container">
        <h4 class="main-heading">{{ __('admin.Forms') }}</h4>
        <div class="bg-white shadow rounded p-4">
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th class="text-center">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($forms as $form)
                        <tr>
                            <td>{{ $form->id }}</td>
                            <td>{{ $form->name }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <!--btn  Modal repeat-->

                                    <a class="btn btn-sm btn-purple" target="_blank" href="{{ display_file($form->file) }}"><i class="fa fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $forms->links() }}
            </div>
        </div>
    </div>
</section>@endsection
