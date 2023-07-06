<?php

namespace App\Http\Livewire\Reports;

use App\Models\Insurance;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class InsurancesReport extends Component
{
    public $selected_insurance, $insurance;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function delete(Invoice $invoice)
    {
        $invoice->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }
    public function updatedInsurance()
    {
        $this->selected_insurance = null;
        if ($this->insurance) {
            $this->selected_insurance = Insurance::withCount('patients')->findOrFail($this->insurance);
        }
    }
    public function render()
    {
        $insurances = Insurance::all();
        $invoices = Invoice::with('patient')->whereRelation('patient', 'insurance_id', '<>', null)->where(function ($q) {
            if ($this->insurance) {
                $q->whereRelation('patient', 'insurance_id', $this->insurance);
            }
        })->latest()->paginate(10);
        return view('livewire.reports.insurances-report', compact('invoices', 'insurances'));
    }
}
