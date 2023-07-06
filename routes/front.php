<?php

use App\Models\UserManual;
use App\Models\Appointment;
use App\Models\ProgramModule;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Reports\ClidocReport;
use App\Http\Controllers\Front\FormController;
use App\Http\Controllers\Front\GuestsController;
use App\Http\Controllers\Front\InvoiceController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\ReportsController;
use App\Http\Controllers\Front\PatientsController;
use App\Http\Controllers\Front\AppointmentController;
use App\Models\Patient;
use App\Models\PatientPackage;

// livewire group
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () { //...

        Route::group(['middleware' => 'auth'], function () {
            Route::get('', function () {
                if (auth()->user()->isDoctor()) {
                    return redirect()->route('doctor.home');
                }
                if (auth()->user()->isScan()) {
                    return redirect()->route('scan.home');
                }
                if (auth()->user()->isLab()) {
                    return redirect()->route('lab.home');
                }
                return view('front.home');
            })->name('home');
            Route::get('/guide', function () {
                $manuals = UserManual::get();
                return view('front.guide', compact('manuals'));
            })->name('guide');
            Route::get('/patients/patientFile/{patient}', [PatientsController::class, 'patientFile'])->name('patientFile');
            Route::get('patients/{patient}/package_days/{patient_package}', function (Patient $patient, PatientPackage $patient_package) {
                return view('front.patients.package_days', compact('patient', 'patient_package'));
            })->name('patients.package_days');
            Route::resource('patients', PatientsController::class);
            Route::post('appointments/{appointment}/presence', [AppointmentController::class, 'presence'])->name('appointments.presence');
            Route::post('appointments/{appointment}/notPresence', [AppointmentController::class, 'notPresence'])->name('appointments.notPresence');
            Route::resource('appointments', AppointmentController::class);
            Route::view('appointments-transferred', 'front.appointment.transferred')->name('appointment.transferred');
            Route::view('appointments-info', 'front.appointment.info')->name('appointments_info');
            Route::get('today_appointments', function () {
                $appoints = Appointment::where('appointment_date', date('Y-m-d'))->orderBy('appointment_status', 'asc')->latest()->get();
                return view('front.appointment.today_appointments', compact('appoints'));
            })->name('appointments.today_appointments');

            Route::get('print-transferred/{appointment}', function (Appointment $appointment) {
                return view('front.patients.print-transfer', compact('appointment'));
            })->name('appointment.print-transfer');
            Route::resource('forms', FormController::class);
            Route::resource('invoices', InvoiceController::class);
            Route::get('invoices/bonds/{invoice}', [InvoiceController::class, 'bonds'])->name('invoices.bonds');

            Route::view('pay_package', 'front.invoice.pay_package')->name('pay_package');

            Route::view('packages', 'front.packages.index')->name('packages');

            Route::get('/treasury', [ReportsController::class, 'treasury']);
            Route::view('accounting', 'front.accounting')->name('accounting');
            Route::view('treasuryAccount', 'front.reports.treasury-account')->name('treasury_account');
            Route::view('patient-report', 'front.reports.patients')->name('patient_report');
            Route::view('clidoc-report', 'front.reports.clidoc-report')->name('Clidoc_report');
            Route::get('clidoc-report/export', [ClidocReport::class, 'export'])->name('Clidoc_report.export');
            Route::view('financial-report', 'front.reports.financial-report')->name('Financial_report');
            Route::view('offers-report', 'front.reports.offers')->name('offers_report');
            Route::view('products-report', 'front.reports.products')->name('products_report');
            Route::view('expenses-report', 'front.reports.expenses')->name('expenses_report');
            Route::view('purchases-report', 'front.reports.purchases')->name('purchases_report');
            Route::view('packages_report', 'front.reports.packages-report')->name('packages_report');
            Route::view('not-saudis-report', 'front.reports.not-sudies')->name('not_sudies');
            Route::view('insurances-report', 'front.reports.insurances-report')->name('insurances_report');
            Route::view('patient-groups-report', 'front.reports.patient-groups-report')->name('patient_groups_report');
            Route::view('installment-company-report', 'front.reports.installment-company')->name('installment_company');
            Route::view('reception-staff-report', 'front.reports.reception-staff-report')->name('reception_staff_report');
            Route::view('pay-visit', 'front.invoice.pay-visit')->name('pay_visit');
            Route::view('notifications', 'front.notifications')->name('notifications');
            Route::get('create/guest', [GuestsController::class, 'index'])->name('guests.create');
            //Profile Route
            Route::get('profile', [ProfileController::class, 'index'])->name('profile');
            Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
            Route::get('profile/vacations', [ProfileController::class, 'vacationRequest'])->name('profile.vacations');
            Route::post('profile/vacations', [ProfileController::class, 'vacationRequestStore'])->name('profile.vacation.store');

            Route::view('diagnoses', 'front.diagnoses.index')->name('diagnoses.index');
            Route::view('products', 'front.products.index')->name('products.index');
            Route::view('offers', 'front.offers.index')->name('offers.index');
            Route::view('salaries', 'front.salaries.index')->name('salaries.index');
            Route::view('departments', 'front.departments.index')->name('departments.index');
            Route::view('patient_groups', 'front.patient_groups.index')->name('patient_groups.index');
            Route::view('categories', 'front.categories.index')->name('categories.index');
            Route::view('expenses', 'front.expenses.index')->name('expenses.index');
            Route::view('purchases', 'front.purchases.index')->name('purchases.index');
            Route::resource('scan-requests', \App\Http\Controllers\Front\ScanRequestController::class);
            Route::view('lab-requests', 'front.requests.lab-requests')->name('lab_requests');
            Route::view('scan-requests', 'front.requests.scan-requests')->name('scan_requests');
            Route::get('program_modules', function () {
                $program_modules = ProgramModule::latest()->paginate(10);
                return view('front.program-additions', compact('program_modules'));
            })->name('program_modules');
        });
    }
);
