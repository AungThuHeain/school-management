<?php

namespace App\Services\Admin;

use App\Models\School;

class SchoolService
{
    public function getAll()
    {
        return School::paginate(10);
    }
}
