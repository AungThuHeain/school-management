<?php

namespace App\Http\Controllers\Student\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Services\Student\LoginService;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Student\LoginRequest;


class LoginController extends Controller
{
     private $loginService;
     public function __construct(LoginService $loginService)
     {
        $this->loginService = $loginService;
     }

        /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('student.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $this->loginService->login($request);

        return redirect()->intended(RouteServiceProvider::STUDENT_DASHBOARD);

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        Auth::guard('student')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
