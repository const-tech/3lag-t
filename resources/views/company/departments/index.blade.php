@extends('company.layouts.company')
@section('title')
    {{ __('admin.departments') }}
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('company.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.departments') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <a href="{{ route('company.departments.create') }}" class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('admin.name') }}</th>
                    <th scope="col">{{ __('admin.managers') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $department->name }}</td>
                        <td>
                            <a class="btn btn-info btn-sm"
                                href="{{ route('company.departments.edit', $department) }}">{{ __('admin.Update') }}</a>

                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#delete_agent{{ $department->id }}"><i></i>
                                {{ __('admin.Delete') }}
                            </button>
                            @include('company.departments.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $departments->links() }}

    </div>
@endsection
