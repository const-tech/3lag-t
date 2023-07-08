<div class="p-3">
    <section class="form-group mb-3 ">
        <label for="exampleFormControlTextarea1" class="mb-2"> ارفاق ملف</label>
        <input type="file" wire:model.defer='file' class="form-control w-auto">
    </section>
    <section class="form-group mb-3 ">
        <label for="exampleFormControlTextarea1" class="mb-2">تقرير الطبيب</label>
        <textarea class="form-control" rows="3" wire:model.defer="dr_content"></textarea>
    </section>
    {{-- <section class="form-group mb-3 ">
        <label for="exampleFormControlTextarea1" class="mb-2 d-block">خدمة المختبر</label>
        <select wire:model.defer="lab_product_id" class="main-select w-auto" id="">
            <option value="">اختر خدمة المختبر</option>
            @foreach ($lab_products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </section> --}}
    <button class="btn btn-sm btn-primary" wire:click='saveLab'>حفظ</button>
    <div class="table-responsive mt-4">
        <table id="prt-content" class="table main-table ">
            <thead>
                <tr>
                    <th>الحيوان</th>
                    <th>التشخيص</th>
                    <th>التاريخ</th>
                    <th class="text-center not-print">{{ __('admin.managers') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patient->labs()->where('animal_id',$animal_id)->get() as $lab)
                    <tr>
                        <td>{{ $lab->animal?->name }}</td>
                        <td>{{ $lab->dr_content }}</td>
                        <td>{{ $lab->created_at->diffForHumans() }}</td>
                        <td>
                            <div class="btn_holder d-flex align-items-center justify-content-center gap-2">
                                @if ($lab->file)
                                    <a target="_blank" href="{{ display_file($lab->file) }}"
                                        class="btn btn-sm btn-info text-white">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
