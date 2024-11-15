<?php

namespace App\Imports;

use App\Models\User;
use App\Rules\CheckEduYear;
use Illuminate\Contracts\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToModel, WithHeadingRow,WithValidation
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user =  new User([
            'name'=>$row['name'],
            'phone'=>$row['phone'],
            'class_id'=>$row['classroom_id'],
            'roll_no'=>$row['roll_no'],
            'role'=>$row['role'],
            'edu_year'=>$row['education_year'],
        ]);

        if(!empty($row['role'])){
            $user->assignRole($row['role']);
        }

        return $user;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:15|unique:users,phone',
            'classroom_id' => 'required|exists:class_rooms,id',
            'roll_no'  => 'required|string|max:20',
            'role'     => 'required|string|exists:roles,name',
            'education_year' => ['required',new CheckEduYear],
        ];
    }
}
