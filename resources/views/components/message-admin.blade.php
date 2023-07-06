@if(session()->has('error'))
<div class="w-50 w-alert px-3 m-auto my-2 alert alert-warning alert-dismissible fade show" role="alert">
  <div class="d-flex align-items-center gap-2">
    <h6><i class="icon fas fa-exclamation-triangle"></i> {{ trans('admin.alert') }}!</h6>
  </div>
  {{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session()->has('success'))
<div class="w-50 w-alert px-3 m-auto my-2 alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(count($errors->all()) > 0)
<div class="w-50 w-alert px-3 m-auto my-2 alert alert-warning alert-dismissible fade show" role="alert">
  <div class="d-flex align-items-center gap-2">
    <h6><i class="icon fas fa-exclamation-triangle"></i> تحذير</h6>
  </div>
  <ol class="me-0">
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ol>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
