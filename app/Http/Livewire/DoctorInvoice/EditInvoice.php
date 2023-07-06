<?php

namespace App\Http\Livewire\DoctorInvoice;

use App\Models\Department;
use App\Models\Patient;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class EditInvoice extends Component
{
    public $invoice, $patient_key, $patient, $department_id, $items = [], $product_id, $notes, $invoice_id, $amount, $total, $rest, $discount, $status, $date, $tax, $cash, $card, $dr_id;
    protected function rules()
    {
        return [
            'patient' => 'required',
            'department_id' => 'required',
            'amount' => 'required',
            'total' => 'required',
            'cash' => 'nullable',
            'card' => 'nullable',
            'rest' => 'required',
            'discount' => 'required',
            'notes' => 'nullable',
            'status' => 'required',
            'dr_id' => 'required',
            'tax' => 'nullable',
            'date' => 'required|date',
        ];
    }
    public function get_patient()
    {
        $this->patient = Patient::where('id', $this->patient_key)->orWhere('civil', $this->patient_key)->first();
        if ($this->patient) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Patient data has been retrieved successfully')]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => __('No results found')]);
        }
    }

    public function add_product()
    {
        if ($this->patient) {
            if ($this->product_id) {
                $product = Product::with('department')->findOrFail($this->product_id);
                $tax = 0;
                if (setting()->tax_enabled and $this->patient->country_id != 1) {
                    $tax = $product->price * (setting()->tax_rate / 100);
                }
                $discount = 0;
                $offer = null;
                if ($product->offer) {
                    $discount = $product->price * ($product->offer->rate / 100);
                    $offer = $product->offer->id;
                }
                $total = $product->price - $discount + $tax;
                $this->items[] = ['invoice_id' => $this->invoice_id, 'product_id' => $product->id, 'product_name' => $product->name, 'price' => $product->price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department' => $product->department->name, 'tax' => $tax, 'offer_id' => $offer];
                $this->computeForAll();
                $this->product_id = null;
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => __('Please select the patient first')]);
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
            $carry += $item['price'];
            return $carry;
        });

        $this->tax = array_reduce($this->items, function ($carry, $item) {
            $carry += $item['tax'];
            return $carry;
        });

        $this->discount = array_reduce($this->items, function ($carry, $item) {
            $carry += $item['discount'];
            return $carry;
        });

        $this->total = $this->amount + $this->tax - $this->discount;
        $this->rest = $this->total;
    }



    public function submit()
    {
        $data = $this->validate();
        $data['patient_id'] = $this->patient->id;
        $data['employee_id'] = auth()->id();
        $this->invoice->update($data);
        $this->invoice->products()->delete();
        $this->invoice->products()->createMany($this->items);
        return redirect()->route('doctor.invoices.index')->with('success', __('Saved successfully'));
    }

    public function mount()
    {
        $this->patient = $this->invoice->patient;
        $this->patient_key = $this->invoice->patient->id;
        $this->items = $this->invoice->products()->get()->toArray();
        $this->amount = $this->invoice->amount;
        $this->total = $this->invoice->total;
        $this->tax = $this->invoice->tax;
        $this->rest = $this->invoice->rest;
        $this->discount = $this->invoice->discount;
        $this->cash = $this->invoice->cash;
        $this->card = $this->invoice->card;
        $this->status = $this->invoice->status;
        $this->notes = $this->invoice->notes;
        $this->dr_id = $this->invoice->dr_id;
        $this->department_id = $this->invoice->department_id;
        $this->date = $this->invoice->date ? $this->invoice->date : $this->invoice->created_at->format('Y-m-d');
    }

    public function render()
    {
        $departments = Department::get();
        $doctors = User::doctors()->where('department_id', $this->department_id)->get();
        $products = Product::where('department_id', $this->department_id)->get();
        return view('livewire.doctor-invoice.edit-invoice', compact('departments', 'doctors', 'products'));
    }
}
