@extends('front.layouts.front')
@section('title')
    {{ __('admin.appointments') }}
@endsection
@section('content')
    <section class="main-section py-5">
        <div class=" container">
            {{-- appointments table @dd($user) --}}
            <h4 class="main-heading mb-3">دليل المستخدم</h3>
                <div class="bg-white p-3 rounded-2 shadow">
                    <form action="{{ route('front.profile.update' , $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-4 ">
                                <label for="" class="small-label mb-2">الاسم</label>
                                <input type="text" value="{{ $user->name }}" name="name" wire:model="patient_key"
                                    wire:keyup='get_patient' class="form-control">
                            </div>
                                {{-- <div class="col-md-4 ">
                                    <label for="" class="small-label">كلمة المرور</label>
                                    <input type="password" name="password" id="" class="form-control w-100" />
                                </div>
                                <div class="col-md-4 ">
                                    <label for="" class="small-label">كلمة المرور</label>
                                    <input type="password" name="password_confirmation" id=""
                                        class="form-control w-100" />
                                </div> --}}
                            <div class="col-md-4 ">
                                <label for="" class="small-label">الايميل</label>
                                <input type="text" value="{{ $user->email }}" name="email" id=""
                                    class="form-control w-100" />
                            </div>

                            <div class="col-md-4 ">
                                <label for="" class="small-label">{{ __('')}}</label>
                                <select name="department_id" id="department_id" class="form-control w-100">
                                    <option value="0">{{ __('Choose the department')}}</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            @if ($user->department_id == $department->id) selected @endif>
                                            {{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="col-md-4 ">
                                <label for="" class="small-label">النوع</label>
                                <input type="text" value="{{ $user->type }}" id=""
                                    class="form-control w-100" />
                            </div> --}}
                            <div class="col-md-4 ">
                                <label for="" class="small-label">المرتب</label>
                                <input type="number" value="{{ $user->salary }}" id="" name="salary"
                                    class="form-control w-100" />
                            </div>
                            <div class="col-md-4 ">
                                <label for="" class="small-label">التقييم </label>
                                <input type="number" value="{{ $user->rate }}" id="" name="rate"
                                    class="form-control w-100" />
                            </div>
                            <div class="col-md-4 ">
                                <label for="" class="small-label">الصوره </label>
                                <input type="file" class="form-control modal-title" name='photo'
                                accept="image/jpeg,image/jpg,image/png">
                            <img src="{{ asset($user->photo) }}" height="100px" width="100px" />
                            </div>
                            <div class="col-4 d-flex align-items-end">
                                <button type="submit" wire:click="save"
                                    class="btn btn-sm btn-success w-100">{{ __('admin.admin.save') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
        </div>
    </section>
@endsection
