@extends('admin.layouts.admin')
@section('title')
{{ __('admin.services') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3">
        <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.services') }}</li>
    </ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
    <a href="{{ route('admin.services.create') }}" class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('admin.name') }}</th>
                <th scope="col">{{ __('admin.price') }}</th>
                <th scope="col">{{ __('category') }}</th>
                <th scope="col">{{ __('admin.managers') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->name }}</td>
                <td>{{ $service->price }}</td>
                <td>{{ $service->category->name }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.services.edit',$service) }}">{{ __('admin.Update') }}</a>
                    <a class="btn btn-danger btn-sm" href="{{ route('admin.invoices.index',['service_id'=>$service->id]) }}">
                        {{ __('Invoices') }}
                        <i class="fa fa-file-invoice-dollar"></i>
                    </a>

                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $service->id }}"><i></i>
                        {{ __('admin.Delete') }}
                    </button>
                    @include('admin.service.delete')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $services->links() }}

</div>

@endsection
