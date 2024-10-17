<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class StudentService
{
    public function getAll()
    {
        return User::where('school_id',auth()->user()->school_id)->role(['Student'])->paginate(10);
    }

    public function store(Request $request)
    {
        $student = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>bcrypt($request->password),
            'class_id'=>$request->class_id,
            'school_id'=>$request->school_id,
        ]);

        $student->assignRole('Student');
    }

    public function update(Request $request, String $id)
    {
        $student = User::findOrFail($id);
        $student->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'class_id'=>$request->class_id,
            'password'=>$request->password ? bcrypt($request->password) : $student->password,
        ]);
    }

    public function destroy(String $id)
    {
        $student = User::findOrFail($id);
        $student->delete();
    }
}
