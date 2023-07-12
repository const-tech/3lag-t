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
                     <span>{{ isset($invoice->date) ? $invoice->date : '' }}</span>
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

             @if (count($days) > 0)
                 <div class="container">

                     <table class="table table-bordered mt-3">
                         <thead>
                             <tr>
                                 <th class="bg-light text-center" colspan="5">
                                     أيام الباكدج
                                 </th>
                             </tr>
                             <tr>
                                 <th>#</th>
                                 <th>اليوم</th>
                                 <th>التاريخ</th>
                                 <th>موعد الجلسة</th>
                                 <th>وقت الجلسة</th>
                                 <th>إجراءات</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($days as $index => $day)
                                 <tr>
                                     <td>{{ $index + 1 }}</td>
                                     <td><input disabled type="text"
                                             class="form-control"wire:model="days.{{ $index }}.day">
                                     </td>
                                     <td>
                                         <input type="date"
                                             class="form-control"wire:model="days.{{ $index }}.appointment_date"
                                             wire:change="getTimes({{ $index }},$event.target.value)">
                                     </td>
                                     <td>
                                         <select {{ $days[$index]['appointment_date'] ? '' : 'disabled' }}
                                             wire:model.defer="days.{{ $index }}.appointment_time"
                                             id="" class="form-control">
                                             <option value="">{{ __('admin.appointment_time') }}</option>
                                             @foreach ($days[$index]['times'] as $time)
                                                 @if (!in_array($time, $reservedTimes))
                                                     <option value="{{ $time }}">
                                                         {{ date('g:iA', strtotime($time)) }}
                                                     </option>
                                                 @endif
                                             @endforeach
                                         </select>
                                     </td>
                                     <td>
                                         <input type="number"
                                             class="form-control"wire:model="days.{{ $index }}.session_time">
                                     </td>
                                     <td>
                                         @if (count($days) > 1)
                                             <button wire:click="removeDay({{ $index }})"
                                                 class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                         @endif
                                     </td>
                                 </tr>
                             @endforeach

                         </tbody>
                     </table>

                     <section class="form-group my-3">
                         <button class="btn btn-success mt-3 w-25" wire:click="saveDays">
                             {{ __('Save') }}
                         </button>
                     </section>

                 </div>
             @endif

             <table class="table table-bordered mt-3">
                 <thead>

                     <tr>
                         <th>#</th>
                         <th>اليوم</th>
                         <th>التاريخ</th>
                         <th>موعد الجلسة</th>
                         <th>وقت الجلسة</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($patient_package->days as $index => $day)
                         <tr>
                             <td>{{ $index + 1 }}</td>
                             <td>{{ \Carbon::parse($day->appointment_date)->isoFormat('dddd') }}</td>
                             <td>{{ $day->appointment_date }}</td>
                             <td>{{ $day->appointment_time }}</td>
                             <td>{{ $day->session_time }}</td>

                         </tr>
                     @endforeach

                 </tbody>
             </table>
         </div>
     </div>
 </section>
