<?php

namespace App\Http\Livewire\Reports;

use PDF;
use App\Models\User;
use App\Models\Invoice;
use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use App\Exports\ClinicDoctorReport;
use Maatwebsite\Excel\Facades\Excel;

class ClidocReport extends Component
{
    public $from, $to, $paid, $department_id, $dr_id, $status;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
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
        $invoices = [];
        $all_invoices = [];
        if ($this->dr_id or $this->department_id) {
            $invoices = Invoice::with(['patient', 'dr'])->where(function ($q) {
                $this->between($q);
                if ($this->dr_id) {
                    $q->where('dr_id', $this->dr_id);
                }
                if ($this->department_id) {
                    $q->where('department_id', $this->department_id);
                }
                if ($this->paid == 'cash') {
                    $q->where('cash', '>', 0);
                }
                if ($this->paid == 'visa') {
                    $q->where('visa', '>', 0);
                }
                if ($this->paid == 'mastercard') {
                    $q->where('mastercard', '>', 0);
                }
                if ($this->paid == 'card') {
                    $q->where('card', '>', 0);
                }
                if ($this->paid == 'bank') {
                    $q->where('bank', '>', 0);
                }
                if ($this->paid == 'tmara') {
                    $q->where('installment_company', true);
                }
                if ($this->status) {
                    $q->where('status', $this->status);
                }
            })->latest()->paginate(10);

            $all_invoices = Invoice::with(['patient', 'dr'])->where(function ($q) {
                $this->between($q);
                if ($this->dr_id) {
                    $q->where('dr_id', $this->dr_id);
                }
                if ($this->department_id) {
                    $q->where('department_id', $this->department_id);
                }
                if ($this->paid == 'cash') {
                    $q->where('cash', '>', 0);
                }
                if ($this->paid == 'visa') {
                    $q->where('visa', '>', 0);
                }
                if ($this->paid == 'mastercard') {
                    $q->where('mastercard', '>', 0);
                }
                if ($this->paid == 'card') {
                    $q->where('card', '>', 0);
                }
                if ($this->paid == 'bank') {
                    $q->where('bank', '>', 0);
                }
                if ($this->paid == 'tmara') {
                    $q->where('installment_company', true);
                }
                if ($this->status) {
                    $q->where('status', $this->status);
                }
            })->get();
        }

        $departments = Department::all();
        $doctors = User::doctors()->where('department_id', $this->department_id)->get();
        return view('livewire.reports.clidoc-report', compact('invoices', 'doctors', 'departments', 'all_invoices'));
    }

    public function export($type = null)
    {

        $all_invoices = [];
        if ($this->dr_id or $this->department_id) {
            $invoices = Invoice::with(['patient', 'dr'])->where(function ($q) {
                $this->between($q);
                if ($this->dr_id) {
                    $q->where('dr_id', $this->dr_id);
                }
                if ($this->department_id) {
                    $q->where('department_id', $this->department_id);
                }
                if ($this->paid == 'cash') {
                    $q->where('cash', '>', 0);
                }
                if ($this->paid == 'card') {
                    $q->where('card', '>', 0);
                }
                if ($this->paid == 'bank') {
                    dd(1);
                    $q->where('bank', '>', 0);
                }
                if ($this->paid == 'tmara') {
                    $q->where('installment_company', true);
                }
                if ($this->status) {
                    $q->where('status', $this->status);
                }
            })->latest()->paginate(10);
        }
        if ($type) {
            return Excel::download(new ClinicDoctorReport($this->dr_id, $this->department_id, $this->paid, $this->status), 'report' . time() . '.pdf', \Maatwebsite\Excel\Excel::MPDF);
        }
        return Excel::download(new ClinicDoctorReport($this->dr_id, $this->department_id, $this->paid, $this->status), 'report' . time() . '.xlsx');
    }
}
