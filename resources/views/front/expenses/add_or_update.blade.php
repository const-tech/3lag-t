<div class="modal fade" id="add_or_update" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

                <div class="modal-body">
                    <div class="collect-box d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.name') }}</label>
                        <input type="text" wire:model.defer="name" id="" class="w-100 form-control">
                    </div>
                    <div class="collect-box d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.amount') }}</label>
                        <input type="text" wire:model.defer="amount" id="" class="w-100 form-control">
                    </div>

                    <div class="collect-box d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.Main category') }}</label>
                        <select wire:model="main_cat" id="" class="main-select w-100">
                            <option value="">{{ __('admin.Main category') }}</option>
                            @foreach ($main_cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="collect-box d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.Subcategory') }}</label>
                        <select wire:model.defer="category_id" id="" class="main-select w-100">
                            <option value="">{{ __('admin.Subcategory') }}</option>
                            @foreach ($sub_cats as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="collect-box d-flex flex-column mb-2">
                        <label for="" class="small-label">{{ __('admin.notes') }}</label>
                        <textarea wire:model.defer="notes" class="w-100 form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                    <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click='save'>{{ __('admin.Save') }}</button>
                </div>

        </div>

    </div>
</div>
