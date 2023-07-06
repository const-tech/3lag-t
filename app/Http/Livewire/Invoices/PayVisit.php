<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class PayVisit extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function delete(Invoice $invoice){
        $invoice->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }
    public function render()
    {
        // $invoices=Invoice::whereRelation('employee','type','dr')->where('status','Unpaid')->latest()->paginate(10);
        $invoices=Invoice::where('status','Unpaid')->latest()->paginate(10);
        return view('livewire.invoices.pay-visit',compact('invoices'));
    }
}
