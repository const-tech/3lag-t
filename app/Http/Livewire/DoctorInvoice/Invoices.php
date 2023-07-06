<?php

namespace App\Http\Livewire\DoctorInvoice;

use Livewire\Component;
use Livewire\WithPagination;

class Invoices extends Component
{
    use withPagination;
    protected $paginationTheme = 'bootstrap';
    public $from,$to,$status;
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
    // resetForm
    public function resetForm()
    {
        $this->reset('from','to','status');
    }
    public function render()
    {
        return view('livewire.doctor-invoice.invoices',[
            'invoices' => doctor()->invoices()->with(['dr','employee','patient'])->where(function($q){
                $this->between($q);
            })->where(function ($q){
                if($this->status){
                    $q->where('status',$this->status);
                }
            })->latest()->paginate(10),
        ]);
    }
}
