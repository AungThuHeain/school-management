<?php

namespace App\Http\Controllers;

use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $roleService;
    public function __construct(RoleService $roleService)
    {
      $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $roles =  $this->roleService->getAll();
         return view('web.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $permissions = $this->roleService->getPermissions();
        $groupedPermissions = $permissions->groupBy(function($permission) {
            return explode('_', $permission->name)[0];
        });
        return view('web.role.create',compact('groupedPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->roleService->store($request);
        return redirect()->route('roles.index');
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
        $role = $this->roleService->getById($id);
        $permissions = $this->roleService->getPermissions();
        $groupedPermissions = $permissions->groupBy(function($permission) {
            return explode('_', $permission->name)[0];
        });


        return view('web.role.edit',compact('role','groupedPermissions','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->roleService->update($request,$id);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
