<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Services\ClassroomService;
use App\Services\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private $scheduleService;
    public function __construct(ScheduleService $scheduleService)
    {
         $this->scheduleService = $scheduleService;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = $this->scheduleService->getAll();
        $classrooms = $this->scheduleService->getCLassrooms($id = null);

        // return $schedules;
        return view('web.schedule.index',compact('schedules','classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScheduleRequest $request)
    {
        $this->scheduleService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScheduleRequest $request, String $id)
    {
        $this->scheduleService->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $this->scheduleService->destroy($id);
    }

    public function getCLassrooms($id=null)
    {
        $classes = $this->scheduleService->getCLassrooms($id);
        return response()->json([
            'classes'=>$classes,
        ],200);
    }
}
