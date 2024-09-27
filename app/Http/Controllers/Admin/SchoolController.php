<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\SchoolService;
use Illuminate\Http\Request;

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
}
