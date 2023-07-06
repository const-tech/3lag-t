@extends('front.layouts.front')
@section('title')
    اضافات البرنامج
@endsection
@section('content')
    <section class="main-section section-guide">
        <div class="container">
            <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
                <h4 class="main-heading mb-0"> اضافات البرنامج</h4>
            </div>
            <div class="bg-white shadow p-4 rounded-3">
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاضافات الخاصه بالبرنامج</th>
                                <th>المميزات</th>
                                <th>السعر</th>
                                <th>الاضافات المفعله</th>
                                <th>طلب الاضافة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($program_modules as $program_module)
                                <tr>
                                    <th>{{ $loop->index + 1 }}</th>
                                    <td>{{ $program_module->name }}</td>
                                    <td>
                                        <button data-bs-toggle="modal" data-bs-target="#show{{ $program_module->id }}"
                                            class="btn btn-purple btn-sm">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </td>
                                    <td> {{ number_format($program_module->price, 2) }} ر.س</td>
                                    <td>
                                        <h6>
                                            <span class="badge bg-success">مفعلة</span>
                                        </h6>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-success">
                                            أطلب الأن
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="show{{ $program_module->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                مميزات الاضافة : {{ $program_module->name }}
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <p style="white-space: pre-line">
                                                    {{ $program_module->features }}
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    data-bs-dismiss="modal">الغاء</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
