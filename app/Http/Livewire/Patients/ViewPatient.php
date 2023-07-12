<?php

namespace App\Http\Livewire\Patients;

use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\LabRequest;
use App\Models\PatientFile;
use App\Models\PatientPackage;
use App\Models\ScanRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class ViewPatient extends Component
{
    public $patient, $screen = 'data', $screen_file = 'medical_files', $invoice_status, $scan_file, $lab_file, $file_name, $scan_dr_content, $lab_dr_content, $file, $type, $package_id, $patient_package;
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


    public function packageId($id)
    {
        $this->package_id = $id;

        $this->patient_package = PatientPackage::findOrFail($this->package_id);
    }


    public function renewPackage()
    {

        $invoice = Invoice::latest()->first();
        $invoice_id = $invoice ? $invoice->id + 1 : 1;

        $invoice = Invoice::create([
            'invoice_number' => $invoice_id,
            'patient_id' => $this->patient->id,
            'date' => date('Y-m-d'),
            'dr_id' => $this->patient_package->invoice->dr->id,
            'status' => 'Unpaid',
            'employee_id' => auth()->id(),
            'department_id' => $this->patient_package->invoice->dr->department_id,
            'total' => $this->patient_package->package->price,
            'type' => 'package',
            'package_id' => $this->patient_package->package->id,
        ]);

        $new_package = PatientPackage::create([
            'patient_id' => $this->patient->id,
            'package_id' => $this->patient_package->package->id,
            'dayes_period' => $this->patient_package->dayes_period,
            'session_period' => $this->patient_package->session_period,
            'total_hours' => $this->patient_package->total_hours,
            'package_price' => $this->patient_package->package->price,
            'invoice_id' => $invoice->id,
        ]);

        $appointments = Appointment::where('patient_id', $this->patient->id)->where('patient_package_id', $this->patient_package->id)->get();

        foreach ($appointments as $key => $appointment) {
            Appointment::create([
                'appointment_date' => Carbon::parse($appointment->appointment_date)->addMonth()->format('Y-m-d'),
                'appointment_time' => $appointment->appointment_time,
                'patient_id' => $this->patient->id,
                'employee_id' => auth()->id(),
                'doctor_id' => $this->patient_package->invoice->dr->id,
                'clinic_id' => $this->patient_package->invoice->dr->department_id,
                'appointment_status' => 'pending',
                'appointment_number' => Str::random(10),
                'patient_package_id' => $new_package->id,
            ]);
        }

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم تجديد الباكدج بنجاح']);

        $this->emit('refreshComponent');
    }

    public function cancelPackage()
    {
        $this->patient_package->delete();

        $invoice = Invoice::where('package_id', $this->patient_package->package->id)->where('patient_id', $this->patient->id)->latest()->first();
        $invoice->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم إلغاء الباكدج بنجاح']);

        $this->emit('refreshComponent');
    }
}
