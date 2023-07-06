<section class="row row-gap-24 g-2">
    <div class="form-group">
        <label>{{ __('service')}}</label>
        <select wire:model="drug_id" class="form-control">
            <option value="">{{ __('Choose from the available medicines')}}</option>
            @foreach ($drugs as $drug )
            <option value="{{ $drug['id'] }}">{{ $drug['name'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>{{ __('Description and exchange notes')}}</label>
        <textarea wire:model.defer="dr_content" class="form-control" rows="10"></textarea>
    </div>
    <div class="col-12 d-flex justify-content-end">
        <button wire:click='drug_request' class="btn btn-sm trans-btn w-25">
            {{ __('send request')}}
        </button>
    </div>
    <h3>{{ __('previous orders')}}</h3>
    <div class="table-responsive">
        <table class="table main-table">
            <tr>
                <td>{{ __('Medicine')}}</td>
                <td>{{ __('Available Quantity')}}</td>
                <td>{{ __('Required Quantity')}}</td>
            </tr>
            @forelse($selected_drugs as $request)
            <tr>
                <td>
                    {{ $request['name'] }}
                </td>
                <td>
                    {{ $request['quantity'] }}
                </td>
                <td>
                    1
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">{{ __('Add some medicine')}}</td>
            </tr>
            @endforelse
        </table>
    </div>
</section>
