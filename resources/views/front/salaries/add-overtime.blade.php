<section class="main-section ">
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('admin.Add overtime') }}</h4>
        <div class="section-content p-4 rounded-3 shadow bg-white">
            <button class="btn btn-success btn-sm mb-3"
                wire:click='$set("screen","salaries")'>{{ __('admin.Employee salaries') }}</button>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="collect-box d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.employee') }}</label>
                        <select id="" wire:model="user_id" class="main-select w-100">
                            <option value="">{{ __('admin.users') }}</option>
                            @foreach ($all_users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="collect-box d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.overtime') }}</label>
                        <input type="number" wire:model.defer="amount" id="" class="w-100 form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="collect-box d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.Date') }}</label>
                        <input type="date" wire:model.defer="date" id="" class="w-100 form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="collect-box d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('admin.reason') }}</label>
                        <textarea wire:model.defer="reason" class="w-100 form-control"></textarea>
                    </div>
                </div>
                <div class="col-12 text-center text-md-start">
                    <button class="btn btn-success btn-sm w-25"
                        wire:click='save_overtime'>{{ __('admin.Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</section>
