<?php

namespace App\Http\Livewire\Reports;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class PatientReport extends Component
{
    public $from,$to,$status,$patient_key,$patient_name,$phone_number,$pay_way,$Clinic_type,$doctor,$patient;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function get_patient()
    {
        $this->patient = Patient::where('id', $this->patient_key)->orWhere('civil', $this->patient_key)->first();

        if ($this->patient) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Patient data has been retrieved successfully')]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => __('No results found')]);
        }
    }
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

    }
    public function render()
    {

        $doctors=Doctor::all();
        $departments=Department::all();
        $invoices=[];
        if($this->patient){
        $invoices=$this->patient->invoices()->where(function($q){
            $this->between($q);
            if ( $this->pay_way == "cash") {
                $q->where('cash','>',0);
            }
            if ($this->pay_way == "card") {
                $q->where('card','>',0);
            }
            if ($this->pay_way == "bank") {
                $q->where('bank','>',0);
            }
            if ($this->pay_way == "visa") {
                $q->where('visa','>',0);
            }
            if ($this->pay_way == "mastercard") {
                $q->where('mastercard','>',0);
            }
            if ($this->Clinic_type) {
                $q->where('department_id', $this->Clinic_type);
            }
            if ($this->doctor) {
                $q->where('dr_id', $this->doctor);
            }
        })->latest()->paginate(10);
    }
        return view('livewire.reports.patient-report',compact('doctors','departments','invoices'));
    }
}
