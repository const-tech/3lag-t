<section class="main-section users">
    <x-alert></x-alert>
    <div class="container" id="data-table">
        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0">الخطط العلاجية</h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">

            <div class="btn-holder mb-3 d-flex align-items-center justify-content-end">
                <button type="button" wire:click='clearPackage' data-bs-toggle="modal" data-bs-target="#modal-add"
                    class="btn-main-sm">
                    إضافة خطة
                    <i class="icon fa-solid fa-plus"></i>
                </button>
            </div>
            <nav class="packages-nav">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button wire:click='$set("tab","adult")' class="nav-link {{ $tab == 'adult' ? 'active' : '' }}"
                        id="nav-oldPatient-tab" data-bs-toggle="tab" data-bs-target="#nav-oldPatient" type="button"
                        role="tab" aria-selected="{{ $tab == 'adult' ? 'true' : 'false' }}">باقات علاجيه
                        للكبار</button>
                    <button wire:click='$set("tab","child")' class="nav-link {{ $tab != 'adult' ? 'active' : '' }}"
                        id="nav-youngPatient-tab" data-bs-toggle="tab" data-bs-target="#nav-youngPatient" type="button"
                        role="tab" aria-selected="{{ $tab != 'adult' ? 'true' : 'false' }}">باقات علاجيه
                        للصغار</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade {{ $tab == 'adult' ? 'show active' : '' }} " id="nav-oldPatient"
                    role="tabpanel">
                    <div class="row mb-2 mt-3">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center justify-content-start h-100">
                                <h6 class="small-heading mb-0">خطه الشهرين</h6>
                                <span class="mx-2">-</span>
                                <p class="small-label fw-bold">المرحلة الاولي</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex flex-column flex-md-row gap-2">
                            <div dir="ltr" class="input-group mb-2 mb-md-0">
                                <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                    بحث
                                </button>
                                <input dir="rtl" type="text" class="form-control" placeholder="بحث "
                                    wire:model="search">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table main-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الخطة</th>
                                    <th>القسم</th>
                                    <th>النوع</th>
                                    <th>عدد الجلسات</th>
                                    <th>سعر الجلسة</th>
                                    <th>الإجمالي</th>
                                    <th class="text-center not-print">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adultPackages as $package)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td> {{ $package->title }}</td>
                                        <td>{{ $package->department?->name }}</td>
                                        <td>{{ $package->type == 'adult' ? 'بالغ' : 'طفل' }}</td>
                                        <td>{{ $package->num_of_sessions }}</td>
                                        <td>{{ $package->price }}<small>SR</small></td>
                                        <td>{{ $package->total }}<small>SR</small></td>
                                        <td>

                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <a href="{{ route('front.packages_report', ['package' => $package->id]) }}"
                                                    class="btn btn-sm trans-btn text-white space-noWrap">{{ __('admin.financial report') }}</a>
                                                <button wire:click="edit({{ $package->id }})" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#modal-add"
                                                    class="btn btn-sm btn-info text-white py-1">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger py-1" data-bs-toggle="modal"
                                                    data-bs-target="#delete_agent"
                                                    wire:click="packageId({{ $package->id }})">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $adultPackages->links() }}
                </div>
                <div class="tab-pane fade {{ $tab != 'adult' ? 'show active' : '' }}" id="nav-youngPatient"
                    role="tabpanel">
                    <div class="row mb-2 mt-3">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center justify-content-start h-100">
                                <h6 class="small-heading">خطه العام</h6>
                                <span class="mx-2">-</span>
                                <p class="small-label fw-bold">المرحلة الثالثه</p>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex flex-column flex-md-row gap-2">
                            <div dir="ltr" class="input-group mb-2 mb-md-0">
                                <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                    بحث
                                </button>
                                <input dir="rtl" type="text" class="form-control" placeholder="بحث "
                                    wire:model="title">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table main-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الخطة</th>
                                    <th>القسم</th>
                                    <th>النوع</th>
                                    <th>عدد الجلسات</th>
                                    <th>سعر الجلسة</th>
                                    <th>الإجمالي</th>
                                    <th class="text-center not-print">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adultPackages as $package)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td> {{ $package->title }}</td>
                                        <td>{{ $package->department?->name }}</td>
                                        <td>{{ $package->type == 'adult' ? 'بالغ' : 'طفل' }}</td>
                                        <td>{{ $package->num_of_sessions }}</td>
                                        <td>{{ $package->price }}<small>SR</small></td>
                                        <td>{{ $package->total }}<small>SR</small></td>
                                        <td>
                                            <a href="{{ route('front.packages_report', ['package' => $package->id]) }}"
                                                class="btn btn-sm trans-btn text-white space-noWrap">{{ __('admin.financial report') }}</a>

                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <button wire:click="edit({{ $package->id }})" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#modal-add"
                                                    class="btn btn-sm btn-info text-white py-1">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger py-1" data-bs-toggle="modal"
                                                    data-bs-target="#delete_agent"
                                                    wire:click="packageId({{ $package->id }})">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $childPackages->links() }}
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="staticBackdropLabel"
                wire:ignore.self>
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">أضف خطة </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body sm-p-modal">
                            <div class="row g-2">
                                <div class="col-12 col-md-4">
                                    <label class="small-label" for=""> القسم:</label>
                                    <select name="" class="main-select w-100" wire:model.defer='department_id'
                                        id="">
                                        <option value="">اختر </option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="small-label" for=""> نوع الخطة:</label>
                                    <select name="" class="main-select w-100" wire:model.defer='type'
                                        id="">
                                        <option value="">اختر نوع الخطة</option>
                                        <option value="adult">بالغ</option>
                                        <option value="child">طفل</option>
                                    </select>
                                    @error('type')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class=" col-sm-4">
                                    <label class="small-label" for=""> اسم الخطة: </label>
                                    <input class="form-control" type="text" wire:model.defer='title'>
                                </div>
                                <div class=" col-sm-4">
                                    <label class="small-label" for=""> عدد الجلسات:</label>
                                    <input class="form-control" type="number" placeholder="  "
                                        wire:model.defer='num_of_sessions'>
                                </div>
                                <div class=" col-sm-4">
                                    <label class="small-label" for=""> وقت الجلسة:</label>
                                    <input class="form-control" type="number" placeholder="  "
                                        wire:model.defer='session_period'>
                                </div>
                                <div class=" col-sm-4">
                                    <label class="small-label" for=""> سعر الجلسة:</label>
                                    <input class="form-control" type="number" placeholder="  "
                                        wire:model.defer='price'>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm px-4"
                                data-bs-dismiss="modal">رجوع</button>
                            <button type="button" class="btn-main-sm px-4" wire:click='submit'
                                data-bs-dismiss="modal">حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
            @include('front.packages.delete')
        </div>
    </div>
</section>
@push('js')
    <script>
        window.addEventListener('openEditModel', function() {
            let model = document.getElementById("modal-add");
            model.show()
        });
    </script>
@endpush
