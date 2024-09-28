<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SchoolRequest;
use App\Services\Admin\SchoolService;

class SchoolController extends Controller
{
    private $schoolService;
    public function __construct(SchoolService $schoolService)
    {
       $this->schoolService = $schoolService;
    }

    public function index()
    {
        $schools = $this->schoolService->getAll();
        return view('admin.school.index',compact('schools'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SchoolRequest $request, string $id)
    {
        $this->schoolService->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->schoolService->destroy($id);
    }
}
