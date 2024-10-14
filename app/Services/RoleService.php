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

}
