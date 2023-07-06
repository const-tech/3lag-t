<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::NotAdmin()->with('department')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $roles = Role::get();
        return view('admin.users.create', compact('departments', 'roles'));
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
            'password' => ['required'],
            'email' => ['required', 'unique:users,email', 'email'],
            'type' => ['required'],
            'group' => ['required'],
            'session_duration' => ['nullable', 'integer'],
            'salary' => ['nullable', 'numeric'],
            'department_id' => $request->type == 'dr' ? 'required' : 'nullable',
            'rate' => ['nullable', 'numeric'],
            'target' => ['nullable', 'numeric'],
            'show_department_products' => ['nullable'],
            'is_dentist' => ['nullable'],
            'is_dermatologist' => ['nullable']
        ]);

        if ($request->rate_type != "without_rate") {
            if (!$request->rate) {
                return redirect()->back()->with('error', "rate is required");
            } else {
                $data['rate'] = 0;
            }
        } else {
            $data['rate'] = $request->rate;
        }
        $data['password'] = Hash::make($request->password);
        $data['rate_type'] = $request->rate_type;

        $user = User::create($data);
        $user->syncRoles($request->group);
        return redirect()->route('admin.users.index')->with('success', __('Successfully added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $departments = Department::all();
        return view('admin.users.show',compact('user','departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $departments = Department::all();
        $roles = Role::get();
        return view('admin.users.edit', compact('departments', 'roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required'],
            'password' => ['sometimes'],
            'email' => ['required', 'unique:users,email,' . $user->id, 'email'],
            'type' => ['required'],
            'group' => ['required'],
            'session_duration' => ['nullable', 'integer'],
            'salary' => ['required', 'numeric'],
            'department_id' => $request->type == 'dr' ? 'required' : 'nullable',
            'rate' => ['nullable', 'numeric'],
            'target' => ['nullable', 'numeric'],
            'show_department_products' => ['nullable'],
            'is_dentist' => ['nullable'],
            'is_dermatologist' => ['nullable']
        ]);

        /* if ($request->rate_type != "without_rate") {
            if (!$request->rate) {
                return redirect()->back()->with('error', "rate is required");
            } else {
                $data['rate'] = 0;
            }
        } */

        $data['password'] = $request->password ? Hash::make($request->password) : $user->password;
        $data['rate_type'] = $request->rate_type;
        $data['rate'] = $request->rate ? $request->rate : 0;
        $data['is_dentist'] = $request->is_dentist ? 1 : 0;
        $data['is_dermatologist'] = $request->is_dermatologist ? 1 : 0;
        $user->update($data);
        $user->syncRoles($request->group);
        return redirect()->route('admin.users.index')->with('success', __('Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', __('Successfully deleted'));
    }
}
