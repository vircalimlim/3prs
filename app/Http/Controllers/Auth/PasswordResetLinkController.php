<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'user_key' => 'required|exists:users',
            ]);

            $userKeyExist = DB::table('password_reset_tokens')->where('user_key', $request->user_key)->exists();
            if ($userKeyExist) {
                DB::table('password_reset_tokens')->where('user_key', $request->user_key)->delete();
            }

            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                'user_key' => $request->user_key,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $user = DB::table('users')->where('user_key', $request->user_key)->first();
            $toEmail = $user->email;
            $subject = 'Reset Password';
            $message = 'Here is your password reset link: ' . url('/reset-password/' . $token);

            Mail::raw($message, function ($message) use ($toEmail, $subject) {
                $message->to($toEmail)
                    ->subject($subject);
            });

            return back()->with('status', 'We have e-mailed your password reset link!');
        } catch (\Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Unable to send password reset link. Please try again later or contact support.']);
        }
    }
}
