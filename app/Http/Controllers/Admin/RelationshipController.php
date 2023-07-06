<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Relationship;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relationships=Relationship::latest()->paginate(10);
        return view('admin.relationships.index',compact('relationships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.relationships.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate(['name'=>'required']);
        Relationship::create($data);
        return redirect()->route('admin.relationships.index')->with('success',__('Successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function show(Relationship $relationship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function edit(Relationship $relationship)
    {
        return view('admin.relationships.edit',compact('relationship'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relationship $relationship)
    {
        $data=$request->validate(['name'=>'required']);
        $relationship->update($data);
        return redirect()->route('admin.relationships.index')->with('success',__('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Relationship  $relationship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relationship $relationship)
    {
        $relationship->delete();
        return back()->with('success',__('Successfully deleted'));
    }
}
