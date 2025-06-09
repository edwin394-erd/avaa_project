<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index(){
        if (auth()->check()) {
            return redirect(route('home'));

        } else {
            return view('auth.login');
        }

    }

    public function store(Request $request){
        //validacion
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'password.required' => 'Ingresa tu contraseña.'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->withInput()->with('error', 'Email o contraseña incorrectos');
        }

        // Verificar si el usuario está activo
        if (auth()->user()->activo == 0) {
            auth()->logout();
            return back()->withInput()->with('error', 'Tu cuenta ha sido desactivada');
        }



        return redirect(route('home'));
    }
}
