 <section class="p-3">
     <section class="form-group mb-3 ">
         <label for="exampleFormControlTextarea1" class="mb-2"> ارفاق ملف</label>
         <input type="file" wire:model.defer='file' class="form-control w-auto">
     </section>
     <section class="form-group mb-3 ">
         <label for="exampleFormControlTextarea1" class="mb-2">كشف الطبيب</label>
         <textarea class="form-control" rows="3" wire:model.defer="dr_content"></textarea>
     </section>
     {{-- <section class="form-group mb-3 ">
        <label for="exampleFormControlTextarea1" class="mb-2">خدمة الاشعة</label>
        <select wire:model.defer="scan_product_id" id="">
            <option value="">اختر خدمة الاشعة</option>
            @foreach ($scan_products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </section> --}}
     <button class="btn btn-sm btn-primary" wire:click='saveScan'>حفظ</button>
     <section class="table-responsive mt-4">
         <table class="table main-table m-0">
             <thead>
                 <tr>
                     <th>الحيوان</th>
                     <th>التشخيص</th>
                     <th>التاريخ</th>
                     <th class="text-center not-print">{{ __('admin.managers') }}</th>
                 </tr>
             </thead>
             <tbody>
                 @forelse($patient->scans()->where('animal_id',$animal_id)->get() as $scan)
                     <tr>
                         <td>{{ $scan->animal?->name }}</td>
                         <td>{{ $scan->dr_content }}</td>
                         <td>{{ $scan->created_at->diffForHumans() }}</td>
                         <td>
                             <div class="btn_holder d-flex align-items-center justify-content-center gap-2">
                                 @if ($scan->file)
                                     <a target="_blank" href="{{ display_file($scan->file) }}"
                                         class="btn btn-sm btn-info text-white">
                                         <i class="fa-solid fa-eye"></i>
                                     </a>
                                 @endif
                             </div>
                         </td>
                     </tr>
                 @empty
                 @endforelse
             </tbody>
         </table>
     </section>
 </section>
