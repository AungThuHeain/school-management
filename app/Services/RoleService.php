<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function getAll()
    {
        return  Role::with('permissions')->get();
    }

    public function getById($id)
    {
        return  Role::with('permissions')->find($id);
    }

    public function getPermissions()
    {
        return Permission::all();
    }

    public function update($request,$id)
    {
        $role = Role::find($id);
        $role->syncPermissions($request->permissions);
    }

    public function store($request)
    {
        $role = Role::create(['name' => $request->name,'school_id'=>auth()->user()->school_id]);
        $role->syncPermissions($request->permissions);
    }

}
