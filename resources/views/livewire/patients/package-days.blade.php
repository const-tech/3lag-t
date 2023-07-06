 <div>
     <div class="container">
         <div class="row">
             <div class="col-md-4 mt-4">
                 <b>عنوان الباكدج : {{ $patient_package->package?->title }}</b>
             </div>
             <div class="col-md-4 mt-4">
                 <b>تاريخ الاشتراك : {{ $patient_package->invoice?->date }}</b>
             </div>
             <div class="col-md-4 mt-4">
                 <b>عدد الأيام : {{ $patient_package->days->count() }}</b>
             </div>
             <div class="col-md-4 mt-4">
                 <b>عدد الساعات : {{ $patient_package->days->sum('session_time') }}</b>
             </div>
             <div class="col-md-4 mt-4">
                 <b>الجلسات التي تمت : {{ $patient_package->days->where('status', 'confirmed')->count() }}</b>
             </div>
             <div class="col-md-4 mt-4">
                 <b>الجلسات المتبقية : {{ $patient_package->days->where('status', null)->count() }}</b>
             </div>
         </div>
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
                                     wire:model.defer="days.{{ $index }}.appointment_time" id=""
                                     class="form-control">
                                     <option value="">{{ __('admin.appointment_time') }}</option>
                                     @foreach ($days[$index]['times'] as $time)
                                         @if (!in_array($time, $reservedTimes))
                                             <option value="{{ $time }}">{{ date('g:iA', strtotime($time)) }}
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
                     {{-- <tr>
                    <td colspan="5">
                        <button wire:click="addDay" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                            أضف يوم</button>
                    </td>
                </tr> --}}
                 </tbody>
             </table>

             <section class="form-group my-3">
                 <button class="btn btn-success mt-3 w-25" wire:click="saveDays">
                     {{ __('Save') }}
                 </button>
             </section>

         </div>
     @endif
 </div>
