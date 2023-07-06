@extends('admin.layouts.admin')
@section('title')
    اضافات البرنامج
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page"> اضافات البرنامج</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <a href="{{ route('admin.program_modules.create') }}" class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>الاضافات الخاصه بالبرنامج</th>
                    <th>المميزات</th>
                    <th>السعر</th>
                    <th>التحكم</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($program_modules as $program_module)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $program_module->name }}</td>
                        <td>
                            <p style="white-space: pre-line">
                                {{ $program_module->features }}
                            </p>
                        </td>
                        <td>{{ $program_module->price }}</td>
                        <td>
                            <a class="btn btn-info btn-sm"
                                href="{{ route('admin.program_modules.edit', $program_module) }}">{{ __('admin.Update') }}</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#delete_agent{{ $program_module->id }}"><i></i>
                                {{ __('admin.Delete') }}
                            </button>
                            @include('admin.program_modules.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $program_modules->links() }}

    </div>
@endsection
