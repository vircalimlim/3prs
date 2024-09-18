<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $today = date('Y-m-d');
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        // check if user input email or user key
        // uncomment this if you want to support email as login
        // $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_key';
        $loginType = 'user_key';

        if (Auth::attempt([$loginType => $request->login, 'password' => $request->password])) {

            $user = auth()->user();
            if ($user->student_id == 0 || $user->semester_id == 0) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }

            $semester = Semester::find($user->semester_id);
            if(!$semester){
                return back()->withErrors([
                    'login' => 'Your login key is expired or invalid.',
                ])->onlyInput('login');
            }

            $semester_valid = DB::table('semesters')
            ->where('id', $user->semester_id)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->first();
            if(!$semester_valid){
                return back()->withErrors([
                    'login' => 'Your login key is expired or invalid.',
                ])->onlyInput('login');
            }

            $request->session()->regenerate();

            return redirect()->to('/announcements');
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
