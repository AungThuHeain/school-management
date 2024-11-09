<?php

namespace App\Services;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherService
{
    public function getAll()
    {
        return User::withoutRole(['Owner','Student'])->paginate(10);
    }

    public function store(Request $request)
    {
        $teacher = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>bcrypt($request->password),
            'class_id'=>$request->class_id,
            'school_id'=>$request->school_id,
        ]);

        $teacher->syncRoles($request->role);
    }

    public function update(Request $request, String $id)
    {
        $teacher = User::findOrFail($id);
        $teacher->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'class_id'=>$request->class_id,
            'password'=>$request->password ? bcrypt($request->password) : $teacher->password,
        ]);

        $teacher->syncRoles($request->role);
    }

    public function destroy(String $id)
    {
        $teacher = User::findOrFail($id);
        $teacher->delete();
    }
}
