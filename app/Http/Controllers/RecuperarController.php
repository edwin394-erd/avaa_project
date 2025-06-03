<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class RecuperarController extends Controller
{
    // Muestra el formulario de recuperación
    public function index(Request $request)
    {
        return view('auth.forgotpassword');
    }

    // Procesa la solicitud de recuperación
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Envía el enlace de restablecimiento
        $status = Password::sendResetLink(
            $request->only('email')
        );

       return $status === Password::RESET_LINK_SENT
            ? back()->with('success', '¡Enlace de recuperación enviado a tu correo!')
            : back()->withErrors(['email' => __($status)]);
    }
}
