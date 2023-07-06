<?php

namespace App\Http\Livewire\Reports;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ReceptionStaffReport extends Component
{
    public $receptions, $from, $to, $key;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->receptions = User::receptions()->get();
    }
    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('updated_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('updated_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('updated_at', '<=', $this->to);
        } else {
            $query;
        }
    }
    public function render()
    {
        $users = User::receptions()->with(['employee_invoices' => function ($q) {
            $this->between($q);
        }])->withCount(['patients' => function ($q) {
            $this->between($q);
        }, 'employee_appointments' => function ($q) {
            $this->between($q);
        }])->where(function ($q) {
            if ($this->key) {
                $q->where('id', $this->key);
            }
        })->paginate(10);
        return view('livewire.reports.reception-staff-report', compact('users'));
    }
}
