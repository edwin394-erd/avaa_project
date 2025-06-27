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
         $startOfYear = Carbon::now()->startOfYear();
            $endOfYear = Carbon::now()->endOfYear();
            $user = auth()->user();


            // Filtro base
            $query = Stat::with(['evidencias', 'becario.user']);

            // Filtro por usuario si no es admin
            if ($user->role !== 'admin') {
                $query->whereHas('becario', function($q) use ($user) {
                 $q->where('user_id', $user->id);
                });
            }

            // Filtro por búsqueda
            if ($request->filled('search')) {
                $search = $request->input('search');
                $query->where(function($q) use ($search, $user) {
                    $q->where('titulo', 'like', "%$search%")
                    ->orWhere('actividad', 'like', "%$search%")
                    ->orWhere('modalidad', 'like', "%$search%")
                    ->orWhere('duracion', 'like', "%$search%")
                    ->orWhere('estado', 'like', "%$search%");
                    // Si es admin, buscar también por nombre de becario
                    if ($user->role === 'admin') {
                        $q->orWhereHas('becario', function($q2) use ($search) {
                            $q2->where('nombre', 'like', "%$search%");
                        });
                    }
                });
            }

            if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
                $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
            }



        if ($user->role === 'admin') {

            $stats = $query->where('anulado', 'NO')->with(['becario.user', 'evidencias'])->orderBy('created_at', 'desc')->paginate(8);

            $meta_volin = \App\Models\Becario::whereHas('user', function($q) {
                $q->where('activo', 1);
            })->sum('meta_volin');
            $meta_volex = \App\Models\Becario::whereHas('user', function($q) {
                $q->where('activo', 1);
            })->sum('meta_volex');
            $meta_taller = \App\Models\Becario::whereHas('user', function($q) {
                $q->where('activo', 1);
            })->sum('meta_taller');
            $meta_chat = \App\Models\Becario::whereHas('user', function($q) {
                $q->where('activo', 1);
            })->sum('meta_chat');

            $stats_realizado_volin = Stat::where('actividad', 'volin')
                ->where('estado', 'aprobado')
                ->where('anulado', 'NO')
                ->whereHas('becario.user', function($q) {
                    $q->where('activo', 1);
                })
                ->get();

            $stats_realizado_volex = Stat::where('actividad', 'volex')
                ->where('estado', 'aprobado')
                ->where('anulado', 'NO')
                ->whereHas('becario.user', function($q) {
                    $q->where('activo', 1);
                })
                ->get();

            $stats_realizado_taller = Stat::where('actividad', 'taller')
                ->where('estado', 'aprobado')
                ->where('anulado', 'NO')
                ->whereHas('becario.user', function($q) {
                    $q->where('activo', 1);
                })
                ->get();

            $stats_realizado_chat = Stat::where('actividad', 'chat')
                ->where('estado', 'aprobado')
                ->where('anulado', 'NO')
                ->whereHas('becario.user', function($q) {
                    $q->where('activo', 1);
                })
                ->get();

            // VOLUNTARIADO INTERNO
            $stats_volin = Stat::where('actividad', 'volin')
                ->where('estado', 'aprobado')
                ->where('anulado', 'NO')
                ->where('fecha', '>=', $startOfYear)
                ->whereHas('becario.user', function($q) {
                    $q->where('activo', 1);
                })
                ->get();
            $total_volin = $stats_volin->sum('duracion');
            $porcen_volin = 0;

            // VOLUNTARIADO EXTERNO
            $stats_volex = Stat::where('actividad', 'volex')
                ->where('estado', 'aprobado')
                ->where('anulado', 'NO')
                ->where('fecha', '>=', $startOfYear)
                ->whereHas('becario.user', function($q) {
                    $q->where('activo', 1);
                })
                ->get();
            $total_volex = $stats_volex->sum('duracion');
            $porcen_volex = 0;

            // TALLER
            $stats_taller = Stat::where('actividad', 'taller')
                ->where('estado', 'aprobado')
                ->where('anulado', 'NO')
                ->where('fecha', '>=', $startOfYear)
                ->whereHas('becario.user', function($q) {
                    $q->where('activo', 1);
                })
                ->get();
            $total_taller = $stats_taller->sum('duracion');
            $porcen_taller = 0;

            // CHAT
            $stats_chat = Stat::where('actividad', 'chat')
                ->where('estado', 'aprobado')
                ->where('anulado', 'NO')
                ->where('fecha', '>=', $startOfYear)
                ->whereHas('becario.user', function($q) {
                    $q->where('activo', 1);
                })
                ->get();
            $total_chat = $stats_chat->sum('duracion');
            $porcen_chat = 0;

            return view('stats.index')->with([
            'user' => $user,
            'stats' => $stats,
            'meta_volin' => $meta_volin ?? 0,
            'meta_volex' => $meta_volex ?? 0,
            'meta_taller' => $meta_taller ?? 0,
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
            $stats = $query->with(['becario.user', 'evidencias'])->orderBy('created_at', 'desc')->paginate(8);

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

public function modalidadindex(String $modalidad, Request $request)
{
    $startOfYear = Carbon::now()->startOfYear();
    $endOfYear = Carbon::now()->endOfYear();
    $user = auth()->user();

    // Filtro base
    $query = Stat::with(['evidencias', 'becario.user'])
        ->where('actividad', $modalidad);



    // Filtro por usuario si no es admin
    if ($user->role !== 'admin') {
        $query->whereHas('becario', function($q) use ($user) {
        $q->where('user_id', $user->id);
        });
    }

    // Filtro por búsqueda
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search, $user) {
            $q->where('titulo', 'like', "%$search%")
              ->orWhere('actividad', 'like', "%$search%")
              ->orWhere('modalidad', 'like', "%$search%")
              ->orWhere('duracion', 'like', "%$search%")
              ->orWhere('estado', 'like', "%$search%");
            // Si es admin, buscar también por nombre de becario
            if ($user->role === 'admin') {
                $q->orWhereHas('becario', function($q2) use ($search) {
                    $q2->where('nombre', 'like', "%$search%");
                });
            }
        });
    }

    if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
        $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
    }

    // Paginación y orden
    $stats = $query->orderBy('created_at', 'desc')->paginate(8);

    // Estadísticas y metas
    if ($user->role === 'admin') {
        // Paginación y orden
        $stats = $query->where('anulado', 'NO')->orderBy('created_at', 'desc')->paginate(8);
        $meta_volin = \App\Models\Becario::whereHas('user', function($q) {
            $q->where('activo', 1);
        })->sum('meta_volin');
        $meta_volex = \App\Models\Becario::whereHas('user', function($q) {
            $q->where('activo', 1);
        })->sum('meta_volex');
        $meta_taller = \App\Models\Becario::whereHas('user', function($q) {
            $q->where('activo', 1);
        })->sum('meta_taller');
        $meta_chat = \App\Models\Becario::whereHas('user', function($q) {
            $q->where('activo', 1);
        })->sum('meta_chat');

        $stats_anual = Stat::where('anulado', 'NO')
            ->where('estado', 'aprobado')
            ->whereBetween('fecha', [$startOfYear, $endOfYear])
            ->whereHas('becario.user', function($q) {
            $q->where('activo', 1);
            })
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
            ->whereHas('becario.user', function($q) {
            $q->where('activo', 1);
            })
            ->get();

        // Totales y porcentajes por modalidad
        $total_volin = Stat::where('actividad', 'volin')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->whereHas('becario.user', function($q) {
            $q->where('activo', 1);
            })
            ->sum('duracion');

        $total_volex = Stat::where('actividad', 'volex')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->whereHas('becario.user', function($q) {
            $q->where('activo', 1);
            })
            ->sum('duracion');

        $total_taller = Stat::where('actividad', 'taller')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->whereHas('becario.user', function($q) {
            $q->where('activo', 1);
            })
            ->sum('duracion');

        $total_chat = Stat::where('actividad', 'chat')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->whereHas('becario.user', function($q) {
            $q->where('activo', 1);
            })
            ->sum('duracion');

        $porcen_volin = 0;
        $porcen_volex = 0;
        $porcen_taller = 0;
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
            'stats' => $stats,
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
        // Usuario normal
        $meta_volin = $user->becario->meta_volin;
        $meta_volex = $user->becario->meta_volex;
        $meta_taller = $user->becario->meta_taller;
        $meta_chat = $user->becario->meta_chat;

       $stats_anual = Stat::where('anulado', 'NO')
            ->where('estado', 'aprobado')
            ->whereBetween('fecha', [$startOfYear, $endOfYear])
            ->whereHas('becario', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->whereHas('becario.user', function($q) {
                $q->where('activo', 1);
            })
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
            ->whereHas('becario', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->whereHas('becario.user', function($q) {
                $q->where('activo', 1);
            })
            ->get();

        // Totales y porcentajes por modalidad
        $total_volin = Stat::where('actividad', 'volin')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->whereHas('becario', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->whereHas('becario.user', function($q) {
                $q->where('activo', 1);
            })
            ->sum('duracion');

        $total_volex = Stat::where('actividad', 'volex')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->whereHas('becario', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->whereHas('becario.user', function($q) {
            $q->where('activo', 1);
            })
            ->sum('duracion');

        $total_taller = Stat::where('actividad', 'taller')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->whereHas('becario', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->whereHas('becario.user', function($q) {
            $q->where('activo', 1);
            })
            ->sum('duracion');

        $total_chat = Stat::where('actividad', 'chat')
            ->where('estado', 'aprobado')
            ->where('anulado', 'NO')
            ->where('fecha', '>=', $startOfYear)
            ->whereHas('becario', function($q) use ($user) {
                 $q->where('user_id', $user->id);
            })
            ->whereHas('becario.user', function($q) {
            $q->where('activo', 1);
            })
            ->sum('duracion');

        $porcen_volin = ($meta_volin > 0) ? number_format(min(($total_volin / $meta_volin) * 100, 100), 2) : 0;
        $porcen_volex = ($meta_volex > 0) ? number_format(min(($total_volex / $meta_volex) * 100, 100), 2) : 0;
        $porcen_taller = ($meta_taller > 0) ? number_format(min(($total_taller / $meta_taller) * 100, 100), 2) : 0;
        $porcen_chat = ($meta_chat > 0) ? number_format(min(($total_chat / $meta_chat) * 100, 100), 2) : 0;

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
            'stats' => $stats,
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
                'user_id' => $stat->becario->user_id,
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
                'user_id' => $stat->becario->user_id,
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


        $becario = auth()->user()->becario;

        $stat = Stat::create([
            'titulo' => $request->titulo,
            'actividad' => $request->actividad,
            'modalidad' => $request->modalidad,
            'duracion' => $request->duracion,
            'observacion' => $request->motivo ?? null,
            'facilitador' => $request->facilitador ?? "No Aplica",
            'fecha' => $request->fecha,
            'becario_id' => $becario->id,
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

    public function update(Request $request, $id)
{
    $stat = Stat::findOrFail($id);

    $validated = $request->validate([
        'titulo' => 'required|string|max:255',
        'actividad' => 'required|string|max:50',
        'modalidad' => 'required|string|max:50',
        'duracion' => 'required|numeric|min:0',
        'facilitador' => 'nullable|string|max:255',
        'fecha' => 'required|date',
      
    ]);

    $stat->update($validated);

    return redirect()->back()->with('success', 'Actividad actualizada correctamente.');
}

   public function allStats()
    {
        $stats = Stat::with(['becario.user'])->orderBy('created_at', 'desc')->get();
        return response()->json($stats);
    }

    public function allStatsmodalidad(String $modalidad)
    {
        $stats = Stat::with(['becario.user'])
        ->orderBy('created_at', 'desc')
        ->where('actividad', $modalidad)
        ->get();
        return response()->json($stats);
    }

   public function irAStat(Request $request, $statId)
{
    $user = auth()->user();
    $perPage = 8; // Usa el mismo número que en tu index

    // Aplica los mismos filtros que en index
    $query = \App\Models\Stat::query();

    // Filtro por usuario (si no es admin)
    if ($user->role !== 'admin') {
        $query->whereHas('becario', function($q) use ($user) {
        $q->where('user_id', $user->id);
        });
    }

    // Filtro por búsqueda
    if ($request->filled('busqueda')) {
        $busqueda = $request->input('busqueda');
        $query->where(function ($q) use ($busqueda) {
            $q->where('titulo', 'like', "%$busqueda%")
              ->orWhere('descripcion', 'like', "%$busqueda%");
        });
    }

    // Filtro por fecha de inicio
    if ($request->filled('fecha_inicio')) {
        $query->whereDate('fecha', '>=', $request->input('fecha_inicio'));
    }

    // Filtro por fecha de fin
    if ($request->filled('fecha_fin')) {
        $query->whereDate('fecha', '<=', $request->input('fecha_fin'));
    }

    // Otros filtros que uses en index, agrégalos aquí...

    // Orden igual que en index
    $query->orderBy('created_at', 'desc');

    // Obtén todos los IDs filtrados y ordenados
    $allIds = $query->pluck('id')->toArray();


    // Busca la posición del stat
    $index = array_search((int)$statId, $allIds);



    if ($index === false) {
        return redirect()->route('stats.index');
    }

    $page = floor($index / $perPage) + 1;

    // Redirige a la página correcta con highlight y los mismos filtros
    $params = $request->only(['busqueda', 'fecha_inicio', 'fecha_fin']);
    $params['page'] = $page;
    $params['highlight'] = $statId;

    return redirect()->route('stats.index', $params);
}


}

