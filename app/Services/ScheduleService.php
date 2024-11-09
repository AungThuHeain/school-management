<?php

namespace App\Services;

use App\Models\Schedule;
use App\Models\ClassRoom;

class ScheduleService
{
    public function getAll()
    {
        return Schedule::with('classRooms')->paginate(10);
    }

    public function getCLassrooms($id)
    {
        if($id == null){
            return ClassRoom::whereDoesntHave('schedules')->get();
        }
        return ClassRoom::all();

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
