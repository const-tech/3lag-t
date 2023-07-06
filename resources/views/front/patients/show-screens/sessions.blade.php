<div>
    <div class="d-flex align-items-center gap-3 mb-2 justify-content-between">
        <div class="d-flex align-items-center gap-4 flex-wrap">
            <div class="d-flex align-items-center gap-1">
                <b class='small-heading fs-12px'>أسم المريض:</b>
                <span class="small-label fs-12px fw-600">{{ $patient->name_ar }}</span>
            </div>
            <div class="d-flex align-items-center gap-1">
                <b class='small-heading fs-12px'> رقم الجوال:</b>
                <span class="small-label fs-12px fw-600">{{ $patient->mobile }}</span>
            </div>

            <div class="d-flex align-items-center gap-1">
                <b class='small-heading fs-12px'> الرقم الطبي:</b>
                <span class="small-label fs-12px fw-600">{{ $patient->id }}</span>
            </div>
        </div>
        <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning py-1">
            <i class="fa-solid fa-print"></i>
        </button>
    </div>
    @php
        $packages = $patient
            ->packages()
            ->latest()
            ->paginate(10);
    @endphp
    <div class="table-responsive">
        <table id="prt-content" class="table main-table">
            <thead>
                <tr>
                    <th># </th>
                    <th>الخطة</th>
                    <th>المدة</th>
                    <th>عدد الساعات</th>
                    <th>المبلغ</th>
                    <th>المبلغ المتبقي</th>
                    <th>الحالة</th>
                    <th>الجلسات المتبقية </th>
                    <th class="not-print">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($packages as $package)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $package->package->title }}</td>
                        <td>{{ $package->dayes_period }}</td>
                        <td>{{ $package->total_hours }}</td>
                        <td>{{ $package->invoice->total }}</td>
                        <td>{{ $package->invoice->status == 'Unpaid' ? $package->invoice->total : $package->invoice->rest }}
                        <td>{{ $package->invoice->status == 'Unpaid' ? 'بانتظار الدفع' : 'مدفوع' }}
                        </td>
                        <td>{{ $package->dayes_period -$package->appointments()->where('appointment_status', 'confirmed')->count() }}
                        </td>

                        <td class="not-print">
                            <div class="d-flex justify-content-center gap-1 ">
                                @if ($package->invoice->status != 'Unpaid')
                                    <a href="{{ route('patients.package_days', [$patient->id, $package->id]) }}"
                                        class="fs-13px btn btn-sm btn-purple"><i class="fa-solid fa-eye"></i></a>
                                @endif
                                <button data-bs-toggle="modal" data-bs-target="#renew"
                                    wire:click="packageId({{ $package->id }})" class="btn btn-warning btn-sm">تجديد
                                    الباكدج </button>
                                <div class="fs-13px btn btn-sm btn-danger">الغاء </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('front.patients.renew')
    </div>
</div>
