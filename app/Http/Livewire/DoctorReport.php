<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class DoctorReport extends Component
{
    public $from,$to,$status;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function resetForm()
    {
        $this->reset('from','to','status');
    }
    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } elseif($this->status) {
           $query->where('status', $this->status);
        } else {
            $query;
        }
    }
    public function render()
    {
        $invoices=doctor()->invoices()->where(function($q){
            $this->between($q);
        })->latest()->paginate(10);
        $rate=0;
        foreach($invoices as $invoice){
            $rate += $invoice->total * (doctor()->rate/100);
        }
        return view('livewire.doctor-report',compact('invoices','rate'));
    }
}
