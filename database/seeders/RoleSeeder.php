<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Owner','Headmaster','Teacher','Student'];

         $ownerRole =   Role::create(['name' => 'Owner']);
         $headmasterRole =   Role::create(['name' => 'Headmaster']);
         $teacherRole =   Role::create(['name' => 'Teacher']);
         $studentRole =   Role::create(['name' => 'Student']);



        $permissions = ['role','class','teacher'];
        $actions = ['create','read','write','delete'];

        foreach($permissions as $permission){
            foreach($actions as $action){
                Permission::create(['name' => $permission.'_'.$action]);
            }
        }

        $ownerRole->givePermissionTo(Permission::all());
        $headmasterRole->givePermissionTo(Permission::where('name','not like','%role_%')->get());
        $teacherRole->givePermissionTo(Permission::where('name','not like','%role_%')->where('name','not like','class_')->get());


    }
}
