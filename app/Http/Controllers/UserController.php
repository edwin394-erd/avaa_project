<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Becario;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\UsuarioCreado;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['becario', 'personal'])->paginate(15);
        
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        if ($request->tipo === 'becario') {
         
            $validator = \Validator::make($request->all(), [
                'becario_nombre'   => ['required', 'max:100', 'min:1', 'regex:/^[\pL\s\-]+$/u'],
                'becario_apellido' => ['required', 'max:100', 'min:1', 'regex:/^[\pL\s\-]+$/u'],
                'becario_email'    => ['required', 'max:30', 'min:5', 'unique:users,email', 'email'],
                'becario_cedula'   => [
                    'required',
                    'max:20',
                    'min:7',
                    'regex:/^[\d\s\-]+$/u',
                    function ($attribute, $value, $fail) {
                        if (\DB::table('becarios')->where('cedula', $value)->exists()) {
                            $fail('La cédula ya fue registrada en los becarios.');
                        }
                    }
                ],
                'becario_telefono' => ['required', 'min:11'],
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('tab', 'becario');
            }

            $password = Str::random(10);

            file_put_contents(
                storage_path('usuarios_creados.txt'),
                "Tipo: Becario | Email: {$request->becario_email} | Contraseña: {$password} | Fecha de creación: " . now()->format('Y-m-d H:i:s') . "\n",
                FILE_APPEND
            );

            // Crear usuario primero
            $usuario = User::create([
                'email'      => $request->becario_email,
                'role'       => $request->becario_role ?? 'user',
                'password'   => Hash::make($password),
                'activo'     => 1,
            ]);

            // Crear becario y asociar user_id
            $becario = Becario::create([
                'user_id'   => $usuario->id,
                'nombre'    => $request->becario_nombre,
                'apellido'  => $request->becario_apellido,
                'cedula'    => $request->becario_cedula,
                'carrera'   => $request->becario_carrera,
                'semestre'  => $request->becario_semestre,
                'genero'    => $request->becario_genero,
                'telefono'  => $request->becario_telefono,
                'direccion' => $request->becario_direccion,
                'genero'    => $request->becario_genero,
                'meta_taller' => $request->becario_meta_taller ?? 0,
                'meta_chat'   => $request->becario_meta_chat ?? 0,
                'meta_volin'  => $request->becario_meta_volin ?? 0,
                'meta_volex'  => $request->becario_meta_volex ?? 0,
                'nivel_cevaz' => $request->becario_nivel_cevaz ?? 1,
                'fecha_nacimiento' => $request->becario_fecha_nacimiento,
            ]);

      
            Mail::to($request->becario_email)->send(new UsuarioCreado($password));

            return redirect()->route('users.index')->with('success', 'Usuario becario creado correctamente y contraseña enviada por correo');
        }

        // PERSONAL/ADMIN
        if ($request->tipo === 'personal') {
            $validator = \Validator::make($request->all(), [
                'personal_nombre'   => ['required', 'max:100', 'min:1', 'regex:/^[\pL\s\-]+$/u'],
                'personal_apellido' => ['required', 'max:100', 'min:1', 'regex:/^[\pL\s\-]+$/u'],
                'personal_email'    => ['required', 'max:30', 'min:5', 'unique:users,email', 'email'],
                'personal_cedula'   => [
                    'required',
                    'max:20',
                    'min:7',
                    'regex:/^[\d\s\-]+$/u',
                    function ($attribute, $value, $fail) {
                        if (\DB::table('personals')->where('cedula', $value)->exists()) {
                            $fail('La cédula ya fue registrada en el personal.');
                        }
                    }
                ],
                'personal_telefono' => ['required', 'min:11'],
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('tab', 'personal');
            }

            $password = Str::random(10);

            file_put_contents(
                storage_path('usuarios_creados.txt'),
                "Tipo: Personal | Email: {$request->personal_email} | Contraseña: {$password} | Fecha de creación: " . now()->format('Y-m-d H:i:s') . "\n",
                FILE_APPEND
            );

            // Crear usuario primero
            $usuario = User::create([
                'email'      => $request->personal_email,
                'role'       => $request->personal_role ?? 'admin',
                'password'   => Hash::make($password),
                'activo'     => 1,
            ]);

            // Crear personal y asociar user_id
            $personal = Personal::create([
                'user_id'   => $usuario->id,
                'nombre'    => $request->personal_nombre,
                'apellido'  => $request->personal_apellido,
                'cedula'    => $request->personal_cedula,
                'correo'    => $request->personal_email,
                'fecha_nacimiento' => $request->personal_fecha_nacimiento,
                'cargo'     => $request->personal_cargo,
                'telefono'  => $request->personal_telefono,
                'direccion' => $request->personal_direccion,
                'genero'    => $request->personal_genero,
            ]);

            Mail::to($request->personal_email)->send(new UsuarioCreado($password));

            return redirect()->route('users.index')->with('success', 'Usuario personal creado correctamente')->with('tab', 'personal');
        }

        return redirect()->route('users.index')->with('error', 'Tipo de usuario no válido');
    }

    public function update(Request $request, $id)
    {
        $user = User::with(['becario', 'personal'])->findOrFail($id);

        if ($user->role === 'user' && $user->becario) {
            $validator = \Validator::make($request->all(), [
                'nombre'   => ['required', 'max:100', 'min:1', 'regex:/^[\pL\s\-]+$/u'],
                'apellido' => ['required', 'max:100', 'min:1', 'regex:/^[\pL\s\-]+$/u'],
                'email'    => ['required', 'max:30', 'min:5', 'email', 'unique:users,email,'.$user->id],
                'cedula'   => ['required', 'max:20', 'min:7', 'regex:/^[\d\s\-]+$/u'],
                'telefono' => ['required', 'min:11'],
            ]);

            if ($validator->fails()) {
                return redirect()->route('users.index')->with('error', 'Error al actualizar el usuario, verifique los datos ingresados')->withErrors($validator)->withInput();
            }

            $user->becario->update([
                'nombre'   => $request->nombre,
                'apellido' => $request->apellido,
                'cedula'   => $request->cedula,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'carrera'  => $request->carrera,
                'semestre' => $request->semestre,
                'meta_taller' => $request->meta_taller,
                'meta_chat' => $request->meta_chat,
                'meta_volin' => $request->meta_volin,
                'meta_volex' => $request->meta_volex,
                'nivel_cevaz' => $request->nivel_cevaz,
                'genero' => $request->genero,
            ]);
            $user->update([
                'email' => $request->email,
            ]);
        } elseif ($user->role === 'admin' && $user->personal) {
            $validator = \Validator::make($request->all(), [
                'nombre'   => ['required', 'max:100', 'min:1', 'regex:/^[\pL\s\-]+$/u'],
                'apellido' => ['required', 'max:100', 'min:1', 'regex:/^[\pL\s\-]+$/u'],
                'email'    => ['required', 'max:30', 'min:5', 'email', 'unique:users,email,'.$user->id],
                'cedula'   => ['required', 'max:20', 'min:7', 'regex:/^[\d\s\-]+$/u'],
                'telefono' => ['required', 'min:11'],
                'cargo'    => ['nullable', 'max:100'],
            ]);

            if ($validator->fails()) {
                return redirect()->route('users.index')->with('error', 'Error al actualizar el usuario, verifique los datos ingresados')->withErrors($validator)->withInput();
            }

            $user->personal->update([
                'nombre'   => $request->nombre,
                'apellido' => $request->apellido,
                'cedula'   => $request->cedula,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'cargo'    => $request->cargo,
                'genero'   => $request->genero,
            ]);
            $user->update([
                'email' => $request->email,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function activar($id)
    {
        $user = User::findOrFail($id);
        $user->activo = 1;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario activado correctamente');
    }

    public function desactivar($id)
    {
        $user = User::findOrFail($id);
        $user->activo = 0;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario desactivado correctamente');
    }

    public function showbecario($id)
    {
        $user = User::with(['becario'])->findOrFail($id);
        return view('users.show', compact('user'));
    }
}