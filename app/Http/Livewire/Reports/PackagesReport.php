<?php

namespace App\Http\Livewire\Reports;

use App\Models\Invoice;
use App\Models\Package;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class PackagesReport extends Component
{
    public $package, $from, $to;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
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
    public function mount()
    {
        $this->package = Package::findOrFail(request('package'));
    }
    public function render()
    {
        $invoices = Invoice::where('package_id', $this->package->id)->where(function ($q) {
            $this->between($q);
        })->latest()->paginate();
        return view('livewire.reports.packages-report', compact('invoices'));
    }
}
