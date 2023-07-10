<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\Diagnose;
use App\Models\Department;
use App\Models\Appointment;
use App\Models\Package;
use App\Models\PatientFile;
use App\Models\PatientPackage;
use App\Models\ScanRequest;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Barryvdh\Debugbar\Facades\Debugbar;

class DoctorInterface extends Component
{
    use WithPagination;
    public $patient;
    public $patients_screen = 'transfers';
    public $screen = 'current';
    public $departments;
    public $department_id;
    public $appointment_id;
    public $selectedProduct;
    public $selectedProducts = [];
    public $new_appointment;
    public $items = [];
    public $product_id;
    public $notes;
    public $invoice_id;
    public $amount;
    public $total;
    public $cash;
    public $card;
    public $rest;
    public $discount = 0;
    public $tax;
    public $split;
    public $split_number;
    public $total_after_split;
    public $offers_discount;
    public $amount_after_offers_discount;
    public $scan_product_id;
    public $labs;
    public $categories;
    public $category_id;
    public $lab_id;
    public $dr_content;
    public $lab_cat_id;
    public $lab_serv_id;
    public $selected_department_id;
    public $scan_products;
    public $review_duration;
    public $review_date;
    public $review_time;
    public $selected_appointment;
    public $date;

    public $name;
    public $price;

    public $appointment_date;
    public $last_invoice;
    public $examine_patient = false, $type, $packagee, $package_id, $patient_package, $examine_session = false, $session_no, $session_diagnose;

    public $diagnosis = [
        'taken' => null,
        'treatment' => null,
        'tooth' => [],
        'body' => [],
        'complaint' => null,
        'clinical_examination' => null,
        'period' => 'morning',
        'chief_complain' => null,
        'sign_and_symptom' => null,
        'other' => null
    ];
    public $drugs = [];
    public $selected_drugs = [];
    public $drug_id;

    public function resetInputs()
    {
        $this->reset(['selected_drugs', 'patient', 'appointment_id', 'selectedProduct', 'selectedProducts', 'new_appointment', 'items', 'product_id', 'notes', 'invoice_id', 'amount', 'total', 'cash', 'card', 'rest', 'discount', 'tax', 'split', 'split_number', 'total_after_split', 'offers_discount', 'amount_after_offers_discount', 'scan_product_id', 'dr_content']);
    }
    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'diagnosis.taken' => 'required',
            'diagnosis.chief_complain' => 'nullable',
            'diagnosis.sign_and_symptom' => 'nullable',
            'diagnosis.other' => 'nullable',
            'diagnosis.treatment' => 'required',
            'diagnosis.tooth' => 'nullable',
            'diagnosis.body' => doctor()->is_dermatologist ? 'required' : 'nullable',
            'diagnosis.period' => 'nullable',
            'amount' => 'nullable',
            'total' => 'nullable',
            'rest' => 'nullable',
            'discount' => 'nullable',
            'notes' => 'nullable',
            'tax' => 'nullable',
            'date' => 'nullable|date',
            'type' => 'nullable',
        ];
    }

    public function selectPatient($id)
    {
        $this->selected_appointment = Appointment::with('child')->findOrFail($id);
        $this->patient = $this->selected_appointment->patient;
        $this->appointment_id = $id;
        $this->last_invoice = Invoice::where('patient_id', $this->patient->id)->where(function ($q) {
            $q->where('date', $this->selected_appointment->appointment_date)->orWhere('date', date('Y-m-d'));
        })->first();
    }

    public function selectPackage($id)
    {
        $this->patient_package = PatientPackage::findOrFail($id);
    }

    public function examine_patient()
    {
        if ($this->examine_patient == true) {
            $this->examine_patient = false;
        } else {
            $this->examine_patient = true;
        }
    }

    public function selectSession($id, $session)
    {
        $patient_package = PatientPackage::find($id);
        $this->examine_session = true;
        $this->session_no = $session;

        $this->session_diagnose = Diagnose::where('patient_id', $this->patient->id)->where('patient_package_id', $patient_package->id)->where('session_no', $this->session_no)->first();

        if ($this->session_diagnose) {
            $this->diagnosis['chief_complain'] = $this->session_diagnose->chief_complain;
            $this->diagnosis['sign_and_symptom'] = $this->session_diagnose->sign_and_symptom;
            $this->diagnosis['other'] = $this->session_diagnose->other;
            $this->diagnosis['taken'] = $this->session_diagnose->taken;
            $this->diagnosis['treatment'] = $this->session_diagnose->treatment;
        } else {
            $this->reset('diagnosis');
        }
    }



    //addDiagnosis

    public function add_product()
    {
        if ($this->patient) {
            if ($this->product_id) {
                $product = Product::with('department')->find($this->product_id);
                if ($product and $product->department_id = $this->department_id) {
                    $tax = 0;
                    if (setting()->tax_enabled and $this->patient->country_id != 1) {
                        $tax = $product->price * (setting()->tax_rate / 100);
                    }
                    $discount = 0;
                    $offer = null;
                    if (!$this->patient->group) {
                        if ($product->offer) {
                            $discount = $product->price * ($product->offer->rate / 100);
                            $offer = $product->offer->id;
                        }
                    }
                    $total = $product->price - $discount + $tax;
                    $this->items[] = ['invoice_id' => $this->invoice_id, 'product_id' => $product->id, 'product_name' => $product->name, 'price' => $product->price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department_id' => $product->department->id, 'department' => $product->department->name, 'is_lab' => $product->department->is_lab, 'is_scan' => $product->department->is_scan, 'tax' => $tax, 'offer_id' => $offer];
                    $this->computeForAll();
                    $this->product_id = null;
                } else {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('رقم الخدمة المدخل لا يتوفر في هذا القسم')]);
                    $this->product_id = null;
                }
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please select the patient first')]);
        }
    }

    public function updatedPackageId()
    {
        if (!$this->patient) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please select the patient first')]);
            $this->package_id = null;
            $this->packagee = null;
        } else {
            $package = Package::find($this->package_id);
            if ($package) {

                $this->total = 0;
                $this->tax = 0;
                $this->amount = 0;
                if (setting()->tax_enabled && setting()->tax_rate > 0 && $this->patient->country_id != 1) {
                    $this->tax = $package->total * (setting()->tax_rate / 100);
                }

                if ($this->split_number == "" or $this->split_number == 0) {
                    $this->split_number = 1;
                }

                $this->amount = $package->total;
                $this->total = $package->total + $this->tax;
                $this->card = $this->total;
                $this->packagee = $package;
                $this->total_after_split = $this->total / $this->split_number;
            }
        }
    }

    public function deletePackage()
    {
        $this->packagee = null;
        $this->package_id = null;
        $this->amount = 0;
        $this->total = 0;
        $this->card = 0;
        $this->tax = 0;
    }

    public function saveProduct()
    {
        $data = $this->validate([
            'name' => 'required',
            'price' => 'required',
            'department_id' => 'required',
        ]);

        Product::create($data);

        $this->reset();

        return redirect()->route('doctor.interface')->with('success', __('Saved successfully'));
    }

    public function delete_item($key)
    {
        unset($this->items[$key]);
        $this->computeForAll();
    }

    public function computeForAll()
    {
        $this->amount = array_reduce($this->items, function ($carry, $item) {
            $price = $item['price'] ? $item['price'] : 0;
            $carry += $price;
            return $carry;
        });

        /* $this->tax = array_reduce($this->items, function ($carry, $item) {
        $carry += $item['tax'];
        return $carry;
        }); */

        if (!$this->patient->group) {
            $this->offers_discount = array_reduce($this->items, function ($carry, $item) {
                $carry += $item['discount'];
                return $carry;
            });
        }

        if ($this->patient->group) {
            if ($this->patient->group->rate > 0) {
                $this->discount = $this->amount * $this->patient->group->rate / 100;
            }
        }

        $sub_total = $this->amount - $this->discount - $this->offers_discount;

        if (setting()->tax_enabled and $this->patient->country_id != 1) {
            $this->tax = $sub_total * (setting()->tax_rate / 100);
        }

        $this->total = $this->amount + $this->tax - $this->discount;

        $this->amount_after_offers_discount = $this->amount - $this->offers_discount;
        if ($this->split_number == "" or $this->split_number == 0) {
            $this->split_number = 1;
        }
        /* $this->total = $this->amount + $this->tax - $this->discount; */
        $this->total_after_split = $this->total / $this->split_number;
        $this->rest = $this->total - $this->discount;
        $this->cash = 0;
        $this->card = 0;
    }

    public function changeItemTotal($key)
    {
        $price = $this->items[$key]['price'] ? $this->items[$key]['price'] : 0;
        $this->items[$key]['price'] = $price;
        if (setting()->tax_enabled and $this->patient->country_id != 1) {
            $this->items[$key]['tax'] = $price * (setting()->tax_rate / 100);
        }
        $this->items[$key]['sub_total'] = $price + $this->items[$key]['tax'];
        $this->computeForAll();
    }

    public function addInvoice()
    {
        $data = $this->validate();
        $invoice = Invoice::latest()->first();
        $this->invoice_id = $invoice ? $invoice->id + 1 : 1;
        $data['invoice_number'] = $this->invoice_id;
        $data['patient_id'] = $this->patient->id;
        $data['dr_id'] = doctor()->id;
        $data['status'] = 'Unpaid';
        $data['employee_id'] = auth()->id();
        $data['department_id'] = $this->department_id;
        if (!$this->patient->group) {
            $data['discount'] = $this->offers_discount;
        }

        if ($this->package_id) {
            $data['package_id'] = $this->package_id;
        }

        if (!isset($data['tax'])) {
            $data['tax'] = 0;
        }

        $data['cash'] = 0;
        $data['card'] = 0;
        $data['discount'] = 0;

        $data['total'] = $this->total_after_split - $this->offers_discount;
        $data['rest'] = $this->total_after_split - $this->offers_discount;
        for ($i = 1; $i <= $this->split_number; $i++) {
            $invoice = Invoice::create($data);
            $invoice->products()->createMany($this->items);

            PatientPackage::create([
                'patient_id' => $this->patient->id,
                'package_id' => $this->package_id,
                'dayes_period' => $this->packagee->num_of_sessions,
                'session_period' => $this->packagee->session_period,
                'total_hours' =>  $this->packagee->session_period * $this->packagee->num_of_sessions,
                'package_price' => $this->packagee->total,
                'invoice_id' => $invoice->id,
            ]);
        }

        $appointment = doctor()->appointments()->find($this->appointment_id);
        //$appointment->update(['appointment_status' => 'examined']);



        $this->reset();
        session()->flash('success', 'تم اضافة الفاتورة بنجاح');
    }

    public function saveDiagnose()
    {
        $data = $this->validate([
            'diagnosis.taken' => 'required',
            'diagnosis.other' => 'nullable',
            'diagnosis.chief_complain' => 'nullable',
            'diagnosis.sign_and_symptom' => 'nullable',
            'diagnosis.treatment' => 'required',
            'diagnosis.tooth' => 'nullable',
            'diagnosis.body' => doctor()->is_dermatologist ? 'required' : 'nullable',
            'diagnosis.period' => 'nullable',
        ]);

        if ($this->session_no && $this->patient_package) {
            if ($this->session_diagnose) {
                $this->session_diagnose->update($this->diagnosis);
            } else {
                $diagnose = Diagnose::create(array_merge([
                    'appointment_id' => $this->appointment_id,
                    'patient_id' => $this->patient->id,
                    'dr_id' => doctor()->id,
                    'department_id' => doctor()->department_id,
                    'time' => date('H:i'),
                    'day' => date('Y-m-d'),
                    'session_no' => $this->session_no,
                    'patient_package_id' => $this->patient_package->id,
                ], $this->diagnosis));
                $diagnose->appoint->update(['attended_at' => Carbon::now()]);
            }
        } else {
            $diagnose = Diagnose::create(array_merge([
                'appointment_id' => $this->appointment_id,
                'patient_id' => $this->patient->id,
                'dr_id' => doctor()->id,
                'department_id' => doctor()->department_id,
                'time' => date('H:i'),
                'day' => date('Y-m-d'),
            ], $this->diagnosis));

            $this->screen = 'invoice';
            $diagnose->appoint->update(['attended_at' => Carbon::now()]);
        }


        session()->flash('success', 'تم اضافة التشخيص بنجاح');
    }

    //transferPatient
    public function transferPatient()
    {
        $data = array_merge([
            'appointment_status' => 'transferred',
        ], $this->new_appointment);
        $old_appointment = doctor()->appointments()->find($this->appointment_id);
        $old_appointment->update($data);
        /* Appointment::query()->create($data); */
        $this->resetInputs();
        session()->flash('success', 'تم تحويل المريض وانهاء الكشف بنجاح');
    }

    //endSession
    public function endSession()
    {
        $data = array_merge([
            'appointment_status' => 'examined',
        ], $this->new_appointment);

        $old_appointment = doctor()->appointments()->find($this->appointment_id);

        $old_appointment->update(['appointment_status' => 'examined']);

        $this->resetInputs();

        session()->flash('success', 'تم إنهاء الكشف بنجاح');
    }

    public function saveScan()
    {
        $data = $this->validate([
            'file' => 'required|mimes:pdf,jpg,png',
            'dr_content' => 'required',
        ]);
        $data['type'] = 'scan';
        $data['patient_id'] = $this->patient->id;
        PatientFile::create($data);
        $this->reset(['file', 'dr_content']);
        session()->flash('success', ' تم حفظ الأشعة بنجاح');
    }

    public function saveLab()
    {
        $data = $this->validate([
            'file' => 'required|mimes:pdf,jpg,png',
            'dr_content' => 'required',
        ]);
        $data['type'] = 'lab';
        $data['patient_id'] = $this->patient->id;
        PatientFile::create($data);
        $this->reset(['file', 'dr_content']);
        session()->flash('success', ' تم حفظ التحليل بنجاح');
    }

    public function scan_request()
    {
        $data = $this->validate([
            'scan_product_id' => 'required',
            'dr_content' => 'required',
        ]);
        unset($data['scan_product_id']);
        $data['dr_id'] = doctor()->id;
        $data['patient_id'] = $this->patient->id;
        $data['clinic_id'] = $this->department_id;
        $data['appointment_id'] = $this->appointment_id;
        $data['status'] = 'pending';
        $data['product_id'] = $this->scan_product_id;
        ScanRequest::create($data);
        $this->reset(['dr_content', 'scan_product_id', 'category_id', 'lab_id']);
        session()->flash('success', ' تم إرسال طلب الأشعة بنجاح');
    }

    public function mount()
    {
        //$this->drugs = Http::get(env('PHARMACY_API_URL') . '/drugs')->json()['data'] ?? [];
        //Debugbar::info($this->drugs);
        $this->department_id = doctor()->department_id;
        $this->departments = Department::where('id', doctor()->department_id)->orWhereIn('id', json_decode(doctor()->show_department_products) ?? [])->get();
        $department_scan_id = Department::where('is_scan', 1)->first()?->id;
        if ($department_scan_id) {
            $this->scan_products = Product::where('department_id', $department_scan_id)->get();
        }
        $this->new_appointment = [
            'appointment_date' => null,
            'appointment_time' => null,
            'doctor_id' => Doctor::query()->first()->id,
            'clinic_id' => Department::query()->first()->id,
        ];

        $this->date = date('Y-m-d');
    }
    //updatedServiceId
    public function updatedDrugId($id)
    {
        if ($id) {
            foreach ($this->drugs as $drug) {
                if ($drug['id'] == $id) {
                    $this->selected_drugs[] = $drug;
                    break;
                }
            }
        }
    }

    public function render()
    {
        $today_appointments = doctor()->appointments()->today()->where('appointment_status', 'confirmed')->orderBy('appointment_time')->get();
        $times = [];
        // get only hour from time type
        $from_morning = Carbon::parse(setting()->from_morning)->format('H');
        $to_morning = Carbon::parse(setting()->to_morning)->format('H');
        $from_evening = Carbon::parse(setting()->from_evening)->format('H');
        $to_evening = Carbon::parse(setting()->to_evening)->format('H');
        $reservedTimes = [];
        if ($this->review_duration == 'morning') {
            $times = [];
            for ($i = $from_morning; $i < $to_morning; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
            }
            $reservedTimes = Appointment::where('appointment_date', $this->review_date)
                ->where('appointment_time', '>=', $from_morning)
                ->where('appointment_time', '<=', $to_morning)
                ->pluck('appointment_time')->toArray();
        } elseif ($this->review_duration == 'evening') {
            $times = [];

            for ($i = $from_evening; $i < $to_evening; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
            }
            $reservedTimes = Appointment::where('appointment_date', $this->appointment_date)
                ->where('appointment_time', '>=', $from_evening)
                ->where('appointment_time', '<=', $to_evening)
                ->pluck('appointment_time')->toArray();
        }

        $packages = Package::get();
        return view('livewire.doctor-interface', compact('today_appointments', 'times', 'reservedTimes', 'packages'));
    }
    // drug_request
    public function drug_request()
    {
        $drugsIds = collect($this->drugs)->pluck('id')->toArray();
        $qq = [];
        for ($i = 0; $i < count($drugsIds); $i++) {
            $qq[] = 1;
        }
        $data = [
            'doctor_name' => doctor()->name,
            'doctor_phone' => doctor()->email,
            'patient_name' => $this->patient->name,
            'patient_phone' => $this->patient->phone,
            'patient_national_id' => $this->patient->civil,
            'clinic_name' => doctor()->department->name,
            'drugs' => $drugsIds,
            'drugs_quantity' => $qq,
            'notes' => $this->dr_content,
        ];
        Debugbar::info($data);
        $res = Http::post(env('PHARMACY_API_URL') . '/drug-request', $data);
        Debugbar::info($res->body());
        $this->resetInputs();
        session()->flash('success', ' تم إرسال طلب الأدوية بنجاح');
    }

    public function review()
    {
        $data = $this->validate([
            'review_duration' => 'required',
            'review_date' => 'required',
            'review_time' => 'required',
        ]);
        $data['appointment_time'] = $data['review_time'];
        $data['appointment_date'] = $data['review_date'];
        $data['appointment_duration'] = $data['review_duration'];
        $data['patient_id'] = $this->patient->id;
        $data['doctor_id'] = auth()->id();
        $data['clinic_id'] = $this->department_id;
        $data['appointment_number'] = Str::random(10);
        $data['appointment_status'] = 'confirmed';
        $data['review'] = true;
        $data['appointment_id'] = $this->appointment_id;
        Appointment::create($data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم إضافة الموعد بنجاح']);
    }
}
