<?php

namespace App\Http\Livewire\Reports;

use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Purchase;
use Livewire\Component;

class FinancialReport extends Component
{
    public $paid_invoices = 0, $partially_paid = 0, $unpaid_invoices = 0, $retrieved_invoices = 0, $tax = 0, $expenses = 0, $purchases = 0, $cash = 0, $card = 0, $bank = 0, $visa = 0, $mastercard = 0, $to, $from, $type = ['paid_invoices', 'partially_paid', 'unpaid_invoices', 'tax', 'expenses', 'purchases', 'cash', 'card', 'bank', 'visa', 'mastercard', 'retrieved_invoices'];
    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }
    public function render()
    {
        $this->paid_invoices = Invoice::where('status', 'Paid')->where(function ($q) {
            $this->between($q);
        })->sum('total');

        $this->unpaid_invoices = Invoice::where('status', 'Unpaid')->where(function ($q) {
            $this->between($q);
        })->sum('total');

        $this->retrieved_invoices = Invoice::where('status', 'retrieved')->where(function ($q) {
            $this->between($q);
        })->sum('total');

        $this->partially_paid = Invoice::where('status', 'Partially Paid')->where(function ($q) {
            $this->between($q);
        })->sum('total');

        $this->tax = Invoice::where(function ($q) {
            $this->between($q);
        })->sum('tax');

        $this->expenses = Expense::where(function ($q) {
            $this->between($q);
        })->sum('amount');

        $this->purchases = Purchase::where(function ($q) {
            $this->between($q);
        })->sum('amount');

        $this->cash = Invoice::where(function ($q) {
            $this->between($q);
        })->sum('cash');

        $this->card = Invoice::where(function ($q) {
            $this->between($q);
        })->sum('card');

        $this->bank = Invoice::where(function ($q) {
            $this->between($q);
        })->sum('bank');

        $this->visa = Invoice::where(function ($q) {
            $this->between($q);
        })->sum('visa');

        $this->mastercard = Invoice::where(function ($q) {
            $this->between($q);
        })->sum('mastercard');


        return view('livewire.reports.financial-report');
    }
}
