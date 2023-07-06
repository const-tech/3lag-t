<?php

namespace App\Http\Livewire\Reports;

use App\Models\Invoice;
use App\Models\Offer;
use Livewire\Component;
use Livewire\WithPagination;

class ReportOffers extends Component
{
    public $offer,$from,$to;
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
        $this->offer=Offer::findOrFail(request('offer'));
    }
    public function render()
    {
        $invoices=Invoice::whereRelation('products','offer_id',$this->offer->id)->where(function($q){
            $this->between($q);
        })->latest()->paginate();
        return view('livewire.reports.report-offers',compact('invoices'));
    }
}
