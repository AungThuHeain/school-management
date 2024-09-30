<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Services\ClassroomService;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    private $classroomService;
    public function __construct(ClassroomService $classroomService)
    {
        $this->classroomService = $classroomService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = $this->classroomService->getAll();
        return view('web.class.index',compact('classrooms'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassRoom $classRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $classRoom)
    {
        //
    }
}
