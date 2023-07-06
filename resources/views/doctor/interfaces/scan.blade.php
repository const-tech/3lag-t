 <section class="p-3">
    <section class="form-group mb-3 ">
        <label for="exampleFormControlTextarea1" class="mb-2">كشف الطبيب</label>
        <textarea class="form-control"  rows="3" wire:model.defer="dr_content"></textarea>
    </section>
    <section class="form-group mb-3 ">
        <label for="exampleFormControlTextarea1" class="mb-2">خدمة الاشعة</label>
        <select wire:model.defer="scan_product_id" id="">
            <option value="">اختر خدمة الاشعة</option>
            @foreach ($scan_products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </section>
    <button class="btn btn-sm btn-primary" wire:click='scan_request'>طلب</button>
 </section>
