<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramModule;
use Illuminate\Http\Request;

class ProgramModuleController extends Controller
{

    public function index()
    {
        $program_modules = ProgramModule::latest()->paginate(10);
        return view('admin.program_modules.index', compact('program_modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.program_modules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required', 'price' => 'required|numeric', 'features' => 'required']);
        ProgramModule::create($data);
        return redirect()->route('admin.program_modules.index')->with('success', __('Successfully added'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramModule $program_module)
    {
        return view('admin.program_modules.edit', compact('program_module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramModule $program_module)
    {
        $data = $request->validate(['name' => 'required', 'price' => 'required|numeric', 'features' => 'required']);
        $program_module->update($data);
        return redirect()->route('admin.program_modules.index')->with('success', __('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramModule $program_module)
    {
        $program_module->delete();
        return back()->with('success', __('Successfully deleted'));
    }
}
