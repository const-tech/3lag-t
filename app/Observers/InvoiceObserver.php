<?php

namespace App\Observers;

use App\Models\Invoice;
use App\Models\Notification;

class InvoiceObserver
{
    /**
     * Handle the Invoice "created" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function created(Invoice $invoice)
    {
        if ($invoice->employee->type == 'dr') {
            $link = route('front.pay_visit');
            $msg = ' تم اضافة فاتورة جديدة بواسطة الطبيب  ' . $invoice->dr->name .' للمريض '. $invoice->patient->name;
            Notification::send('فاتورة جديدة', $msg,$link);
        }
    }

    /**
     * Handle the Invoice "updated" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function updated(Invoice $invoice)
    {

        if ($invoice->isDirty('status') && $invoice->status == 'Paid') {
            $invoice->employee->notifications()->create([
                'title' => 'تم تأكيد الدفع',
                'body' => 'تم تأكيد الدفع للفاتورة رقم ' . $invoice->id,
                'link' => route('front.invoices.show', $invoice->id),
            ]);
        }
    }

    /**
     * Handle the Invoice "deleted" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function deleted(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the Invoice "restored" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function restored(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the Invoice "force deleted" event.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return void
     */
    public function forceDeleted(Invoice $invoice)
    {
        //
    }
}
