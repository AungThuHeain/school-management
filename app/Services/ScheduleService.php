<?php

namespace App\Services;

use App\Models\Schedule;
use App\Models\ClassRoom;

class ScheduleService
{
    public function getAll()
    {
        return Schedule::where('school_id', auth()->user()->school_id)->with('classRooms')->paginate(10);
    }

    public function getCLassrooms($id)
    {
        if($id == null){
            return ClassRoom::where('school_id', auth()->user()->school_id)->whereDoesntHave('schedules')->get();
        }
        return ClassRoom::where('school_id', auth()->user()->school_id)->get();

    }

    public function store($request)
    {
        $schedule = Schedule::create($request->except('classes'));

        $schedule->classRooms()->attach($request->classes);
    }

    public function update($request, $id)
    {
         $schedule = Schedule::findOrFail($id);
         $schedule->update($request->except('classes'));

         $schedule->classRooms()->sync($request->classes);
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
    }

}
