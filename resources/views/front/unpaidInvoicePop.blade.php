<div class="modal fade" id="unpaid_invoice" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close btn-cls" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    يوجد لدى المريض فواتير غير مسددة
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm  btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                </div>

        </div>

    </div>
</div>
<div class="modal fade" id="partiallyPaid_invoice" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close btn-cls" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    يوجد لدى المريض فواتير مسددة جزئيا
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm  btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                </div>

        </div>

    </div>
</div>
