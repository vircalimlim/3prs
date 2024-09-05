<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        // check if user input email or user key
        // uncomment this if you want to support email as login
        // $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_key';
        $loginType = 'user_key';
 
        if (Auth::attempt([$loginType => $request->login, 'password' => $request->password])){
            $request->session()->regenerate();

            $user = auth()->user();
            if($user->student_id == 0 || $user->semester_id == 0){
                return redirect()->intended('dashboard');
            }
            return redirect()->to('/student');
        }
 
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('login');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
