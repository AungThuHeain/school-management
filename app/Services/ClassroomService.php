<?php

namespace App\Services;

use App\Models\ClassRoom;

class ClassroomService
{
    public function getAll()
    {
        return ClassRoom::paginate(10);
    }
}
