<?php

namespace App\Http\Livewire\Reports;

use App\Models\Category;
use App\Models\Expense;
use Livewire\Component;
use Livewire\WithPagination;

class ExpensesReport extends Component
{

    public $to,$from,$category;
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
    public function render()
    {
        $categories=Category::all();
        $expenses=Expense::with('category')->where(function($q){
            $this->between($q);
            if($this->category){
                $q->where('category_id',$this->category);
            }
        })->latest()->paginate(10);
        return view('livewire.reports.expenses-report',compact('expenses','categories'));
    }
}
