<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\Voucher;
use Livewire\Component;
use Livewire\WithPagination;

class PayPackage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function delete(Invoice $invoice)
    {
        $invoice->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }


    public function enter(Invoice $invoice)
    {
        $invoice->update(['is_entered' => 1]);

        $voucher_data = [
            [
                'account_id' => $invoice->account_id,
                'debit' => $invoice->total,
                'credit' => 0,
                'description' => 'سداد فاتورة من العميل ' . $this->patient->name
            ]
        ];
        
        $this->emit('refreshComponent');

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم دخول المريض بنجاح']);
    }

    public function notEnter(Invoice $invoice)
    {
        $invoice->update(['is_entered' => 0]);
        $this->emit('refreshComponent');

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم إلغاء دخول المريض بنجاح']);
    }


    public function render()
    {
        $invoices = Invoice::where('status', 'Unpaid')->where('type', 'package')->latest()->paginate(10);

        return view('livewire.invoices.pay-package', compact('invoices'));
    }
}
