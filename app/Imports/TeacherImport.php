<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeacherImport implements ToModel,WithHeadingRow
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
            'email'=>$row['email'],
            'password'=>bcrypt($row['password']),
            'phone'=>$row['phone'],
        ]);

        if(!empty($row['role'])){
            $user->assignRole($row['role']);
        }

        return $user;
    }
}
