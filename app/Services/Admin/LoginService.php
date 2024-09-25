<?php

namespace App\Services\Admin;

class LoginService
{
  public function  login($request)
  {
     if(!auth('admin')->attempt($request->validated())){
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
     }

     if(auth('web')->check()){
        auth()->logout();
     }elseif( auth('student')->check()){
        auth()->logout();
     }

     $request->session()->regenerate();
  }
}
