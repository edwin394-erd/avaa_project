<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Becario;
use App\Models\Personal;
use App\Models\Stat;
use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\UsuarioCreado;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['becario', 'personal'])->orderBy('created_at', 'desc')->paginate(10000);


    
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
                'becario_direccion' => ['nullable', 'max:255'],
                'becario_carrera'  => ['nullable', 'max:100'],
                'becario_genero'   => ['required', 'in:Masculino,Femenino'],
                'becario_fecha_nacimiento' => ['required', 'date', 'before:today'],
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
                'personal_direccion' => ['nullable', 'max:255'],
                'personal_cargo'    => ['nullable', 'max:100'],
                'personal_genero'   => ['required', 'in:Masculino,Femenino'],
                'personal_fecha_nacimiento' => ['required', 'date', 'before:today'],

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
        $startOfYear = Carbon::now()->startOfYear();  // Primer día del año (01-01)
        $endOfYear = Carbon::now()->endOfYear();  // Último día del año (31-12)
        $user = User::with(['becario'])->findOrFail($id);
        $meta_volin= $user->becario->meta_volin;
        $meta_volex= $user->becario->meta_volex;
        $meta_taller= $user->becario->meta_taller;
        $meta_chat= $user->becario->meta_chat;
        $nombre_user= $user->becario->nombre;
        $cedula_becario= $user->becario->cedula;
        $becario = $user->becario;


        //VOLUNTARIADO INTERNO
        $stats_volin = Stat::where('becario_id', $becario->id)
            ->where('actividad', 'volin')
            ->where('anulado', 'NO')
            ->where('estado', 'aprobado')
            ->where('fecha', '>=', $startOfYear)
            ->get();
        $total_volin = $stats_volin->sum('duracion'); //TOTAL HORAS
        $porcen_volin = ($total_volin / $meta_volin) * 100;
        $porcen_volin = number_format($porcen_volin, 2); //PORCENTAJE
        if ($porcen_volin > 100) {
            $porcen_volin = 100;
        }

        //VOLUNTARIADO EXTERNO
        $stats_volex = Stat::where('becario_id', $becario->id)
            ->where('actividad', 'volex')
            ->where('anulado', 'NO')
            ->where('estado', 'aprobado')
            ->where('fecha', '>=', $startOfYear)
            ->get();
        $total_volex = $stats_volex->sum('duracion'); //TOTAL HORAS
        $porcen_volex = ($total_volex / $meta_volex) * 100;
        $porcen_volex = number_format($porcen_volex, 2); //PORCENTAJE
        if ($porcen_volex > 100) {
            $porcen_volex = 100;
        }

        //TALLER
        $stats_taller = Stat::where('becario_id', $becario->id)
            ->where('actividad', 'taller')
            ->where('anulado', 'NO')
            ->where('estado', 'aprobado')
            ->where('fecha', '>=', $startOfYear)
            ->get();
        $total_taller = $stats_taller->sum('duracion'); //TOTAL HORAS
        $porcen_taller = ($total_taller / $meta_taller) * 100;
        $porcen_taller = number_format($porcen_taller, 2); //PORCENTAJE
        if ($porcen_taller > 100) {
            $porcen_taller = 100;
        }

        //CHAT
        $stats_chat = Stat::where('becario_id', $becario->id)
            ->where('actividad', 'chat')
            ->where('anulado', 'NO')
            ->where('estado', 'aprobado')
            ->where('fecha', '>=', $startOfYear)
            ->get();
        $total_chat = $stats_chat->sum('duracion'); //TOTAL HORAS
        $porcen_chat = ($total_chat / $meta_chat) * 100;
        $porcen_chat = number_format($porcen_chat, 2); //PORCENTAJE
        if ($porcen_chat > 100) {
            $porcen_chat = 100;
        }

        //STATS
        $stats = Stat::where('becario_id', $becario->id)
            ->where('anulado', 'NO')
            ->where('estado', 'aprobado')
            ->orderBy('created_at')
            ->get();

        //PROGRESO TOTAL
        $progreso_total = ($porcen_volin + $porcen_volex + $porcen_taller + $porcen_chat) / 4;
        $horas_totales = $total_volin + $total_volex + $total_taller + $total_chat;
        $meta_total = $meta_volin + $meta_volex + $meta_taller + $meta_chat;

        //PROGRESO POR MES
        //stats con campo fecha de enero a diciembre
       // Consulta optimizada para obtener los datos de los últimos 12 meses
       // Obtener el inicio y el fin del año actual



        $stats_anual = Stat::where('becario_id', $becario->id)
            ->where('anulado', 'NO')
            ->where('estado', 'aprobado')
            ->whereBetween('fecha', [$startOfYear, $endOfYear])
            ->selectRaw('
            MONTH(fecha) as month,
            SUM(duracion) as total_duracion,
            SUM(CASE WHEN actividad = "volin" THEN duracion ELSE 0 END) as total_volin_duracion,
            SUM(CASE WHEN actividad = "volex" THEN duracion ELSE 0 END) as total_volex_duracion,
            SUM(CASE WHEN actividad = "taller" THEN duracion ELSE 0 END) as total_taller_duracion,
            SUM(CASE WHEN actividad = "chat" THEN duracion ELSE 0 END) as total_chat_duracion
            ')
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        $stats_sinfiltro = Stat::where('becario_id', $becario->id)
            ->where('anulado', 'NO')
            ->whereBetween('fecha', [$startOfYear, $endOfYear])
            ->get();


        // Crear arrays vacíos con valores predeterminados de 0
        $total_por_mes = array_fill(0, 11, 0);
        $total_volin_por_mes = array_fill(0, 11, 0);
        $total_volex_por_mes = array_fill(0, 11, 0);
        $total_taller_por_mes = array_fill(0, 11, 0);
        $total_chat_por_mes = array_fill(0, 11, 0);

        // Rellenar los arrays con los datos obtenidos en la consulta
        foreach ($stats_anual as $mes => $datos) {
            $total_por_mes[$mes] = $datos->total_duracion ?? 0;
            $total_volin_por_mes[$mes] = $datos->total_volin_duracion ?? 0;
            $total_volex_por_mes[$mes] = $datos->total_volex_duracion ?? 0;
            $total_taller_por_mes[$mes] = $datos->total_taller_duracion ?? 0;
            $total_chat_por_mes[$mes] = $datos->total_chat_duracion ?? 0;
        }

        $activities = Event::where('status', 'pendiente')
        ->orderBy('fecha', 'asc')
        ->paginate(8);


        return view('users.show', compact(
            'user',
            'meta_volin',
            'meta_volex',
            'meta_taller',
            'meta_chat',
            'nombre_user',
            'cedula_becario',
            'becario',
            'total_volin',
            'porcen_volin',
            'total_volex',
            'porcen_volex',
            'total_taller',
            'porcen_taller',
            'total_chat',
            'porcen_chat',
            'stats',
            'progreso_total',
            'horas_totales',
            'meta_total',
            'total_por_mes',
            'total_volin_por_mes',
            'total_volex_por_mes',
            'total_taller_por_mes',
            'total_chat_por_mes',
            'stats_sinfiltro',
            'activities'
        ));
    }
}
