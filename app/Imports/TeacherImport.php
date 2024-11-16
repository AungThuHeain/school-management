<?php

namespace App\Imports;

use App\Jobs\SendInvitationMail;
use Log;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        return DB::transaction(function () use ($row) {
            $user = User::create([
                'name'      => $row['name'],
                'email'     => $row['email'],
                'password'  => bcrypt($row['password']),
                'phone'     => $row['phone'],
                'class_id'  => $row['classroom_id'],
            ]);

            if (!empty($row['role'])) {
                $user->assignRole($row['role']);
            }

            $password = $row['password'];

            // Dispatch job to send email
            SendInvitationMail::dispatch($user,$password);

            return $user;
        });
    }

}
