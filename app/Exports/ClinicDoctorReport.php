<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClinicDoctorReport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */


    // a place to store the team dependency
    private $dr_id, $department_id, $paid, $status;

    // use constructor to handle dependency injection
    public function __construct($dr_id, $department_id, $paid, $status)
    {
        $this->dr_id = $dr_id;
        $this->department_id = $department_id;
        $this->paid = $paid;
        $this->status = $status;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Invoice::with(['patient', 'dr'])->where(function ($q) {
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
            if ($this->paid == 'tmara') {
                $q->where('installment_company', true);
            }
            if ($this->status) {
                $q->where('status', $this->status);
            }
        })->get();
    }

    public function map($invoice): array
    {
        return [
            $invoice->created_at->format('Y-m-d'),
            $invoice->id,
            $invoice->dr?->name,
            $invoice->patient?->name,
            $invoice->amount,
            $invoice->tax,
            $invoice->total,
            $invoice->paid,
            $invoice->rest,
            __($invoice->status),
        ];
    }

    // this is fine
    public function headings(): array
    {
        return [
            'asdasd',
            __('admin.Invoice no.'),
            __('admin.dr'),
            __('admin.patient'),
            __('admin.amount'),
            __('admin.tax'),
            __('admin.Total'),
            __('admin.paid'),
            __('admin.rest'),
            __('admin.Status'),
        ];
    }
}
