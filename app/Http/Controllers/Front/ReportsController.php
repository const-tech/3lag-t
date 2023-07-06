<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Purchase;
use App\Models\Relationship;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function treasuryAccount()
    {

        return view('front.treasury-account.index');
    }
    public function treasury()
    {
        $profits=Invoice::where('status','Paid')->orWhere('status','retrieved')->sum('amount');
        $losses=Purchase::sum('amount') + Expense::sum('amount') + User::TotalMonthlyIncome();
        // dd(User::TotalMonthlyIncome());
        return view('front.reports.treasury',compact('profits','losses'));
    }

    public function patientReport()
    {
        return view('front.patient-report.index');
    }

    public function ClidocReport()
    {
        return view('front.Clidoc-report.index');
    }

    public function FinancialReport()
    {
        return view('front.Financial-report.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('front.patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('front.patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
    }
}
