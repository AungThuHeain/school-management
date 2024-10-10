<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\School;
use App\Models\ClassRoom;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

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
