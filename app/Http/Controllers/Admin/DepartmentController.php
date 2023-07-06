<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function __construct()
    {
        // $this->middleware('company')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $departments = Department::latest()->paginate(10);
        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_departments = Department::whereNull('parent')->get();
        return view('admin.departments.create', compact('main_departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'parent' => ['nullable', 'exists:departments,id'],
            'is_lab' => ['nullable'],
            'is_scan' => ['nullable'],
        ], [], [
                'name' => __('name'),
                'parent' => __('parent'),
            ]);
        $data['is_lab'] = $request->is_lab ? true : false;
        $data['is_scan'] = $request->is_scan ? true : false;
        Department::create($data);
        return redirect()->route('admin.departments.index')->with('success', __('Successfully added'));
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Department  $department
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Department $department)
    // {
    //     //
    // }


    public function edit(Department $department)
    {
        // dd('ww');
        $main_departments = Department::whereNull('parent')->get();
        return view('admin.departments.edit', compact('main_departments', 'department'));
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
        $data = $request->validate([
            'name' => ['required'],
            'parent' => ['nullable', 'exists:departments,id'],
            'is_lab' => ['nullable'],
            'is_scan' => ['nullable'],
        ], [], [
                'name' => __('name'),
                'parent' => __('parent'),
            ]);
        $data['is_lab'] = $request->is_lab ? true : false;
        $data['is_scan'] = $request->is_scan ? true : false;
        $department->update($data);
        return redirect()->route('admin.departments.index')->with('success', __('Successfully updated'));
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
        return back()->with('success', __('Successfully deleted'));
    }
}
