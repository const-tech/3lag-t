<?php

namespace App\Http\Livewire\Reports;

use App\Models\Invoice;
use Livewire\Component;

class InstallmentCompanyReport extends Component
{
    public $to,$from;
    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }
    public function render()
    {
        $invoices=Invoice::where(function($q){
            $q->where('installment_company',true);
            $this->between($q);
        })->paginate();
        return view('livewire.reports.installment-company-report',compact('invoices'));
    }
}
