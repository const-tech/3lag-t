<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Patient;
use App\Models\Relationship;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients=Patient::with(['country','user'])->latest()->paginate(10);
        return view('admin.patients.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments=Department::all();
        $city=City::all();
        $countries=Country::all();
        $relationships=Relationship::all();
        return view('admin.patients.create',compact('departments','city','countries','relationships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'civil'=>'required|numeric|digits:10|unique:patients,civil',
            'first_name'=>'required',
            'phone'=>'required|unique:patients,phone',
            'gender'=>'required|in:male,female',
            'birthdate'=>'required',
            'country_id'=>'required',
        ]);
        $request->merge([
            'user_id'=>auth()->id()
        ]);
        Patient::create($request->all());
        return redirect()->route('admin.patients.index')->with('success',__('Successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('admin.patients.show',compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        $departments=Department::all();
        $city=City::all();
        $countries=Country::all();
        $relationships=Relationship::all();
        return view('admin.patients.edit',compact('departments','city','countries','relationships','patient'));
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
        $request->validate([
            'civil'=>['required','numeric','digits:10','unique:patients,civil,'.$patient->id],
            'first_name'=>'required',
            'phone'=>['required','unique:patients,phone,'.$patient->id],
            'gender'=>'required|in:male,female',
            'birthdate'=>'required',
            'country_id'=>'required',
        ]);
        $request->merge([
            'user_id'=>auth()->id()
        ]);
        $patient->update($request->all());
        return redirect()->route('admin.patients.index')->with('success',__('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        if($patient->image){
            delete_file($patient->image);
        }

        $patient->invoices()->delete();
        $patient->diagnoses()->delete();
        $patient->files()->delete();
        $patient->appointments()->delete();
        $patient->scanRequests()->delete();
        $patient->labRequests()->delete();
        
        $patient->delete();
        return back()->with('success',__('Successfully deleted'));
    }
}
