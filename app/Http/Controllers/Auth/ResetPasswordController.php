<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    // Muestra el formulario de reset (opcional, si usas una ruta tipo GET)
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    // Procesa el formulario de reset
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', '¡Contraseña restablecida correctamente! Ahora puedes iniciar sesión.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
