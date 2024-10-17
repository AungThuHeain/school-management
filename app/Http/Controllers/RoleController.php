<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;

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
    public function store(RoleRequest $request)
    {
        $this->roleService->store($request);
        session()->flash('success', 'Role created successfully');
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
    public function edit(String $id)
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
    public function update(RoleRequest $request, string $id)
    {
        $this->roleService->update($request,$id);
        session()->flash('success', 'Role created successfully');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->roleService->destroy($id);
    }

    public function getRolesClasses()
    {
        return $this->roleService->getRolesClasses();
    }
}
