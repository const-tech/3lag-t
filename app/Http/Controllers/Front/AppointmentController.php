<?php

namespace App\Http\Controllers\Front;

use App\Models\Appointment;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use AhmedAlmory\JodaResources\JodaResource;

class AppointmentController extends Controller
{
    use JodaResource;
    protected $updateRules = [
        'patient_id' => 'sometimes',
        'doctor_id' => 'sometimes',
        'clinic_id' => 'sometimes',
        'appointment_date' => 'sometimes',
        'appointment_time' => 'sometimes',
        'appointment_status' => 'sometimes',
    ];
    protected $storeRules = [
        'patient_id' => 'required',
        'doctor_id' => 'required',
        'clinic_id' => 'required',
        'employee_id' => 'required',
        'appointment_number' => '',
    ];
    protected function beforeStore()
    {
        \request()->merge([
            'appointment_number' => Str::random(10),
        ]);
    }
    protected function afterStore($model = null)
    {
        if ($model->appointment_date == null) {
            // means transferred
            return redirect()->route('front.appointment.transferred');
        }
    }

    protected function beforeUpdate($model)
    {
        $unpaidInvoices = $model->patient->invoices()->where('status', 'unpaid')->get();
        if ($unpaidInvoices->count() > 0) {
            Session::flash('error', 'المريض لديه عمليات دفع غير مسددة');
        }

        if ($model->appointment_status == 'confirmed') {
            $model->update([
                'attended_at' => now(),
            ]);
        }
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return back()->with('success', __('Successfully deleted'));
    }

    public function presence(Appointment $appointment)
    {
        $appointment->update(['attended_at' => now()]);
        return redirect()->back()->with('success', 'تم تسجيل الحضور');
    }
    public function notPresence(Appointment $appointment)
    {
        $appointment->update(['appointment_status' => 'cancelled']);
        return redirect()->back()->with('success', 'تم تسجيل عدم الحضور');
    }
}
