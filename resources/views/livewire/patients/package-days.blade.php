 <div>
     <div class="container">
         <div class="row">
             <div class="col-md-4 mt-4">
                 <b>عنوان الباكدج : {{ $patient_package->package?->title }}</b>
             </div>
             <div class="col-md-4 mt-4">
                 @php
                     $invoice = \App\Models\Invoice::where('patient_id', $patient_package->patient_id)
                         ->where('package_id', $patient_package->package_id)
                         ->first();
                 @endphp
                 <b>تاريخ الاشتراك : {{ $invoice->date }}</b>
             </div>
             <div class="col-md-4 mt-4">
                 <b>عدد الأيام : {{ $patient_package->dayes_period }}</b>
             </div>
             <div class="col-md-4 mt-4">
                 <b>عدد الساعات : {{ $patient_package->total_hours }}</b>
             </div>
             <div class="col-md-4 mt-4">
                 <b>الجلسات التي تمت : {{ $patient_package->diagnoses->count() }}</b>
             </div>
             <div class="col-md-4 mt-4">
                 <b>الجلسات المتبقية : {{ $patient_package->dayes_period - $patient_package->diagnoses->count() }}</b>
             </div>
         </div>
         <table class="table table-bordered mt-3">
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
