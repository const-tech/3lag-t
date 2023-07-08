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
use App\Models\Package;
use App\Models\ScanService;

class EditInvoice extends Component
{
    public $invoice, $patient_key, $patient, $department_id, $items = [], $product_id, $notes, $invoice_id, $amount = 0, $total, $cash = 0, $bank = 0, $card = 0, $rest, $discount = 0, $status, $tasdeed = false, $offers_discount, $amount_after_offers_discount, $split, $split_number, $total_after_split, $lab_cat_id, $lab_serv_id, $scan_services, $scan_serv_id, $installment_company, $visa, $mastercard, $tax, $dr_id, $date, $type, $packagee, $package_id;
    protected function rules()
    {
        return [
            'patient' => 'required',
            'department_id' => 'required',
            'amount' => 'required',
            'total' => 'required',
            'cash' => 'required',
            'bank' => 'required',
            'visa' => 'required',
            'mastercard' => 'required',
            'card' => 'required',
            'rest' => 'required',
            'discount' => 'required',
            'notes' => 'nullable',
            'installment_company' => 'nullable',
            'status' => 'required_without:installment_company',
            'dr_id' => 'nullable',
            'tax' => 'nullable',
            'offers_discount' => 'nullable',
            'date' => 'required|date',
            'type' => 'nullable',
            'package_id' => 'nullable',
            
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

    /*     public function add_product()
    {
    if($this->patient){
    if ($this->product_id ) {
    $product = Product::with('department')->findOrFail($this->product_id);
    $tax = 0;
    if (setting()->tax_enabled and $this->patient->country_id != 1) {
    $tax = $product->price * (setting()->tax_rate / 100);
    }
    $discount=0;
    $offer=null;
    if($product->offer){
    $discount=$product->price * ($product->offer->rate / 100);
    $offer=$product->offer->id;
    }
    $total=$product->price-$discount+$tax;
    $this->items[] = ['invoice_id' => $this->invoice_id, 'product_id' => $product->id, 'product_name' => $product->name, 'price' => $product->price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department' => $product->department->name, 'tax' => $tax,'offer_id'=>$offer];
    $this->computeForAll();
    $this->product_id = null;
    }
    }else{
    $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => __('Please select the patient first')]);
    }
    } */

    public function add_product()
    {
        if ($this->patient) {
            if ($this->product_id) {
                $product = Product::with('department')->find($this->product_id);
                $this->department_id = $this->department_id ? $this->department_id : $product->department_id;
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

    public function add_service()
    {
        if ($this->patient) {
            $serves = null;
            if ($this->lab_serv_id) {
                $serves = Service::with('category')->find($this->lab_serv_id);
            }
            if ($this->scan_serv_id) {
                $serves = ScanService::find($this->scan_serv_id);
            }
            if ($serves) {
                $tax = 0;
                if (setting()->tax_enabled and $this->patient->country_id != 1) {
                    $tax = $serves->price * (setting()->tax_rate / 100);
                }
                $discount = 0;
                $offer = null;
                $total = $serves->price - $discount + $tax;
                $this->items[] = ['invoice_id' => $this->invoice_id, 'product_id' => $serves->id, 'product_name' => $serves->name, 'price' => $serves->price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department' => $this->lab_serv_id ? 'lab' : 'scan', 'tax' => $tax];
                $this->computeForAll();
                $this->lab_serv_id = null;
                $this->scan_serv_id = null;
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please select the patient first')]);
            $this->lab_serv_id = null;
            $this->scan_serv_id = null;
        }
    }

    public function delete_item($key)
    {
        unset($this->items[$key]);
        $this->computeForAll();
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
        return 0;
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
        $this->calculateNet();
        if (count($this->items) == 0) {
            $this->amount = 0;
            $this->tax = 0;
            $this->total = 0;
        }
    }

    public function calculateNet()
    {
        $this->card = $this->card == "" ? 0 : $this->card;
        $this->cash = $this->cash == "" ? 0 : $this->cash;
        $this->bank = $this->bank == "" ? 0 : $this->bank;
        $this->visa = $this->visa == "" ? 0 : $this->visa;
        $this->mastercard = $this->mastercard == "" ? 0 : $this->mastercard;
        $this->discount = $this->discount == "" ? 0 : $this->discount;
        $this->rest
            = $this->total
            - ($this->card + $this->cash + $this->bank + $this->visa + $this->mastercard);
    }

    public function updatedCard()
    {
        $this->calculateMethods();
        // if ($this->card) {
        //     $this->cash = 0;
        //     $this->visa = 0;
        //     $this->bank = 0;
        //     $this->rest = $this->total - $this->card;
        // } else {
        //     $this->rest = 0;
        //     $this->cash = 0;
        //     $this->visa = 0;
        //     $this->bank = 0;
        //     $this->card = $this->total;
        // }
    }

    public function updatedCash()
    {
        $this->calculateMethods();
        // if ($this->cash) {
        //     if ($this->card) {
        //         $this->card = $this->total;
        //         $this->card = $this->card - ($this->cash + $this->visa + $this->bank + $this->mastercard) - $this->rest;
        //     } else {
        //         $this->card = $this->total;
        //     }
        // } else {
        //     $this->card = 0;
        //     $this->card = $this->total;
        //     $this->card = $this->card - ($this->cash + $this->visa + $this->bank + $this->mastercard) - $this->rest;
        // }
    }

    public function updatedVisa()
    {
        $this->calculateMethods();
        // if ($this->visa) {
        //     $this->card = $this->total;
        //     if ($this->card) {
        //         $this->card = $this->card - ($this->cash + $this->visa + $this->transfer + $this->mastercard) - $this->rest;
        //     } else {
        //         $this->card = $this->total;
        //     }
        // } else {
        //     $this->visa = 0;
        //     $this->card = $this->total;
        //     $this->card = $this->card - ($this->cash + $this->visa + $this->transfer + $this->mastercard) - $this->rest;
        // }
    }
    public function updatedBank()
    {
        $this->calculateMethods();
        // if ($this->bank) {
        //     $this->card = $this->total;
        //     if ($this->card) {
        //         $this->card = $this->card - ($this->cash + $this->visa + $this->bank + $this->mastercard) - $this->rest;
        //     } else {
        //         $this->card = $this->total;
        //     }
        // } else {
        //     $this->bank = 0;
        //     $this->card = $this->total;
        //     $this->card = $this->card - ($this->cash + $this->visa + $this->transfer + $this->mastercard) - $this->rest;
        // }
    }

    public function updatedMastercard()
    {
        $this->calculateMethods();
        // if ($this->mastercard) {
        //     $this->card = $this->total;
        //     if ($this->cash) {
        //         $this->card = $this->card - ($this->cash + $this->visa + $this->bank + $this->mastercard) - $this->rest;
        //     } else {
        //         $this->card = $this->total;
        //     }
        // } else {
        //     $this->mastercard = 0;
        //     $this->card = $this->total;
        //     $this->card = $this->card - ($this->cash + $this->visa + $this->bank + $this->mastercard) - $this->rest;
        // }
    }

    public function changeItemTotal($key)
    {
        $price = $this->items[$key]['price'] ? $this->items[$key]['price'] : 0;
        $this->items[$key]['price'] = $price;
        $this->items[$key]['sub_total'] = $price + $this->items[$key]['tax'];
        $this->computeForAll();
    }

    public function submit()
    {
        $data = $this->validate();
        unset($data['patient']);
        $data['patient_id'] = $this->patient->id;
        
        if ($this->type != 'package') {
            $data['package_id'] = null;
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

        $data['employee_id'] = auth()->id();
        /* $data['employee_id'] = auth()->id(); */
        $this->invoice->update($data);
        $this->invoice->products()->delete();
        $this->invoice->products()->createMany($this->items);
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
        if ($this->tasdeed) {
            return redirect()->route('front.invoices.show', $this->invoice)->with('success', __('تم تسديد الفاتورة'));
        }
        return redirect()->route('front.invoices.show', $this->invoice)->with('success', __('Saved successfully'));
    }

    public function mount()
    {

        if (request('tasdeed')) {
            $this->tasdeed = true;
        }
        $this->patient = $this->invoice->patient;
        $this->patient_key = $this->invoice->patient->id;
        $this->items = $this->invoice->products()->get()->toArray();
        $this->amount = $this->invoice->amount;
        $this->total = $this->invoice->total;
        $this->tax = $this->invoice->tax;
        $this->rest = $this->invoice->rest;
        $this->discount = $this->invoice->discount;
        $this->type = $this->invoice->type;
        $this->cash = $this->invoice->cash;
        $this->bank = $this->invoice->bank;
        $this->visa = $this->invoice->visa;
        $this->mastercard = $this->invoice->mastercard;
        $this->card = $this->invoice->card;
        $this->date = $this->invoice->date ? $this->invoice->date : $this->invoice->created_at->format('Y-m-d');
        if ($this->invoice->status == 'Unpaid') {
            $this->card = $this->invoice->total;
            $this->rest = 0;
        } else {
            $this->card = $this->invoice->card;
        }
        $this->status = $this->invoice->status;
        $this->notes = $this->invoice->notes;
        $this->installment_company = $this->invoice->installment_company;
        $this->dr_id = $this->invoice->dr_id;
        $this->offers_discount = $this->invoice->offers_discount;
        $this->amount_after_offers_discount = $this->invoice->amount - $this->invoice->products()->sum('discount');
        $this->department_id = $this->invoice->department_id;
        $this->package_id = $this->invoice->package_id;
        $this->scan_services = ScanService::all();
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

    public function render()
    {
        $departments = Department::get();
        $lab_categories = LabCategory::all();
        $packages = Package::get();
        $lab_services = Service::where('category_id', $this->lab_cat_id)->get();
        $doctors = User::doctors()->where('department_id', $this->department_id)->get();
        $products = Product::where('department_id', $this->department_id)->get();
        return view('livewire.invoices.edit-invoice', compact('doctors', 'departments', 'products', 'lab_categories', 'lab_services', 'packages'));
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
