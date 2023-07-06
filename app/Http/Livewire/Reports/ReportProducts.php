<?php

namespace App\Http\Livewire\Reports;

use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ReportProducts extends Component
{
    public $product,$from,$to;
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
    public function mount(){
        $this->product=Product::findOrFail(request('product'));
    }
    public function render()
    {
        $invoices=Invoice::whereRelation('products','product_id',$this->product->id)->where(function($q){
            $this->between($q);
        })->latest()->paginate();
        return view('livewire.reports.report-products',compact('invoices'));
    }
}
