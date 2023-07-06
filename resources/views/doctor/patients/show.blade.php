@extends('doctor.layouts.index')
@section('title')
    {{ __('admin.Show patient') }}
@endsection
@section('content')
    @include('front.unpaidInvoicePop')
    @livewire('doctor-patients.view-patient', ['patient' => $patient])
    @if ($patient->invoices()->unpaid()->count() > 0)
        @push('js')
            <script>
                var myModal = new bootstrap.Modal(document.getElementById("unpaid_invoice"), {});
                document.onreadystatechange = function() {
                    myModal.show();
                };
            </script>
        @endpush
    @endif
    @if ($patient->invoices()->PartiallyPaid()->count() > 0)
        @push('js')
            <script>
                var myModal = new bootstrap.Modal(document.getElementById("partiallyPaid_invoice"), {});
                document.onreadystatechange = function() {
                    myModal.show();
                };
            </script>
        @endpush
    @endif
@endsection
