<div class="modal fade" id="add_or_update_bonds" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


                <div class="modal-body">
                    <div class="collectData-box mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.Invoice no.') }}</label>
                        <input readonly type="text" wire:model.defer="invoice_id" id="" class="w-100 form-control">
                    </div>
                    <div class="collectData-box mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.patient') }}</label>
                        <input type="text" readonly wire:model="patient" id="" class="w-100 form-control">
                    </div>
                    <div class="collectData-box mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.rest') }}</label>
                        <input type="text" readonly wire:model="invoice_rest" id="" class="w-100 form-control">
                    </div>
                    <div class="collectData-box mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.amount') }}</label>
                        <input type="text" wire:model="amount" id="" class="w-100 form-control">
                    </div>
                    <div class="collectData-box mb-2">
                        <label for="" class="small-label mb-1">طريقة الدفع/الارجاع</label>
                        <select  wire:model="payment_method" id="" class="w-100 form-control">
                            <option value="">اختر طريقة الدفع</option>
                            <option value="cash">نقدا</option>
                            <option value="card">شبكة</option>
                            <option value="bank">تحويل بنكي</option>
                        </select>
                    </div>
                    <div class="collectData-box mb-2">
                        <label for="" class="small-label mb-1">{{ __('Status') }}</label>
                        <select  wire:model="status" id="" class="w-100 form-control">
                            <option value="creditor">دائن</option>
                            <option value="debtor">مدين</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                    <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click='save'>{{ __('admin.Save') }}</button>
                </div>

        </div>

    </div>
</div>
