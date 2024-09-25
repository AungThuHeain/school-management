<?php

namespace App\Services\Student;

class LoginService{
    public function  login($request)
    {
       if(!auth('student')->attempt($request->validated())){
          return back()->withErrors([
              'email' => 'The provided credentials do not match our records.',
          ])->onlyInput('email');
       }

       if(auth('web')->check()){
          auth()->logout();
       }elseif( auth('admin')->check()){
          auth()->logout();
       }

       $request->session()->regenerate();
    }
}
