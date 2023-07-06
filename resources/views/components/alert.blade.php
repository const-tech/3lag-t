@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="w-50 w-alert px-3 m-auto mb-2 alert alert-warning alert-dismissible fade show" role="alert">
  {{$error}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach
@endif
