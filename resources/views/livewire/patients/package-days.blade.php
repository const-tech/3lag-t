 <section class="main-section">
     <div class="container">
        <div class="bg-white shadow p-4 rounded-3">
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <b class="text-main-color">عنوان الباكدج : </b>
                    <span>{{ $patient_package->package?->title }}</span>
                </div>
                <div class="col-md-4">
                    @php
                        $invoice = \App\Models\Invoice::where('patient_id', $patient_package->patient_id)
                            ->where('package_id', $patient_package->package_id)
                            ->first();
                    @endphp
                    <b class="text-main-color">تاريخ الاشتراك :
                        </b>
                        <span>{{ isset($invoice->date) ? $invoice->date : ""  }}</span>
                </div>
                <div class="col-md-4">
                    <b class="text-main-color">عدد الأيام :
                        </b>
                        <span>{{ $patient_package->dayes_period }}</span>
                </div>
                <div class="col-md-4">
                    <b class="text-main-color">عدد الساعات :
                        </b>
                        <span>{{ $patient_package->total_hours }}</span>
                </div>
                <div class="col-md-4">
                    <b class="text-main-color">الجلسات التي تمت :</b>
                    <span>{{ $patient_package->diagnoses->count() }}</span>
                </div>
                <div class="col-md-4">
                    <b class="text-main-color">الجلسات المتبقية : </b>
                    <span>{{ $patient_package->dayes_period - $patient_package->diagnoses->count() }}</span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>

                        <tr>
                            <th>رقم الجلسة</th>
                            <th>الطبيب</th>
                            <th>التاريخ</th>
                            <th>الوقت</th>
                            <th>معاينة التشخيص</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patient_package->diagnoses as $index => $diagnose)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $diagnose->dr->name }}</td>
                                <td>{{ $diagnose->day }}</td>
                                <td>{{ $diagnose->time }}</td>
                                <td>
                                    <button class="preview-btn btn btn-sm btn-purple mx-1" data-bs-toggle="modal"
                                        data-bs-target="#show{{ $diagnose->id }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @include('front.diagnoses.show')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
     </div>
 </section>
