<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Diagnose;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Diagnoses extends Component
{
    public $filter_dr,$filter_patient,$filter_depart,$dr_id,$patient_id,$department_id,$tooth,$taken,$treatment,$appointment_id,$time,$day,$period,$diagnose,$chief_complain,$sign_and_symptom,$other;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function rules(){
        return[
            'dr_id'=>'required',
            'patient_id'=>'required',
            'department_id'=>'required',
            'tooth'=>'nullable',
            'treatment'=>'required',
            'taken'=>'required',
            'chief_complain'=>'nullable',
            'other'=>'nullable',
            'sign_and_symptom'=>'nullable',
            'appointment_id'=>'required',
            'time'=>'required',
            'day'=>'required',
            'period'=>'required',
        ];
    }

    public function edit(Diagnose $diagnose){
        $this->tooth=$diagnose->tooth;
        $this->treatment=$diagnose->treatment;
        $this->taken=$diagnose->taken;
        $this->dr_id=$diagnose->dr_id;
        $this->department_id=$diagnose->department_id;
        $this->patient_id=$diagnose->patient_id;
        $this->period=$diagnose->period;
        $this->time=$diagnose->time;
        $this->day=$diagnose->day;
        $this->chief_complain=$diagnose->chief_complain;
        $this->other=$diagnose->other;
        $this->sign_and_symptom=$diagnose->sign_and_symptom;
        $this->appointment_id=$diagnose->appointment_id;
        $this->diagnose=$diagnose;
    }

    public function  save(){
        $data=$this->validate();
        $this->diagnose->update($data);
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully updated')]);
    }

    public function delete(Diagnose $diagnose){
        $diagnose->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }
    public function render()
    {
        $diagnoses=Diagnose::with(['appoint','dr'])->where(function($q){
            if($this->filter_dr){
                $q->where('dr_id',$this->filter_dr);
            }
            if($this->filter_patient){
                $q->where('patient_id',$this->filter_patient);
            }
            if($this->filter_depart){
                $q->where('department_id',$this->filter_depart);
            }
        })->latest()->paginate(10);
        $departments=Department::all();
        $doctors=User::doctors()->get();
        return view('livewire.diagnoses',compact('diagnoses','departments','doctors'));
    }
}
