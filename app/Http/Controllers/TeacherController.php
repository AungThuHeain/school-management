<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use App\Services\TeacherService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    private $teacherService;
    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = $this->teacherService->getAll();
        return view('web.teacher.index',compact('teachers'));
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
    public function store(TeacherRequest $request)
    {
        $this->teacherService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherRequest $request, String $id)
    {
        $this->teacherService->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $this->teacherService->destroy($id);
    }
}
