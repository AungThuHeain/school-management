<?php

namespace App\Services;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherService
{
    public function getAll()
    {
        return User::where('school_id',auth()->user()->school_id)->withoutRole('Owner')->paginate(10);
    }

    public function store(Request $request)
    {
        $teacher = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>bcrypt($request->password),
            'school_id'=>$request->school_id,
        ]);

        $teacher->assignRole('Teacher');
    }

    public function update(Request $request, String $id)
    {
        $teacher = User::findOrFail($id);
        $teacher->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>$request->password ? bcrypt($request->password) : $teacher->password,
        ]);
    }

    public function destroy(String $id)
    {
        $teacher = User::findOrFail($id);
        $teacher->delete();
    }
}
