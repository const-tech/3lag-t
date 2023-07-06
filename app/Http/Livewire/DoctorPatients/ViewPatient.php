<?php

namespace App\Http\Livewire\DoctorPatients;

use App\Models\Appointment;
use App\Models\Diagnose;
use App\Models\PatientFile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ViewPatient extends Component
{
    public $patient, $screen = 'data', $invoice_status, $file, $file_name;
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    use WithFileUploads;
    protected function rules()
    {
        return [
            'file_name' => 'required',
            'file' => 'required',
        ];
    }

    public function save_file()
    {
        $data = $this->validate();
        $data['patient_id'] = $this->patient->id;
        $data['file_path'] = store_file($this->file, 'patients_file');
        $data['file_type'] = $this->file->getExtension();
        $data['file_size'] = $this->file->getSize();
        $data['employee_id'] = auth()->id();
        unset($data['file']);
        PatientFile::create($data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
        $this->reset(['file_name', 'file']);
    }

    public function delete_file(PatientFile $file)
    {
        $file->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $invoices = $this->patient->invoices()->with(['dr', 'employee'])->where(function ($q) {
            if ($this->invoice_status) {
                $q->where('status', $this->invoice_status);
            }
        })->latest()->paginate(5);
        $appoints = $this->patient->appointments()->with(['clinic', 'doctor'])->latest()->paginate(5);
        $diagnoses = $this->patient->diagnoses()->with(['department', 'dr'])->latest()->paginate(5);
        $files = $this->patient->files()->with(['patient', 'employee'])->latest()->paginate(5);
        $scanRequests = $this->patient->scanRequests()->with(['patient', 'doctor'])->latest()->paginate(5);
        $labRequests = $this->patient->labRequests()->with(['patient', 'doctor'])->latest()->paginate(5);
        return view('livewire.doctor-patients.view-patient', compact('labRequests', 'scanRequests', 'invoices', 'appoints', 'diagnoses', 'files'));
    }
}
