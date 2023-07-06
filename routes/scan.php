<?php

use App\Http\Controllers\Doctor\InvoiceController;
use App\Http\Controllers\Front\AppointmentController;
use App\Http\Controllers\Front\PatientsController;
use App\Models\Patient;
use Illuminate\Support\Facades\Route;

// livewire group
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale().'/scan',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...
Route::group(['middleware' => 'auth'], function () {
    Route::view('','scan.home')->name('home');
    Route::view('patients','scan.patients.index')->name('patients.index');
    Route::view('requests','scan.requests.requests')->name('requests');
});
}
);