<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Classroom;
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
        $roles = ['Owner','Headmaster','Teacher'];
        $classes = ['Kindergarten','Grade-1','Grade-2','Grade-3','Grade-4','Grade-5','Grade-6','Grade-7','Grade-8','Grade-9','Grade-10','Grade-11','Grade-12'];

        $school = School::create([
            'name'=>'Demo School',
        ]);

        foreach($roles as $role){
            Role::create(['name' => $role]);
        }

        foreach($classes as $class){
            Classroom::create([
                'name' => $class
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

        //student user seeder
        $students = [
            [
                'name' => 'Student',
                'email' => 'student@gmail.com',
                'password' => 'password',
            ],
        ];

        foreach($students as $user){
            Student::create([
               'name'=>$user['name'],
               'school_id'=>$school->id,
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
