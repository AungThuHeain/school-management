<?php

namespace App\Services;

use App\Models\ClassRoom;

class ClassroomService
{
    public function getAll()
    {
        return ClassRoom::filter(request()->only('s'))->orderBy('id','desc')->paginate(10);
    }

    public function store($request)
    {
        $classroom = ClassRoom::create($request->validated());
    }

    public function update($request)
    {
        $classroom = ClassRoom::findOrFail($request->id);
        $classroom->update($request->validated());
    }

    public function destroy($id)
    {
        $class = ClassRoom::findOrFail($id);
        $class->delete();
    }
}
