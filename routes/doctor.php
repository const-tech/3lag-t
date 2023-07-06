<?php

use App\Http\Controllers\Doctor\InvoiceController;
use App\Http\Controllers\Front\AppointmentController;
use App\Http\Controllers\Front\PatientsController;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Facades\Route;

// livewire group
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/doctor',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...
Route::group(['middleware' => 'auth'], function () {
    Route::view('','doctor.home')->name('home');
    Route::view('interface','doctor.interfaces.interface')->name('interface');
    Route::view('appointments','doctor.appointments.index')->name('appointments');
    Route::view('appointments-info', 'doctor.appointments.info')->name('appointments_info');
    Route::resource('invoices',InvoiceController::class);
    Route::view('patients','doctor.patients.index')->name('patients.index');
    Route::get('patients/{patient}',function(Patient $patient){
        return view('doctor.patients.show',compact('patient'));
    })->name('patients.show');
    Route::get('patients/patientFile/{patient}',function(Patient $patient){
        return view('doctor.patients.patientFile',compact('patient'));
    })->name('patientFile');
    Route::view('report','doctor.report')->name('report');

    Route::get('today_appointments', function () {
        $appoints = Appointment::where('appointment_date', date('Y-m-d'))->orderBy('appointment_status', 'asc')->latest()->get();
        return view('doctor.appointments.today_appointments', compact('appoints'));
    })->name('appointments.today_appointments');
    
});
}
);
