<?php

namespace App\Http\Livewire\Invoices;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Product;
use App\Models\Service;
use Livewire\Component;
use App\Models\Department;
use App\Models\LabCategory;
use App\Models\ScanService;

class AddInvoices extends Component
{
    public $patient_key, $patient, $department_id, $items = [], $product_id, $notes, $invoice_id, $amount, $total, $cash, $bank, $card, $rest, $discount = 0, $status, $dr_id, $tax, $offers_discount, $amount_after_offers_discount, $split, $split_number, $total_after_split, $lab_cat_id, $lab_serv_id, $scan_services, $scan_serv_i, $installment_company, $visa, $mastercard, $date;
    protected function rules()
    {
        return [
            'patient' => 'required',
            'department_id' => 'required',
            'amount' => 'required',
            'total' => 'required',
            'cash' => 'required_unless:installment_company,1',
            'bank' => 'required_unless:installment_company,1',
            'visa' => 'required_unless:installment_company,1',
            'mastercard' => 'required_unless:installment_company,1',
            'card' => 'required_unless:installment_company,1',
            'rest' => 'required',
            'discount' => 'required',
            'notes' => 'nullable',
            'installment_company' => 'nullable',
            'status' => 'required_without:installment_company',
            'dr_id' => 'nullable',
            'tax' => 'nullable',
            'date' => 'required|date',
            'offers_discount' => 'nullable',
        ];
    }
    public function get_patient()
    {
        $this->patient = Patient::where('id', $this->patient_key)->orWhere('civil', $this->patient_key)->first();
        if ($this->patient) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Patient data has been retrieved successfully')]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
        }
    }

    public function add_product()
    {
        if ($this->patient) {
            $product = null;
            if ($this->product_id) {
                $product = Product::with('department')->find($this->product_id);
                $this->department_id = $this->department_id ? $this->department_id : $product->department_id;
                if ($product and $product->department_id == $this->department_id) {
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
        if (!$this->installment_company) {
        $carry += $item['tax'];
        return $carry;
        }
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

        if (!$this->installment_company) {
            if (setting()->tax_enabled and $this->patient->country_id != 1) {
                $this->tax = $sub_total * (setting()->tax_rate / 100);
            }
        }

        $this->total = $this->amount + $this->tax - $this->discount - $this->offers_discount;

        $this->amount_after_offers_discount = $this->amount - $this->offers_discount;
        if ($this->split_number == "" or $this->split_number == 0) {
            $this->split_number = 1;
        }
        $this->total_after_split = $this->total / $this->split_number;
        /* $this->discount = array_reduce($this->items, function ($carry, $item) {
        $carry += $item['discount'];
        return $carry;
        }); */

        /* $this->total = $this->amount + $this->tax - $this->discount; */
        $this->rest = $this->total;
        $this->cash = $this->total;
        $this->calculateNet();
    }

    public function calculateNet()
    {
        $this->card = $this->card == "" ? 0 : $this->card;
        $this->cash = $this->cash == "" ? 0 : $this->cash;
        $this->bank = $this->bank == "" ? 0 : $this->bank;
        $this->mastercard = $this->mastercard == "" ? 0 : $this->mastercard;
        $this->visa = $this->visa == "" ? 0 : $this->visa;
        $this->discount = $this->discount == "" ? 0 : $this->discount;
        $this->rest
            = $this->total
            - ($this->card + $this->cash + $this->bank + $this->visa + $this->mastercard);
    }


    public function updatedCash()
    {
        $this->calculateMethods();
        // if ($this->cash || $this->cash == 0) {
        //     $this->card = 0;
        //     $this->visa = 0;
        //     $this->bank = 0;
        //     $this->mastercard = 0;
        //     $this->rest = $this->total - $this->cash;
        // } else {
        //     $this->cash = 0;
        //     $this->rest = $this->total;
        // }
    }

    public function updatedCard()
    {
        $this->calculateMethods();

        // if ($this->card) {
        //     if ($this->cash || $this->cash == 0) {
        //         $this->rest = 0;
        //         $this->cash = $this->total;
        //         $this->cash = $this->cash - ($this->card + $this->visa + $this->bank + $this->mastercard) - $this->rest;
        //     } else {
        //         $this->cash = 0;
        //         $this->rest = $this->total;
        //     }
        // } else {
        //     $this->card = 0;
        //     $this->rest = $this->total - ($this->cash + $this->card + $this->visa + $this->bank + $this->mastercard);
        // }
    }
    public function updatedVisa()
    {
        $this->calculateMethods();

        // if ($this->visa) {
        //     $this->cash = $this->total;
        //     if ($this->cash) {
        //         $this->cash = $this->cash - ($this->card + $this->visa + $this->bank + $this->mastercard) - $this->rest;
        //     } else {
        //         $this->cash = $this->total;
        //     }
        // } else {
        //     $this->visa = 0;
        //     $this->cash = $this->total;
        //     $this->cash = $this->cash - ($this->card + $this->visa + $this->bank + $this->mastercard) - $this->rest;
        // }
    }
    public function updatedBank()
    {
        $this->calculateMethods();

        // if ($this->bank) {
        //     $this->cash = $this->total;
        //     if ($this->cash) {
        //         $this->cash = $this->cash - ($this->card + $this->visa + $this->bank + $this->mastercard) - $this->rest;
        //     } else {
        //         $this->cash = $this->total;
        //     }
        // } else {
        //     $this->bank = 0;
        //     $this->cash = $this->total;
        //     $this->cash = $this->cash - ($this->card + $this->visa + $this->bank + $this->mastercard) - $this->rest;
        // }
    }
    public function updatedMastercard()
    {
        $this->calculateMethods();

        // if ($this->mastercard) {
        //     $this->cash = $this->total;
        //     if ($this->cash) {
        //         $this->cash = $this->cash - ($this->card + $this->visa + $this->bank + $this->mastercard) - $this->rest;
        //     } else {
        //         $this->cash = $this->total;
        //     }
        // } else {
        //     $this->mastercard = 0;
        //     $this->cash = $this->total;
        //     $this->cash = $this->cash - ($this->card + $this->visa + $this->bank + $this->mastercard) - $this->rest;
        // }
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

    public function submit()
    {
        $data = $this->validate();

        if ($this->status) {
            if ($this->status == 'Paid') {
                if ($this->rest != 0) {
                    $this->addError('rest', 'لا يمكن عمل الحاله مسدده مع وجود متبقي مبلغ');
                    $errors = $this->getErrorBag();
                    $errors->add('rest', 'لا يمكن عمل الحاله مسدده مع وجود متبقي مبلغ');
                    return redirect()->back();
                }
            }
            if ($this->status == 'tmara') {
                $data['installment_company'] = 1;
                $data['status'] = 'Paid';
                $installment_company_tax = $this->total * (setting()->installment_company_tax / 100);
                $data['installment_company_tax'] = $installment_company_tax;
                if ($this->total > 2500) {
                    $installment_company_amount_tax = $this->total * (setting()->installment_company_max_amount_tax / 100);
                    $data['installment_company_max_amount_tax'] = $installment_company_amount_tax;
                    $data['installment_company_min_amount_tax'] = 0;
                } else {
                    $installment_company_amount_tax = $this->total * (setting()->installment_company_min_amount_tax / 100);
                    $data['installment_company_max_amount_tax'] = 0;
                    $data['installment_company_min_amount_tax'] = $installment_company_amount_tax;
                }
                $data['installment_company_rest'] = $this->total - $installment_company_tax - $installment_company_amount_tax;
                $data['tax'] = 0;
            }
            if ($this->status == 'tab') {
                $data['tab'] = 1;
            }
        }
        $data['invoice_number'] = $this->invoice_id;
        $data['patient_id'] = $this->patient->id;
        $data['employee_id'] = auth()->id();
        $data['total'] = $this->total_after_split;
        if (!isset($data['tax'])) {
            $data['tax'] = 0;
        }
        for ($i = 1; $i <= $this->split_number; $i++) {
            $invoice = Invoice::create($data);
        }
        $invoice->products()->createMany($this->items);
        if ($this->status == 'Paid') {
            foreach ($this->items as $item) {
                if ($item['is_lab']) {
                    $this->patient->labRequests()->create(['product_id' => $item['product_id'], 'doctor_id' => auth()->id(), 'clinic_id' => $item['department_id']]);
                }
                if ($item['is_scan']) {
                    $this->patient->scanRequests()->create(['product_id' => $item['product_id'], 'dr_id' => auth()->id(), 'clinic_id' => $item['department_id']]);
                }
            }
        }
        return redirect()->route('front.invoices.index')->with('success', __('Saved successfully'));
    }

    public function updatedStatus()
    {
        if ($this->status == 'tmara') {
            $this->cash = 0;
            $this->bank = 0;
            $this->visa = 0;
            $this->mastercard = 0;
            $this->card = 0;
        }
    }

    public function mount()
    {
        $invoice = Invoice::latest()->first();
        $this->invoice_id = $invoice ? $invoice->id + 1 : 1;
        $this->scan_services = ScanService::all();
        $this->cash = 0;
        $this->card = 0;
        $this->bank = 0;
        $this->visa = 0;
        $this->rest = 0;
        $this->date = date('Y-m-d');
        if(request('patient_id')){
            $this->patient_key=request('patient_id');
            $this->get_patient();
        }
    }

    public function render()
    {
        $departments = Department::get();
        $lab_categories = LabCategory::all();
        $lab_services = Service::where('category_id', $this->lab_cat_id)->get();
        $doctors = User::doctors()->where('department_id', $this->department_id)->get();
        $products = Product::where('department_id', $this->department_id)->get();
        return view('livewire.invoices.add-invoices', compact('doctors', 'departments', 'products', 'lab_categories', 'lab_services'));
    }

    protected function calculateMethods()
    {
        $total = ((int) $this->card) + ((int) $this->cash) + ((int) $this->mastercard) + ((int) $this->bank) + ((int) $this->visa);

        if ($total > $this->total) {
            // do {
            if ($this->card != 0) {
                $this->card = 0;
            } elseif ($this->cash != 0) {
                $this->cash = 0;
            } elseif ($this->mastercard != 0) {
                $this->mastercard = 0;
            } elseif ($this->bank != 0) {
                $this->bank = 0;
            } elseif ($this->visa != 0) {
                $this->visa = 0;
            }
            // } while ($total > $this->total);
        }
        $total = ((int) $this->card) + ((int) $this->cash) + ((int) $this->mastercard) + ((int) $this->bank) + ((int) $this->visa);

        $this->rest = ((int) $this->total) - (int) $total;
    }


    public function manualCalculate()
    {
        $this->calculateMethods();
    }
}
