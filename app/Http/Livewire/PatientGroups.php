<?php

namespace App\Http\Livewire;

use App\Models\PatientGroup;
use Livewire\Component;
use Livewire\WithPagination;

class PatientGroups extends Component
{
    use WithPagination;
    public $name, $parent, $rate, $patient_group;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'name' => 'required',
            'rate' => 'required|numeric',
            'parent' => 'nullable',
        ];
    }

    public function edit(PatientGroup $patient_group)
    {
        $this->name              = $patient_group->name;
        $this->rate            = $patient_group->rate;
        $this->parent            = $patient_group->parent;
        $this->patient_group     = $patient_group;
    }

    public function save()
    {
        $data = $this->validate();
        if ($this->patient_group) {
            $this->patient_group->update($data);
        } else {
            PatientGroup::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }

    public function delete(PatientGroup $patient_group)
    {
        $patient_group->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }


    public function render()
    {
        $patient_groups = PatientGroup::with('patients')->latest()->paginate(10);

        return view('livewire.patient-groups', compact('patient_groups'));
    }
}
