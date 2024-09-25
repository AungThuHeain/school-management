<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getAll()
    {
        return User::with(['roles'])->paginate(10);
    }
}
