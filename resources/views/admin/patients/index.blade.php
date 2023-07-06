@extends('admin.layouts.admin')
@section('title')
{{ __('admin.patients') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3">
        <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.patients') }}</li>
    </ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
    <a href="{{ route('admin.patients.create') }}" class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a>
    <div class="table-responsive">
        <table class="table table-hover">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"> {{ __('admin.Medical number') }}</th>
                        <th scope="col">{{ __('admin.name') }}</th>
                        <th scope="col">{{ __('admin.Country') }}</th>
                        <th scope="col"> {{ __('admin.phone') }}</th>
                        <th scope="col">{{ __('admin.Civil number') }}</th>
                        <th scope="col"> {{ __('admin.Last modified by') }}</th>
                        <th scope="col">{{ __('admin.managers') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                    <tr>
                        <th scope="row">{{ $patient->id }}</th>
                        <td>{{ $patient->name}}</td>
                        <td>{{ $patient->country->name ?? null}}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->civil }}</td>
                        <td>{{ $patient->user->name }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.patients.edit',$patient) }}">{{ __('admin.Update')
                                }}</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.patients.show',$patient) }}">{{ __('admin.Show')
                                }}</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#delete_agent{{ $patient->id }}"><i></i>
                                {{ __('admin.Delete') }}
                            </button>
                            @include('admin.patients.delete')
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $patients->links() }}
    </div>

</div>

@endsection
