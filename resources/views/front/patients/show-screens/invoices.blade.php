<div class="d-flex gap-2 mb-2">
    <button class="btn btn-sm btn-success btn-sm" wire:click='$set("invoice_status","")'>{{ __('admin.All') }}
        {{ $patient->invoices()->count() }}</button>
    <button class="btn btn-sm text-white btn-info btn-sm" wire:click='$set("invoice_status","paid")'>{{ __('admin.Paid') }}
        {{ $patient->invoices()->where('status', 'paid')->count() }}</button>
    <button class="btn btn-sm btn-danger btn-sm" wire:click='$set("invoice_status","unpaid")'>{{ __('admin.Unpaid') }}
        {{ $patient->invoices()->where('status', 'unpaid')->count() }}</button>
</div>
<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>{{ __('admin.Invoice no.') }}</th>
                <th>{{ __('admin.patient') }}</th>
                <th>{{ __('admin.dr') }}</th>
                <th>{{ __('admin.Accountant') }}</th>
                <th>{{ __('admin.Date') }}</th>
                <th>{{ __('admin.Total') }}</th>
                <th>{{ __('rest') }}</th>
                <th>{{ __('admin.Status') }}</th>
                <th>{{ __('admin.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $invoice->dr ? $invoice->dr->name : '' }}</td>
                    <td>{{ $invoice->employee->name }}</td>
                    <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                    <td>{{ $invoice->total }}</td>
                    <td>{{ $invoice->rest }}</td>
                    <td>{{ __($invoice->status) }}</td>
                    <td><a href="" class="btn btn-sm btn-info text-white">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a target="_blank" href="{{ route('front.invoices.show', $invoice) }}"
                            class="btn btn-sm btn-purple">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {{ $invoices->links() }}
</div>
