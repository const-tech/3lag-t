<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(){
        $user=auth()->user();
        return view('admin.profile',compact('user'));
    }
    public function update(Request $request){
        $user=auth()->user();
        $data=$request->validate([
            'name'=>['required'],
            'password'=>['sometimes'],
            'email'=>['required','unique:users,email,'.$user->id,'email'],
            'image'=>'nullable'
        ]);
        $data['photo']=$request->hasFile('image')?store_file($request->image,'admins'):null;
        $data['password']=$request->password?Hash::make($request->password):$user->password;
        $user->update($data);
        return back()->with('success',__('Successfully updated'));
    }
}
