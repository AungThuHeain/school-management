<?php

namespace App\Services\Admin;

use App\Models\School;

class SchoolService
{
    public function getAll()
    {
        return School::filter(request()->only('s'))->paginate(10);
    }

    public function update($request,$id)
    {
        $school = School::findOrFail($id);
        $school->update($request->all());
        return $school;
    }

    public function destroy($id)
    {
        $school = School::findOrFail($id);
        $school->delete();
    }


}
