<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use App\Models\Evidencia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Notification;

class StatController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }

    public function index(Request $request){
        $user = auth()->user();

        if ($user->role === 'admin') {
            $startOfYear = Carbon::now()->startOfYear();
            $endOfYear = Carbon::now()->endOfYear();
            $user = auth()->user();
            $stats = Stat::with('evidencias')
            ->where('anulado', 'NO')
            ->orderBy('created_at', 'desc')
            ->get();
            $meta_volin = \App\Models\Becario::sum('meta_volin');
            $meta_volex = \App\Models\Becario::sum('meta_volex');
            $meta_taller = \App\Models\Becario::sum('meta_taller');
            $meta_chat = \App\Models\Becario::sum('meta_chat');

            $stats_realizado_volin = Stat::where('actividad', 'volin')
                ->where('estado', 'aprobado')
                ->where('anulado', 'NO')
                ->get();

            $stats_realizado_volex = Stat::where('actividad', 'volex')
                ->where('estado', 'aprobado')
                ->where('anulado', 'NO')
                ->get();

            $stats_realizado_taller = Stat::where('actividad', 'taller')
                ->where('estado', 'aprobado')
                ->where('anulado', 'NO')
                ->get();

            $stats_realizado_chat = Stat::where('actividad', 'chat')
                ->where('estado', 'aprobado')
                ->where('anulado', 'NO')
                ->get();

            // VOLUNTARIADO INTERNO
            $stats_volin = Stat::where('actividad', 'volin')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->get();
            $total_volin = $stats_volin->sum('duracion');
            $porcen_volin = 0;

            // VOLUNTARIADO EXTERNO
            $stats_volex = Stat::where('actividad', 'volex')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->get();
            $total_volex = $stats_volex->sum('duracion');
            $porcen_volex = 0;

            // TALLER
            $stats_taller = Stat::where('actividad', 'taller')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->get();
            $total_taller = $stats_taller->sum('duracion');
            $porcen_taller = 0;

            // CHAT
            $stats_chat = Stat::where('actividad', 'chat')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->get();
            $total_chat = $stats_chat->sum('duracion');
            $porcen_chat = 0;

            return view('stats.index')->with([
            'user' => $user,
            'stats' => $stats,
            'meta_volin' => $meta_volin ?? 0,
            'meta_volex' => $meta_volex ?? 0,
            'meta_taller' => $$meta_taller ?? 0,
            'meta_chat' => $meta_chat ?? 0,
            'stats_realizado_volin' => $stats_realizado_volin ?? [],
            'stats_realizado_volex' => $stats_realizado_volex ?? [],
            'stats_realizado_taller' => $stats_realizado_taller ?? [],
            'stats_realizado_chat' => $stats_realizado_chat ?? [],
            'total_volin' => $total_volin ?? 0,
            'total_volex' => $total_volex ?? 0,
            'total_taller' => $total_taller ?? 0,
            'total_chat' => $total_chat ?? 0,
            'porcen_volin' => $porcen_volin ?? 0,
            'porcen_volex' => $porcen_volex ?? 0,
            'porcen_taller' => $porcen_taller ?? 0,
            'porcen_chat' => $porcen_chat ?? 0,
        ]);
        } else {
            $stats = Stat::with('evidencias')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

             return view('stats.index')->with([
            'user' => $user,
            'stats' => $stats,
            'meta_volin' => $user->becario->meta_volin ?? 0,
            'meta_volex' => $user->becario->meta_volex ?? 0,
            'meta_taller' => $user->becario->meta_taller ?? 0,
            'meta_chat' => $user->becario->meta_chat ?? 0,
            'stats_realizado_volin' => $stats_realizado_volin ?? [],
            'stats_realizado_volex' => $stats_realizado_volex ?? [],
            'stats_realizado_taller' => $stats_realizado_taller ?? [],
            'stats_realizado_chat' => $stats_realizado_chat ?? [],
            'total_volin' => $total_volin ?? 0,
            'total_volex' => $total_volex ?? 0,
            'total_taller' => $total_taller ?? 0,
            'total_chat' => $total_chat ?? 0,
            'porcen_volin' => $porcen_volin ?? 0,
            'porcen_volex' => $porcen_volex ?? 0,
            'porcen_taller' => $porcen_taller ?? 0,
            'porcen_chat' => $porcen_chat ?? 0,
        ]);
        }


    }

    public function modalidadindex(String $modalidad){
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $user = auth()->user();

        if ($user->role === 'admin') {
            // Para admin, obtener metas y stats de todos los usuarios
            $meta_volin = \App\Models\Becario::sum('meta_volin');
            $meta_volex = \App\Models\Becario::sum('meta_volex');
            $meta_taller = \App\Models\Becario::sum('meta_taller');
            $meta_chat = \App\Models\Becario::sum('meta_chat');

            $stats_anual = Stat::where('anulado', 'NO')
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

            $stats_realizado = Stat::where('actividad', $modalidad)
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->get();

            // VOLUNTARIADO INTERNO
            $stats_volin = Stat::where('actividad', 'volin')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->get();
            $total_volin = $stats_volin->sum('duracion');
            $porcen_volin = 0;

            // VOLUNTARIADO EXTERNO
            $stats_volex = Stat::where('actividad', 'volex')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->get();
            $total_volex = $stats_volex->sum('duracion');
            $porcen_volex = 0;

            // TALLER
            $stats_taller = Stat::where('actividad', 'taller')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->get();
            $total_taller = $stats_taller->sum('duracion');
            $porcen_taller = 0;

            // CHAT
            $stats_chat = Stat::where('actividad', 'chat')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->get();
            $total_chat = $stats_chat->sum('duracion');
            $porcen_chat = 0;

            // Arrays por mes
            $total_volin_por_mes = array_fill(0, 11, 0);
            $total_volex_por_mes = array_fill(0, 11, 0);
            $total_taller_por_mes = array_fill(0, 11, 0);
            $total_chat_por_mes = array_fill(0, 11, 0);

            foreach ($stats_anual as $mes => $datos) {
            $total_volin_por_mes[$mes] = $datos->total_volin_duracion ?? 0;
            $total_volex_por_mes[$mes] = $datos->total_volex_duracion ?? 0;
            $total_taller_por_mes[$mes] = $datos->total_taller_duracion ?? 0;
            $total_chat_por_mes[$mes] = $datos->total_chat_duracion ?? 0;
            }

            return view('stats.show')->with([
            'user' => $user,
            'modalidad' => $modalidad,
            'stats' => Stat::with('evidencias')
                ->where('actividad', $modalidad)
                ->orderBy('created_at', 'desc')
                ->get(),
            'meta_volin' => $meta_volin,
            'meta_volex' => $meta_volex,
            'meta_taller' => $meta_taller,
            'meta_chat' => $meta_chat,
            'stats_realizado' => $stats_realizado,
            'total_volin' => $total_volin,
            'total_volex' => $total_volex,
            'total_taller' => $total_taller,
            'total_chat' => $total_chat,
            'porcen_volin' => $porcen_volin,
            'porcen_volex' => $porcen_volex,
            'porcen_taller' => $porcen_taller,
            'porcen_chat' => $porcen_chat,
            'total_volin_por_mes' => $total_volin_por_mes,
            'total_volex_por_mes' => $total_volex_por_mes,
            'total_taller_por_mes' => $total_taller_por_mes,
            'total_chat_por_mes' => $total_chat_por_mes,
            ]);
        } else {
            // Usuario normal (como estaba)
            $meta_volin = $user->becario->meta_volin;
            $meta_volex = $user->becario->meta_volex;
            $meta_taller = $user->becario->meta_taller;
            $meta_chat = $user->becario->meta_chat;

            $stats_anual = Stat::where('user_id', $user->id)
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

            $stats_realizado = Stat::where('user_id', $user->id)
            ->where('actividad', $modalidad)
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->get();

            //VOLUNTARIADO INTERNO
            $stats_volin = Stat::where('user_id', $user->id)
            ->where('actividad', 'volin')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->get();
            $total_volin = $stats_volin->sum('duracion');
            $porcen_volin = ($meta_volin > 0) ? ($total_volin / $meta_volin) * 100 : 0;
            $porcen_volin = number_format(min($porcen_volin, 100), 2);

            //VOLUNTARIADO EXTERNO
            $stats_volex = Stat::where('user_id', $user->id)
            ->where('actividad', 'volex')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->get();
            $total_volex = $stats_volex->sum('duracion');
            $porcen_volex = ($meta_volex > 0) ? ($total_volex / $meta_volex) * 100 : 0;
            $porcen_volex = number_format(min($porcen_volex, 100), 2);

            //TALLER
            $stats_taller = Stat::where('user_id', $user->id)
            ->where('actividad', 'taller')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->get();
            $total_taller = $stats_taller->sum('duracion');
            $porcen_taller = ($meta_taller > 0) ? ($total_taller / $meta_taller) * 100 : 0;
            $porcen_taller = number_format(min($porcen_taller, 100), 2);

            //CHAT
            $stats_chat = Stat::where('user_id', $user->id)
            ->where('actividad', 'chat')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->get();
            $total_chat = $stats_chat->sum('duracion');
            $porcen_chat = ($meta_chat > 0) ? ($total_chat / $meta_chat) * 100 : 0;
            $porcen_chat = number_format(min($porcen_chat, 100), 2);

            $total_volin_por_mes = array_fill(0, 11, 0);
            $total_volex_por_mes = array_fill(0, 11, 0);
            $total_taller_por_mes = array_fill(0, 11, 0);
            $total_chat_por_mes = array_fill(0, 11, 0);

            foreach ($stats_anual as $mes => $datos) {
            $total_volin_por_mes[$mes] = $datos->total_volin_duracion ?? 0;
            $total_volex_por_mes[$mes] = $datos->total_volex_duracion ?? 0;
            $total_taller_por_mes[$mes] = $datos->total_taller_duracion ?? 0;
            $total_chat_por_mes[$mes] = $datos->total_chat_duracion ?? 0;
            }

            return view('stats.show')->with([
            'user' => $user,
            'modalidad' => $modalidad,
            'stats' => Stat::with('evidencias')
                ->where('user_id', $user->id)
                ->where('actividad', $modalidad)
                ->orderBy('created_at', 'desc')
                ->get(),
            'meta_volin' => $meta_volin,
            'meta_volex' => $meta_volex,
            'meta_taller' => $meta_taller,
            'meta_chat' => $meta_chat,
            'stats_realizado' => $stats_realizado,
            'total_volin' => $total_volin,
            'total_volex' => $total_volex,
            'total_taller' => $total_taller,
            'total_chat' => $total_chat,
            'porcen_volin' => $porcen_volin,
            'porcen_volex' => $porcen_volex,
            'porcen_taller' => $porcen_taller,
            'porcen_chat' => $porcen_chat,
            'total_volin_por_mes' => $total_volin_por_mes,
            'total_volex_por_mes' => $total_volex_por_mes,
            'total_taller_por_mes' => $total_taller_por_mes,
            'total_chat_por_mes' => $total_chat_por_mes,
            ]);
        }
    }
    public function anular(Stat $stat)
    {
        if ($stat->estado === 'pendiente') {
            $stat->anulado = 'SI';
            $stat->save();
            return back()->with('success', 'Actividad anulada');
        }
        return back()->with('error', 'Solo se pueden anular actividades en estado pendiente');
    }

    public function restaurar(Stat $stat)
    {

        $stat->anulado = 'NO';
        $stat->save();
        return back()->with('success', 'Actividad restaurada');
    }

    public function aprobar(Stat $stat)
    {
        if ($stat->anulado === 'NO') {
            $stat->estado = 'aprobado';
            $stat->save();

            // Notificar al usuario dueño de la actividad
            Notification::create([
                'user_id' => $stat->user_id,
                'titulo' => 'Actividad aprobada',
                'mensaje' => 'Tu actividad "' . $stat->titulo . ' ('. \Carbon\Carbon::parse($stat->fecha)->format('d/m/Y') .') fue aprobada.',
                'stat_id' => $stat->id,
            ]);
                return back()->with('success', 'Actividad aprobada');
            }

        return back()->with('error', 'No se puede aprobar una actividad anulada');
    }

    public function rechazar(Stat $stat, Request $request)
    {
        if ($stat->anulado === 'NO') {
            $stat->estado = 'rechazado';
            $stat->observacion = $request->observacion ?? 'Actividad rechazada por el administrador';
            $stat->save();
            // Notificar al usuario dueño de la actividad
            Notification::create([
                'user_id' => $stat->user_id,
                'titulo' => 'Actividad rechazada',
                'mensaje' => 'Tu actividad "' . $stat->titulo . ' ('. \Carbon\Carbon::parse($stat->fecha)->format('d/m/Y') .') fue rechazada.',
                'stat_id' => $stat->id,
            ]);
            return back()->with('success', 'Actividad rechazada');
        }
        return back()->with('error', 'No se puede rechazar una actividad anulada');
    }


    public function store(Request $request){

        $this->validate($request,[

            'titulo' => 'required|max:30',
            'actividad' => 'required|min:1',
            'modalidad' => 'required|min:1',
            'duracion' => 'required|numeric|max:120',
            'fecha' => 'required|date|before_or_equal:today',
        ]);


        $stat = Stat::create([
            'titulo' => $request->titulo,
            'actividad' => $request->actividad,
            'modalidad' => $request->modalidad,
            'duracion' => $request->duracion,
            'observacion' => $request->motivo ?? null,
            'fecha' => $request->fecha,
            'user_id' => auth()->user()->id,
        ]);

        // si el request trae imagenes
        if ($request->filled('imagen')) {
        $imagenes = json_decode($request->imagen, true);
        if (is_array($imagenes)) {
            foreach ($imagenes as $nombreImagen) {
                Evidencia::create([
                    'stats_id' => $stat->id,
                    'ruta_imagen' => 'uploads/' . $nombreImagen,
                ]);
            }
        }
    }
     // Notificar a todos los admins
    $admins = \App\Models\User::where('role', 'admin')->get();
    foreach ($admins as $admin) {
        \App\Models\Notification::create([
            'user_id' => $admin->id,
            'titulo' => 'Nueva actividad cargada',
            'mensaje' => 'El becario "' . auth()->user()->becario->nombre . '" cargó la actividad ' . (
                trim($stat->actividad) === 'volin' ? 'Voluntariado Interno' :
                (trim($stat->actividad) === 'volex' ? 'Voluntariado Externo' :
                (trim($stat->actividad) === 'taller' ? 'Taller' :
                (trim($stat->actividad) === 'chat' ? 'Chat' : $stat->actividad)))
            ) . ': "' . $stat->titulo . '" (' . \Carbon\Carbon::parse($stat->fecha)->format('d/m/Y') . ').',
            'stat_id' => $stat->id,
        ]);
    }

    return redirect()->route('stats.index')->with('success', 'La actividad se ha registrado exitosamente');

        return redirect()->route('stats.index')->with('success', 'La actividad se ha registrado exitosamente');

    }


}
