<section class="main-section ">
    <!-- @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-warning">{{$error}}</div>
    @endforeach
    @endif -->
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('admin.Add offer') }}</h4>
        <div class="section-content bg-white p-4 shadow rounded-3">
            <div class="mb-4">
                <a class="btn trans-btn btn-sm px-5" href="{{route('front.offers.index')}}">{{ __('admin.Offers') }}</a>
            </div>
            <div class="d-flex flex-column flex-xl-row">
                <div class="collect-info d-flex flex-column ms-lg-2">
                    <label for="" class="small-label mb-2">{{ __('admin.start') }}</label>
                    <input type="date" wire:model.defer="start" id="" class="form-control mb-2 mb-lg-0">
                </div>
                <div class="collect-info d-flex flex-column ms-lg-2">
                    <label for="" class="small-label mb-2">{{ __('admin.end') }}</label>
                    <input type="date" wire:model.defer="end" id="" class="form-control mb-2 mb-lg-0">
                </div>
                <div class="collect-info d-flex flex-column ms-lg-2">
                    <label for="" class="small-label mb-2">{{ __('admin.product') }}</label>
                    <select wire:model.defer="product_id" id="" class="main-select mb-2 mb-lg-0 w-100">
                        <option value="">{{ __('admin.products') }}</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="collect-info flex-column ms-lg-2">
                    <label for="" class="small-label mb-2">{{ __('admin.Show Rate') }}</label>
                    <select wire:model.defer="show" id="" class="main-select mb-2 mb-lg-0 w-100">
                        <option value="">{{ __('admin.Show Rate') }}</option>
                        <option value="1">{{ __('admin.Yes') }}</option>
                        <option value="0">{{ __('admin.No') }}</option>
                    </select>
                </div>

                <div class="collect-info flex-column ms-lg-2">
                    <label for="" class="small-label mb-2">{{ __('admin.rate') }}</label>
                    <input type="number" wire:model.defer="rate" id="" class="form-control mb-2 mb-lg-0">
                </div>

                <div class="btn-holder d-flex align-items-end mt-2 mt-lg-0 mb-lg-1">
                    <button class="btn btn-success btn-sm px-5" wire:click='save'>{{ __('admin.Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</section>
