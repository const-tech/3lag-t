<section class="patinet-report main-section pt-5">
    <div class="container">
        <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <h4 class="main-heading">تقرير مجموعات المرضى</h4>
        <div class="treasuryAccount-content bg-white p-4 rounded-2 shadow">
            <div class="row">
                <div class="left-holder d-flex justify-content-end m-sm-0">
                    <button class="btn btn-sm btn-outline-info" id="export-btn">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>{{ __('admin.Export') }} Excel</span>
                    </button>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-from" class="report-name mt-3 mb-2">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" wire:model="from" id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-to" class="report-name mt-3 mb-2">{{ __('admin.to') }}</label>
                        <input type="date" class="form-control" wire:model="to" id="duration-to" />
                    </div>
                </div>

            </div>
            <!-- <hr> -->
            <div class="table-responsive mt-3">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>العدد</th>
                            <th>المدفوعات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($patient_groups as $patient_group)
                            @php
                                $sum_invoices = 0;
                            @endphp
                            @foreach ($patient_group->patients as $patient)
                                @php
                                    $sum_invoices += $patient->invoices()->sum('total');
                                @endphp
                            @endforeach
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $patient_group->name }}</td>
                                <td>{{ $patient_group->patients->count() }}</td>
                                <td>{{ $sum_invoices }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12">{{ __('admin.Sorry, there are no results') }}</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
