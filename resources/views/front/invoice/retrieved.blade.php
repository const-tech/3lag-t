<div class="modal fade" id="retrieved{{$invoice->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        
        <div class="modal-content">
            <div class="modal-header">
                استرجاع مبلغ
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">نوع الاسترجاع</label>
                    <select wire:model="retrieve_type" id="" class="form-control">
                        <option value="">اختر نوع الاسترجاع</option>
                        <option value="part">جزئي</option>
                        <option value="all">كامل</option>
                    </select>
                </div>
                <div class="form-group {{ $retrieve_type=='part'?'':'d-none' }}">
                    <label for="">المبلغ</label>
                    <input type="number" wire:model.defer="retrieve_amount" class="form-control" id="">
                </div>
                <div class="collectData-box mb-2 {{ $retrieve_type=='part'?'':'d-none' }}">
                    <label for="" class="small-label mb-1">طريقة الارجاع</label>
                    <select  wire:model="payment_method" id="" class="w-100 form-control">
                        <option value="">اختر طريقة الاسترجاع</option>
                        <option value="cash">نقدا</option>
                        <option value="card">شبكة</option>
                        <option value="bank">تحويل بنكي</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                <button class="btn btn-sm  btn-success" data-bs-dismiss="modal"
                    wire:click='retrieved({{ $invoice }})'>{{ __('admin.Yes') }}</button>
            </div>
        </div>
    </div>
</div>
