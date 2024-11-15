<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExcelImportRequest;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $studentService;
    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = $this->studentService->getAll();
        return view('web.student.index',compact('students'));
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
    public function store(StudentRequest $request)
    {
        $this->studentService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, String $id)
    {
        $this->studentService->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $this->studentService->destroy($id);
    }

    public function import(ExcelImportRequest $request)
    {
        $this->studentService->import($request);
    }

    public function downloadDemo()
    {
         return response()->download(storage_path('demo/student-import.xls'));
    }
}
