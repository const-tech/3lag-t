@extends('admin.layouts.admin')
@section('title')
{{ __('admin.usermanual') }}
@endsection
@section('content')

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3">
        <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.usermanual') }}</li>
    </ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
    <b>{{ __('admin.usermanual') }}</b>
    <hr>
    <form class="row g-3" action="{{ route('admin.user-manuals.store') }}" method="POST">
        @csrf
        <div class="col-12 col-md-12">
            <label class="small-label" for="">{{ __('admin.question') }}</label>
            <input class="form-control" type="text" name="question" value="{{ old('question') }}">
        </div>
        <div class="col-12 col-md-12">
            <label class="small-label" for="">{{ __('admin.question') }} (English)</label>
            <input class="form-control" type="text" name="question_en" value="{{ old('question_en') }}">
        </div>
        <div class="col-12 col-md-12">
            <label for="" class="small-label">{{ __('admin.answer') }}</label>
            <textarea class="form-control" name="answer" id="answer" cols="30" rows="10">{{ old('answer') }}</textarea>
        </div>
        <div class="col-12 col-md-12">
            <label for="" class="small-label">{{ __('admin.answer') }} (English)</label>
            <textarea class="form-control" name="answer_en" id="answer_en" cols="30" rows="10">{{ old('answer_en') }}</textarea>
        </div>

        <div class="col-12 mt-5 text-center">
            <button class="btn btn-primary">{{ __('admin.Add') }}</button>

        </div>
    </form>

</div>
@push('js')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('answer', {
        language: 'ar'
    , });
    CKEDITOR.replace('answer_en', {
        language: 'ar'
    , });

</script>
@endpush
@endsection
