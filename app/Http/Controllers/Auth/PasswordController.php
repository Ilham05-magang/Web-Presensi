<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class PasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => "Email reset password sudah terkirim! Silakan cek email dan spam"]);
        } elseif ($status === 'Please wait before retrying') {
            return back()->with(['email' => 'Mohon ditunggu sebelum mencoba lagi']);
        } else {
            return back()->with(['email' => 'Tidak dapat menemukan pengguna dengan email yang sama']);
        }
        
    }

    public function showResetPasswordForm(string $token, Request $request)
    {
        $email = $request->query('email');
        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ], [
            'password.required_with' => 'Password lama wajib diisi jika Password baru terisi.',
            'password_confirmation.required_with' => 'Konfirmasi password baru wajib diisi jika Password terisi.',
            'password.confirmed' => 'Password dan konfirmasi password tidak sama.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}

