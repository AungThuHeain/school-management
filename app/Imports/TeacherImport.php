<?php

namespace App\Imports;

use Log;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Http\Exceptions\HttpResponseException;
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
        ]);

        if(!empty($row['role'])){
            $user->assignRole($row['role']);
        }

        return $user;
    }

}
