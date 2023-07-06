<?php

namespace App\Http\Livewire\Reports;

use App\Models\PatientGroup;
use App\Models\Purchase;
use Livewire\Component;
use Livewire\WithPagination;

class PatientGroupsReport extends Component
{
    public $to, $from;
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
        $patient_groups = PatientGroup::with('patients')->where(function ($q) {
            $this->between($q);
        })->get();
        return view('livewire.reports.patient-groups-report', compact('patient_groups'));
    }
}
