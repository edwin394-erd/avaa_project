<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function datosindex(){
            return view('perfil.becario');


    }
    public function configindex(){
            return view('perfil.configuser');


    }
     public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required',
            'new_password' => 'nullable|min:6',
            'confirm_password' => 'same:new_password',
        ]);

        // Verifica la contraseña actual
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'La contraseña actual es incorrecta.'])->withInput();
        }

        // Actualiza el email si cambió
        if ($user->email !== $request->email) {
            $user->email = $request->email;
        }

        // Actualiza la contraseña si se ingresó una nueva
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Datos actualizados correctamente.');
    }
}



