<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Becario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Mostrar la lista de usuarios
    public function index()
    {
        $users = User::with(['becario', 'personal'])->paginate(15);
        return view('users.index', compact('users'));
    }

    // Guardar un nuevo usuario (becario)
  public function store(Request $request)
{
    if ($request->tipo === 'becario') {
        $validator = \Validator::make($request->all(), [
            'becario_nombre'   => ['required', 'max:100', 'min:1', 'regex:/^[\pL\s\-]+$/u'],
            'becario_apellido' => ['required', 'max:100', 'min:1', 'regex:/^[\pL\s\-]+$/u'],
            'becario_email'    => ['required', 'max:30', 'min:5', 'unique:users,email', 'email'],
            'becario_password' => ['required', 'max:30', 'min:6'],
            'becario_cedula'   => [
                'required',
                'max:20',
                'min:1',
                'regex:/^[\d\s\-]+$/u',
                function ($attribute, $value, $fail) {
                    if (\DB::table('becarios')->where('cedula', $value)->exists()) {
                        $fail('La cédula ya fue registrada en los becarios.');
                    }
                }
            ],
        ], [
            'required'                      => 'Este campo es obligatorio.',
            'max'                           => 'Máximo :max carac.',
            'min'                           => 'Mínimo :min carac.',
            'unique'                        => 'Ya está registrado.',
            'email'                         => 'Formato incorrecto.',
            'regex'                         => 'Formato incorrecto.',

        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('tab', 'becario');
        }

        $becario = \App\Models\Becario::create([
            'nombre'   => $request->becario_nombre,
            'apellido' => $request->becario_apellido,
            'cedula'   => $request->becario_cedula,
            'activo'   => 1,
        ]);

        \App\Models\User::create([
            'becario_id' => $becario->id,
            'email'      => $request->becario_email,
            'role'       => 'user',
            'password'   => \Hash::make($request->becario_password),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario becario creado correctamente');
    }

    // PERSONAL
    if ($request->tipo === 'personal') {
        $validator = \Validator::make($request->all(), [
            'personal_nombre'   => ['required', 'max:100', 'min:1', 'regex:/^[\pL\s\-]+$/u'],
            'personal_apellido' => ['required', 'max:100', 'min:1', 'regex:/^[\pL\s\-]+$/u'],
            'personal_email'    => ['required', 'max:30', 'min:5', 'unique:users,email', 'email'],
            'personal_password' => ['required', 'max:30', 'min:6'],
            'personal_cedula'   => [
                'required',
                'max:20',
                'min:1',
                'regex:/^[\d\s\-]+$/u',
                function ($attribute, $value, $fail) {
                    if (\DB::table('personals')->where('cedula', $value)->exists()) {
                        $fail('La cédula ya fue registrada en el personal.');
                    }
                }
            ],
        ], [
            'required'                      => 'Este campo es obligatorio.',
            'max'                           => 'Máximo :max carac.',
            'min'                           => 'Mínimo :min carac.',
            'unique'                        => 'Ya está registrado.',
            'email'                         => 'Formato incorrecto.',
            'regex'                         => 'Formato incorrecto.',

        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('tab', 'personal');
        }

        $personal = \App\Models\Personal::create([
            'nombre'   => $request->personal_nombre,
            'apellido' => $request->personal_apellido,
            'cedula'   => $request->personal_cedula,
            'activo'   => 1,
        ]);

        \App\Models\User::create([
            'personal_id' => $personal->id,
            'email'       => $request->personal_email,
            'role'        => 'admin',
            'password'    => \Hash::make($request->personal_password),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario personal creado correctamente');
    }

    // Si no es ninguno, redirige
    return redirect()->route('users.index')->with('error', 'Tipo de usuario no válido');
}
}
