@extends('admin.layouts.admin')
@section('title')
{{ __('admin.labs') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3">
        <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.usermanual') }}</li>
    </ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
    <a href="{{ route('admin.user-manuals.create') }}" class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('admin.question') }}</th>
                <th scope="col">{{ __('admin.question') }} (English)</th>
                <th scope="col">{{ __('admin.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userManuals as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->question }}</td>
                <td>{{ $item->question_en }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.user-manuals.edit',$item) }}">{{ __('admin.Update') }}</a>

                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $item->id }}"><i></i>
                        {{ __('admin.Delete') }}
                    </button>
                    @include('admin.user-manual.delete')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $userManuals->links() }}

</div>

@endsection
