<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): Response
    {
        $reset_token = DB::table('password_reset_tokens')->where('token', $request->route('token'))->first();
        if (!$reset_token) {
            abort(404);
        }

        return Inertia::render('Auth/ResetPassword', [
            'user_key' => $reset_token->user_key,
            'token' => $request->route('token'),
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'user_key' => 'required|exists:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'user_key' => $request->user_key,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('user_key', $request->user_key)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['user_key' => $request->user_key])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
