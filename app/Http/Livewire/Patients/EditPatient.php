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

class EditPatient extends Component
{
    public $patient, $civil, $first_name, $user_id, $department_id, $gender, $age_type, $city_id, $country_id, $birthdate, $age, $phone, $notes_health_record, $goal_of_visit, $penicillin, $teeth_problems, $drugs, $heart, $pressure, $fever, $anemia, $thyroid_glands, $liver, $sugar, $tb, $kidneys, $convulsion, $other_diseases, $image, $date, $insurance_id, $insurance, $patient_group_id;
    use WithFileUploads;
    protected function rules()
    {
        return [
            'civil' => 'required|numeric|digits:10|unique:patients,civil,' . $this->patient->id,
            'first_name' => 'required',
            'phone' => 'required',
            'gender' => 'in:male,female' . (in_array(setting()->age_or_gender, ['sex', 'all']) ? '|required' : ''),
            'age_type' => 'in:adult,baby' . (in_array(setting()->age_or_gender, ['age', 'all']) ? '|required' : ''),
            'birthdate' => 'nullable',
            'country_id' => 'required',
            'patient_group_id' => 'nullable',
            'user_id' => 'nullable',
            'age' => 'nullable',
            'notes_health_record' => 'nullable',
            'goal_of_visit' => 'nullable',
            'penicillin' => 'nullable',
            'teeth_problems' => 'nullable',
            'drugs' => 'nullable',
            'heart' => 'nullable',
            'fever' => 'nullable',
            'pressure' => 'nullable',
            'city_id' => 'nullable',
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
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /* public function calculateAge()
    {
    if ($this->birthdate != '' && setting()->birthdate_type == 'hijri') {
    $date = $this->birthdate;
    $date = explode('/', $date);
    $date = $date[2] . '-' . $date[1] . '-' . $date[0];
    $date = new \DateTime($date);
    $hijriDate = new \DateTime((new Datetime())->format('_j-_m-_Y'));
    $interval = $hijriDate->diff($date);
    $this->age = $interval->y;
    } elseif ($this->birthdate != '' && setting()->birthdate_type == 'gregorian') {
    $toDate = Carbon::now();
    $fromDate = Carbon::parse($this->birthdate);
    $this->age = $toDate->diffInYears($fromDate);
    }
    } */

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

    public function save()
    {
        $data = $this->validate();
        $data['user_id'] = $this->patient->user_id;
        if ($this->image) {
            delete_file($this->patient->image);
            $data['image'] = store_file($this->image, 'patients');
        } else {
            $data['image'] = $this->patient->image;
        }
        if ($this->patient_group_id == '') {
            $data['patient_group_id'] = null;
        }
        $this->patient->update($data);
        return redirect()->route('front.patients.index')->with('success', __('Successfully updated'));
    }

    public function mount($patient)
    {
        $this->patient = $patient;
        $this->civil = $patient->civil;
        $this->first_name = $patient->first_name;
        $this->gender = $patient->gender;
        $this->city_id = $patient->city_id;
        $this->patient_group_id = $patient->patient_group_id;
        $this->country_id = $patient->country_id;
        $this->birthdate = $patient->birthdate;
        $this->age = $patient->age;
        $this->phone = $patient->phone;
        $this->notes_health_record = $patient->notes_health_record;
        $this->goal_of_visit = $patient->goal_of_visit;
        $this->penicillin = $patient->penicillin;
        $this->teeth_problems = $patient->teeth_problems;
        $this->drugs = $patient->drugs;
        $this->heart = $patient->heart;
        $this->pressure = $patient->pressure;
        $this->fever = $patient->fever;
        $this->anemia = $patient->anemia;
        $this->thyroid_glands = $patient->thyroid_glands;
        $this->liver = $patient->liver;
        $this->sugar = $patient->sugar;
        $this->tb = $patient->tb;
        $this->kidneys = $patient->kidneys;
        $this->convulsion = $patient->convulsion;
        $this->insurance = $patient->insurance_id ? true : false;
        $this->insurance_id = $patient->insurance_id;
        $this->other_diseases = $patient->other_diseases;
        $this->date = $patient->date;
        $this->age_type = $patient->age_type;
    }

    public function updatedInsurance()
    {
        $this->insurance_id = null;
    }
    public function render()
    {
        $patient_groups = PatientGroup::all();
        $cities = City::all();
        $countries = Country::all();
        $insurances = Insurance::all();
        return view('livewire.patients.edit-patient', compact('cities', 'countries', 'insurances', 'patient_groups'));
    }
}
