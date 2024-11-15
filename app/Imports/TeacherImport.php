<?php

namespace App\Imports;

use Log;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TeacherImport implements ToModel, WithHeadingRow,WithValidation
{
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone'    => 'required|string|max:15|unique:users,phone',
            'classroom_id'=> 'nullable|exists:class_rooms,id',
            'role'     => 'required|string|exists:roles,name', // Assuming roles are validated
        ];
    }
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
            'class_id'=>$row['classroom_id'],
        ]);

        if(!empty($row['role'])){
            $user->assignRole($row['role']);
        }

        return $user;
    }

}
