<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\School;
use App\Models\ClassRoom;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Spatie\Permission\Models\Permission;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'school_name' => ['required', 'string', 'max:255'],
        ]);

        //create school
        $school = School::create([
            'name'=>$request->school_name,
        ]);

        $classes = ['Kindergarten','Grade-1','Grade-2','Grade-3','Grade-4','Grade-5','Grade-6','Grade-7','Grade-8','Grade-9','Grade-10','Grade-11','Grade-12'];

        foreach($classes as $class){
            ClassRoom::create([
                'name' => $class
                ,'school_id'=>$school->id
            ]);
        }


        //set school for tenant
        setPermissionsTeamId($school->id);
        $ownerRole =   Role::create(['name' => 'Owner','school_id'=>$school->id]);
        $headmasterRole =   Role::create(['name' => 'Headmaster','school_id'=>$school->id]);
        $teacherRole =   Role::create(['name' => 'Teacher','school_id'=>$school->id]);
        $studentRole =   Role::create(['name' => 'Student','school_id'=>$school->id]);

        $ownerRole->givePermissionTo(Permission::all());
        $headmasterRole->givePermissionTo(Permission::where('name','not like','%role_%')->get());
        $teacherRole->givePermissionTo(Permission::where('name','not like','%role_%')->where('name','not like','class_')->get());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_id' => $school->id,
        ]);

        $user->assignRole('Owner');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
