<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments=Department::latest()->paginate(10);
        return  view('company.departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_departments=Department::whereNull('parent')->get();
        return  view('company.departments.create',compact('main_departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>['required'],
            'parent'=>['nullable','exists:departments,id'],
            'is_lab'=>['nullable'],
            'is_scan'=>['nullable'],
        ],[],[
            'name'=>__('name'),
            'parent'=>__('parent'),
        ]);
        $data['is_lab']=$request->is_lab?true:false;
        $data['is_scan']=$request->is_scan?true:false;
        Department::create($data);
        return redirect()->route('company.departments.index')->with('success',__('Successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $main_departments=Department::whereNull('parent')->get();
        return  view('company.departments.edit',compact('main_departments','department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $data=$request->validate([
            'name'=>['required'],
            'parent'=>['nullable','exists:departments,id'],
            'is_lab'=>['nullable'],
            'is_scan'=>['nullable'],
        ],[],[
            'name'=>__('name'),
            'parent'=>__('parent'),
        ]);
        $data['is_lab']=$request->is_lab?true:false;
        $data['is_scan']=$request->is_scan?true:false;
        $department->update($data);
        return redirect()->route('company.departments.index')->with('success',__('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with('success',__('Successfully deleted'));
        
    }
}
