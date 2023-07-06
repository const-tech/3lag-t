<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Invoice;
use Livewire\Component;

class UnPaidInvoice extends Component
{
    public function render()
    {
        $invoices = Invoice::where('status','unpaid')->pluck('patient_id');

        $appointments = Appointment::where('appointment_date',date('Y-m-d'))
            ->whereIn('patient_id', $invoices)
            ->get();
        return view('livewire.un-paid-invoice',compact('appointments'));
    }
}
