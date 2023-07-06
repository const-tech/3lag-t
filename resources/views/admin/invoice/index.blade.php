@extends('admin.layouts.admin')
@section('title')
{{ __('admin.invoices') }}
@endsection
@section('content')
{{-- invoices table  --}}
<div>
    <h3>{{__('invoices')}}</h3>
</div>
<div>
    <table class="table table-bordered table-striped text-center">
        <thead>
            <th>{{__('admin.invoice_number')}}</th>
            <th>{{__('admin.patient')}}</th>
            <th>{{__('admin.employee')}}</th>
            <th>{{__('total')}}</th>
            <th>{{__('discount')}}</th>
            <th>{{__('tax')}}</th>
            <th>{{ __('admin.Status') }}</th>
        </thead>
        <tbody>
            @forelse($invoices as $invoice)
            <tr>
                <td>{{$invoice->invoice_number ?? "لم يحدد"}}</td>
                <td>{{$invoice->patient->name ?? "لم يحدد"}}</td>
                <td>{{$invoice->employee->name ?? "لم يحدد"}}</td>
                <td>{{$invoice->total ?? "لم يحدد"}}</td>
                <td>{{$invoice->discount ?? "لم يحدد"}}</td>
                <td>{{$invoice->tax ?? "لم يحدد"}}</td>
                <td>{{ __($invoice->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8">{{__('admin.no_invoices')}}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection