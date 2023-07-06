<?php

use App\Http\Controllers\Company\AuthController;
use App\Http\Controllers\Company\DepartmentController;
use App\Http\Controllers\Company\ProfileController;
use App\Http\Controllers\Company\ProgramModuleController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...
        Route::view('company/login', 'company.login')->middleware('company_guest')->name('login');
        Route::post('company/login', [AuthController::class, 'login'])->middleware('company_guest')->name('login.post');

        Route::group(['middleware' => 'company', 'prefix' => 'company'], function () {
            Route::view('/', 'company.home')->name('home');
            Route::get('profile', [ProfileController::class, 'show'])->name('profile');
            Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::resource('departments', DepartmentController::class);
            Route::resource('program_modules', ProgramModuleController::class);
        });
    }
);
