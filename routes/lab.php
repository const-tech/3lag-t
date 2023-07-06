<?php

use App\Http\Controllers\Doctor\InvoiceController;
use App\Http\Controllers\Front\AppointmentController;
use App\Http\Controllers\Front\PatientsController;
use App\Models\Patient;
use Illuminate\Support\Facades\Route;

// livewire group
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/lab',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...
Route::group(['middleware' => 'auth'], function () {
    Route::view('','lab.home')->name('home');
    Route::view('patients','lab.patients.index')->name('patients.index');
    Route::view('requests','lab.requests.requests')->name('requests');
});
}
);