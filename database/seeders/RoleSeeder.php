<?php

namespace Database\Seeders;

use App\Models\School;
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
        //first create school for tenant roles
        $school = School::create([
            'name'=>'Demo School',
        ]);

         $ownerRole =   Role::create(['name' => 'Owner','school_id'=>$school->id]);
         $headmasterRole =   Role::create(['name' => 'Headmaster','school_id'=>$school->id]);
         $teacherRole =   Role::create(['name' => 'Teacher','school_id'=>$school->id]);
         $studentRole =   Role::create(['name' => 'Student','school_id'=>$school->id]);



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
