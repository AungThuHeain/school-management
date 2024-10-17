<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\School;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $classes = ['Kindergarten','Grade-1','Grade-2','Grade-3','Grade-4','Grade-5','Grade-6','Grade-7','Grade-8','Grade-9','Grade-10','Grade-11','Grade-12'];

        //get school for tenant  class and users
        $school = School::first();

        foreach($classes as $class){
            ClassRoom::create([
                'name' => $class
                ,'school_id'=>$school->id
            ]);
        }

        //admin user seeder
        $admins = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'password',
            ],
        ];

        foreach($admins as $user){
             Admin::create([
                'name'=>$user['name'],
                'email'=>$user['email'],
                'password'=>bcrypt('password'),
            ]);
        }


       //user seeder
       $users = [
            [
                'name' => 'Owner',
                'email' => 'owner@gmail.com',
                'password' => 'password',
                'role'=>'Owner',
            ],
            [
                'name' => 'Headmaster',
                'email' => 'headmaster@gmail.com',
                'password' => 'password',
                'role'=>'Headmaster',
            ],
            [
                'name' => 'Teacher',
                'email' => 'teacher@gmail.com',
                'password' => 'password',
                'role'=>'Teacher',
            ],

        ];

        //set school for tenant
        setPermissionsTeamId($school->id);

        foreach($users as $user){
           $created_user = User::create([
               'name'=>$user['name'],
               'school_id'=>$school->id,
               'email'=>$user['email'],
               'password'=>bcrypt('password'),
           ]);
           $created_user->assignRole($user['role']);
       }


    }
}
