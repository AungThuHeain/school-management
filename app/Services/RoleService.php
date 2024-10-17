<?php

namespace App\Services;

use App\Models\ClassRoom;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleService
{
    public function getAll()
    {
        return  Role::with('permissions')->where('school_id',auth()->user()->school_id)->get();
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
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
    }

    public function store($request)
    {
        $role = Role::create(['name' => $request->name,'school_id'=>auth()->user()->school_id]);
        $role->syncPermissions($request->permissions);
    }

    public  function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
    }

    public  function getRolesClasses()
    {
        $roles = Role::with('permissions')->where('school_id',auth()->user()->school_id)->get();
        $classes = ClassRoom::where('school_id',auth()->user()->school_id)->get();
        return response()->json(['roles'=>$roles,'classes'=>$classes]);
    }

}
