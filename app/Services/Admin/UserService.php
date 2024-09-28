<?php

namespace App\Services\Admin;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserService
{
    public function getAll()
    {
        return User::with(['roles'])->paginate(10);
    }

    public function getAllRoles()
    {
        return Role::all();
    }

    public function update($request,$id)
    {
        $user = User::find($id);
        $user->update($request->all());
        $user->syncRoles($request->role);
        return $user;
    }
}
