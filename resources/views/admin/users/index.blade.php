@extends('admin.layouts.admin')
@section('title')
{{ __('admin.users') }}
@endsection
@section('content')

    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.users') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <a href="{{ route('admin.users.create') }}"  class="btn mb-2 btn-primary">{{ __('admin.Add') }}</a>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('admin.name') }}</th>
                    <th scope="col">{{ __('admin.email') }}</th>
                    <th scope="col">{{ __('admin.type') }}</th>
                    <th scope="col">{{ __('admin.group') }}</th>
                    <th scope="col">{{ __('admin.department') }}</th>
                    <th scope="col">{{ __('admin.salary') }}</th>
                    <th scope="col">{{ __('admin.rate') }}</th>
                    <th scope="col">{{ __('admin.managers') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ __($user->type) }}</td>
                        <td>{{ $user->role?->name }}</td>
                        <td>{{ $user->department?->name }}</td>
                        <td>{{ $user->salary }}</td>
                        <td>{{ $user->rate }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit',$user) }}">{{ __('admin.Update') }}</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.users.show',$user) }}">{{ __('admin.Show') }}</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#delete_agent{{ $user->id }}"><i></i>
                                {{ __('admin.Delete') }}
                            </button>
                            @include('admin.users.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}

    </div>

@endsection
