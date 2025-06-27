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
            return view('perfil.configuser', ['email' => Auth::user()->email]);


    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096', // Máximo 4MB
            'email' => 'required|email|unique:users,email,' . $user->id,
        ];

        // Solo requiere contraseña si se cambia email o contraseña
        $changingEmail = $user->email !== $request->email;
        $changingPassword = $request->filled('new_password');

        if ($changingEmail || $changingPassword) {
            $rules['password'] = 'required';
        }

        if ($changingPassword) {
            $rules['new_password'] = 'min:8';
            $rules['confirm_password'] = 'same:new_password';
        }

        $request->validate($rules);

        // Verifica la contraseña actual solo si se cambia email o contraseña
        if (($changingEmail || $changingPassword) && !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'La contraseña actual es incorrecta.'])->withInput();
        }

        // Actualiza el email si cambió
        if ($changingEmail) {
            $user->email = $request->email;
        }
        
        // Si el usuario quiere quitar la foto de perfil
        if ($request->input('quitar_foto_perfil') == '1') {
            if ($user->fotoperfil) {
                \Storage::disk('public')->delete($user->fotoperfil);
                $user->fotoperfil = null;
            }
        }

        if ($request->hasFile('foto_perfil')) {
            $path = $request->file('foto_perfil')->store('perfil', 'public');
            $user->fotoperfil = $path;
        }

        // Actualiza la contraseña si se ingresó una nueva
        if ($changingPassword) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Datos actualizados correctamente.');
    }

    public function datosuserUpdate(Request $request)
    {

        $user = auth()->user();

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'genero' => 'required|string|in:Masculino,Femenino',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'required|string|max:255',
            'carrera' => 'nullable|string|max:255',
            'meta_voluntariado_interno' => 'nullable|integer|min:0',
            'meta_voluntariado_externo' => 'nullable|integer|min:0',
            'meta_chats' => 'nullable|integer|min:0',
            'meta_taller' => 'nullable|integer|min:0',
            'cargo' => 'nullable|string|max:255', // Para admins/personal
        ]);

        // Actualiza datos según el rol
        if ($user->role === 'user' && $user->becario) {
            $becario = $user->becario;
            $becario->nombre = $validated['nombre'];
            $becario->apellido = $validated['apellido'];
            $becario->cedula = $validated['cedula'];
            $becario->telefono = $validated['telefono'];
            $becario->genero = $validated['genero'];
            $becario->fecha_nacimiento = $validated['fecha_nacimiento'];
            $becario->direccion = $validated['direccion'];
            $becario->carrera = $validated['carrera'] ?? $becario->carrera;
            $becario->meta_volin = $validated['meta_voluntariado_interno'] ?? $becario->meta_volin;
            $becario->meta_volex = $validated['meta_voluntariado_externo'] ?? $becario->meta_volex;
            $becario->meta_chat = $validated['meta_chats'] ?? $becario->meta_chat;
            $becario->meta_taller = $validated['meta_taller'] ?? $becario->meta_taller;
            $becario->save();
        } elseif ($user->role === 'admin' && $user->personal) {
            $personal = $user->personal;
            $personal->nombre = $validated['nombre'];
            $personal->apellido = $validated['apellido'];
            $personal->cedula = $validated['cedula'];
            $personal->telefono = $validated['telefono'];
            $personal->genero = $validated['genero'];
            $personal->fecha_nacimiento = $validated['fecha_nacimiento'];
            $personal->direccion = $validated['direccion'];
            $personal->cargo = $validated['cargo'] ?? $personal->cargo;
            $personal->save();
        }

        return redirect()->back()->with('success', 'Datos actualizados correctamente.');
    }
}



