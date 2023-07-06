<?php

namespace App\Http\Livewire\Patients;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Country;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Insurance;
use App\Models\PatientGroup;
use Livewire\WithFileUploads;
use App\Services\Hijri\Datetime;

class AddPatient extends Component
{
    public $civil, $first_name, $user_id, $department_id, $gender, $age_type, $city_id, $country_id, $birthdate, $age, $phone, $notes_health_record, $goal_of_visit, $penicillin, $teeth_problems, $drugs, $heart, $pressure, $fever, $anemia, $thyroid_glands, $liver, $sugar, $tb, $kidneys, $convulsion, $other_diseases, $image, $date, $insurance_id, $insurance, $is_pregnant, $patient_group_id;
    use WithFileUploads;
    protected function rules()
    {
        return [
            'civil' => 'required|numeric|digits:10|unique:patients,civil',
            'first_name' => 'required',
            'phone' => 'required',
            'gender' => (in_array(setting()->age_or_gender, ['sex', 'all']) ? 'required' : 'nullable') . '|in:male,female',
            'age_type' => (in_array(setting()->age_or_gender, ['age', 'all']) ? 'required' : 'nullable') . '|in:adult,baby',
            'birthdate' => 'nullable',
            'country_id' => 'required',
            'city_id' => 'nullable',
            'patient_group_id' => 'nullable',
            'user_id' => 'nullable',
            'department_id' => 'nullable',
            'age' => 'nullable',
            'notes_health_record' => 'nullable',
            'goal_of_visit' => 'nullable',
            'penicillin' => 'nullable',
            'teeth_problems' => 'nullable',
            'drugs' => 'nullable',
            'heart' => 'nullable',
            'fever' => 'nullable',
            'pressure' => 'nullable',
            'anemia' => 'nullable',
            'thyroid_glands' => 'nullable',
            'liver' => 'nullable',
            'sugar' => 'nullable',
            'tb' => 'nullable',
            'kidneys' => 'nullable',
            'convulsion' => 'nullable',
            'other_diseases' => 'nullable',
            'image' => 'nullable',
            'date' => 'nullable',
            'insurance_id' => 'nullable',
            'is_pregnant' => 'nullable',
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $data = $this->validate();
        $data['user_id'] = auth()->id();
        // $data['department_id'] = 1;
        $data['image'] = $this->image ? store_file($this->image, 'patients') : null;
        Patient::create($data);
        if (auth()->user()->type == 'scan') {
            return redirect()->route('scan.patients.index')->with('success', __('Successfully added'));
        } elseif (auth()->user()->type == 'lab') {
            return redirect()->route('lab.patients.index')->with('success', __('Successfully added'));
        } elseif (auth()->user()->type == 'dr') {
            return redirect()->route('doctor.patients.index')->with('success', __('Successfully added'));
        } else {
            return redirect()->route('front.patients.index')->with('success', __('Successfully added'));
        }
    }
    public function updatedInsurance()
    {
        $this->insurance_id = null;
    }
    public function updatedBirthdate()
    {
        if ($this->birthdate) {
            $toDate = Carbon::now();
            $fromDate = Carbon::parse($this->birthdate);
            $this->age = $toDate->diffInYears($fromDate);
        } else {
            $this->reset('age');
        }
    }
    public function render()
    {
        $patient_groups = PatientGroup::all();
        $cities = City::all();
        $countries = Country::all();
        $insurances = Insurance::all();
        return view('livewire.patients.add-patient', compact('cities', 'countries', 'insurances', 'patient_groups'));
    }
}
