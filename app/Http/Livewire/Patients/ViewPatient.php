<?php

namespace App\Http\Livewire\Patients;

use App\Models\Appointment;
use App\Models\LabRequest;
use App\Models\PatientFile;
use App\Models\ScanRequest;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ViewPatient extends Component
{
    public $patient, $screen = 'data', $screen_file = 'medical_files', $invoice_status, $scan_file, $lab_file, $file_name, $scan_dr_content, $lab_dr_content, $file, $type;
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

        if ($this->screen_file == 'medical_files') {
            $data['type'] = 'medical_files';
        } elseif ($this->screen_file == 'sick_leave') {
            $data['type'] = 'sick_leave';
        } else {
            $data['type'] = 'prescription';
        }

        PatientFile::create($data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
        $this->reset(['file_name', 'file']);
    }

    public function delete_file(PatientFile $file)
    {
        $file->delete();
        delete_file($file->file_path);
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
        $scanRequests = $this->patient->scanRequests()->latest()->paginate(5);
        $labRequests = $this->patient->labRequests()->latest()->paginate(5);
        return view('livewire.patients.view-patient', compact('invoices', 'appoints', 'diagnoses', 'files', 'scanRequests', 'labRequests'));
    }
    public function storeFileScan(ScanRequest $scan)
    {
        $this->validate([
            'scan_file' => 'required', // 1MB Max
            'scan_dr_content' => 'nullable', // 1MB Max
        ]);

        $scan->file = store_file($this->scan_file, 'scans');
        $scan->scan_content = $this->scan_dr_content;
        $scan->status = 'done';
        $scan->update();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
        $this->reset(['scan_dr_content', 'scan_file']);
    }
    public function storeFileLab(LabRequest $lap)
    {
        $data = $this->validate([
            'lab_file' => 'required', // 1MB Max
            'lab_dr_content' => 'nullable', // 1MB Max
        ]);
        $lap->file = store_file($this->lab_file, 'labs');
        $lap->lab_content = $this->lab_dr_content;
        $lap->status = 'done';
        $lap->update();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
        $this->reset(['lab_dr_content', 'lab_file']);
    }
}
