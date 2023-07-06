<div class="modal fade" id="add_or_update" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


                <div class="modal-body">
                    <div class="collectData-box mb-2">
                        <label for="" class='small-label'>{{ __('admin.name') }}</label>
                        <input type="text" wire:model.defer="name" id="" class="form-control w-100">
                    </div>
                    <div class="collectData-box mb-2">
                        <label for="" class='small-label'>{{ __('admin.department') }}</label>
                        <select class="main-select w-100" wire:model.defer="department_id" id="">
                            <option value="">{{ __('admin.Choose the department') }}</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                            </select>
                    </div>
                    <div class="collectData-box mb-2">
                        <label for="" class='small-label'>{{ __('admin.price') }}</label>
                        <input type="number" wire:model.defer="price" id="" class="form-control w-100">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                    <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click='save'>{{ __('admin.Save') }}</button>
                </div>
        </div>
    </div>
</div>
