<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use App\Models\Activity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{


    public function __construct(){
        $this->middleware('auth');

    }
    public function index(){
        $startOfYear = Carbon::now()->startOfYear();  // Primer día del año (01-01)
        $endOfYear = Carbon::now()->endOfYear();  // Último día del año (31-12)

        $user = auth()->user();

        if ($user->role == 'admin') {
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
            $nombre_user= $user->personal->nombre;
            $cedula_becario= $user->personal->cedula;

            //VOLUNTARIADO INTERNO
            $stats_volin = Stat::where('actividad', 'volin')
                ->whereHas('user', function($q) {
                    $q->where('activo', 1);
                })
                ->where('anulado', 'NO')
                ->where('estado', 'aprobado')
                ->where('fecha', '>=', $startOfYear)
                ->get();
            $total_volin = $stats_volin->sum('duracion'); //TOTAL HORAS
            $porcen_volin = ($meta_volin > 0) ? ($total_volin / $meta_volin) * 100 : 0;
            $porcen_volin = number_format($porcen_volin, 2); //PORCENTAJE
            if ($porcen_volin > 100) {
                $porcen_volin = 100;
            }

            //VOLUNTARIADO EXTERNO
            $stats_volex = Stat::where('actividad', 'volex')
                ->whereHas('user', function($q) {
                    $q->where('activo', 1);
                })
                ->where('anulado', 'NO')
                ->where('estado', 'aprobado')
                ->where('fecha', '>=', $startOfYear)
                ->get();
            $total_volex = $stats_volex->sum('duracion'); //TOTAL HORAS
            $porcen_volex = ($meta_volex > 0) ? ($total_volex / $meta_volex) * 100 : 0;
            $porcen_volex = number_format($porcen_volex, 2); //PORCENTAJE
            if ($porcen_volex > 100) {
                $porcen_volex = 100;
            }

            //TALLER
            $stats_taller = Stat::where('actividad', 'taller')
                ->whereHas('user', function($q) {
                    $q->where('activo', 1);
                })
                ->where('anulado', 'NO')
                ->where('estado', 'aprobado')
                ->where('fecha', '>=', $startOfYear)
                ->get();
            $total_taller = $stats_taller->sum('duracion'); //TOTAL HORAS
            $porcen_taller = ($meta_taller > 0) ? ($total_taller / $meta_taller) * 100 : 0;
            $porcen_taller = number_format($porcen_taller, 2); //PORCENTAJE
            if ($porcen_taller > 100) {
                $porcen_taller = 100;
            }

            //CHAT
            $stats_chat = Stat::where('actividad', 'chat')
                ->whereHas('user', function($q) {
                    $q->where('activo', 1);
                })
                ->where('anulado', 'NO')
                ->where('estado', 'aprobado')
                ->where('fecha', '>=', $startOfYear)
                ->get();
            $total_chat = $stats_chat->sum('duracion'); //TOTAL HORAS
            $porcen_chat = ($meta_chat > 0) ? ($total_chat / $meta_chat) * 100 : 0;
            $porcen_chat = number_format($porcen_chat, 2); //PORCENTAJE
            if ($porcen_chat > 100) {
                $porcen_chat = 100;
            }

            //STATS
            $stats = Stat::whereHas('user', function($q) {
                    $q->where('activo', 1);
                })
                ->where('anulado', 'NO')
                ->where('estado', 'aprobado')
                ->orderBy('created_at')
                ->get();

            $stats_sinfiltro = Stat::whereHas('user', function($q) {
                $q->where('activo', 1);
            })
            ->where('anulado', 'NO')
            ->orderby('created_at','desc')
            ->get();

              //PROGRESO TOTAL
            $progreso_total = ($porcen_volin + $porcen_volex + $porcen_taller + $porcen_chat) / 4;
            $horas_totales = $total_volin + $total_volex + $total_taller + $total_chat;
            $meta_total = $meta_volin + $meta_volex + $meta_taller + $meta_chat;

              //PROGRESO POR MES
            //stats con campo fecha de enero a diciembre
            // Consulta optimizada para obtener los datos de los últimos 12 meses
            // Obtener el inicio y el fin del año actual



            $stats_anual = Stat::where('anulado', 'NO')
                ->where('anulado', 'NO')
                ->where('estado', 'aprobado')
                ->whereBetween('fecha', [$startOfYear, $endOfYear])
                ->whereHas('user', function($q) {
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

            return view('admin_dashboard')->with([
                'user' => $user,
                'progreso_total' => $progreso_total,
                'horas_totales' => $horas_totales,
                'meta_total' => $meta_total,
                'nombre_user' => $nombre_user,
                'cedula_becario' => $cedula_becario,
                'porcen_volin' => $porcen_volin,
                'porcen_volex' => $porcen_volex,
                'porcen_taller' => $porcen_taller,
                'porcen_chat' => $porcen_chat,
                'total_volin' => $total_volin,
                'total_volex' => $total_volex,
                'total_taller' => $total_taller,
                'total_chat' => $total_chat,
                'meta_volin' => $meta_volin,
                'meta_volex' => $meta_volex,
                'meta_chat' => $meta_chat,
                'meta_taller' => $meta_taller,
                'stats' => $stats,
                'stats_sinfiltro' => $stats_sinfiltro,
                'stats_anual' => $stats_anual,
                'total_por_mes' => $total_por_mes,
                'total_volin_por_mes' => $total_volin_por_mes,
                'total_volex_por_mes' => $total_volex_por_mes,
                'total_taller_por_mes' => $total_taller_por_mes,
                'total_chat_por_mes' => $total_chat_por_mes,
            ]);



        } else {
        $meta_volin= $user->becario->meta_volin;
        $meta_volex= $user->becario->meta_volex;
        $meta_taller= $user->becario->meta_taller;
        $meta_chat= $user->becario->meta_chat;
        $nombre_user= $user->becario->nombre;
        $cedula_becario= $user->becario->cedula;



        //VOLUNTARIADO INTERNO
        $stats_volin = Stat::where('user_id', $user->id)
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
        $stats_volex = Stat::where('user_id', $user->id)
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
        $stats_taller = Stat::where('user_id', $user->id)
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
        $stats_chat = Stat::where('user_id', $user->id)
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
        $stats = Stat::where('user_id', $user->id)
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

        $activities = Activity::where('status', 'pendiente')
        ->orderBy('fecha', 'asc')
        ->paginate(8);





            return view('dashboard')->with([
                'user' => $user,
                'activities' => $activities,
                'progreso_total' => $progreso_total,
                'horas_totales' => $horas_totales,
                'meta_total' => $meta_total,
                'nombre_user' => $nombre_user,
                'cedula_becario' => $cedula_becario,
                'porcen_volin' => $porcen_volin,
                'porcen_volex' => $porcen_volex,
                'porcen_taller' => $porcen_taller,
                'porcen_chat' => $porcen_chat,
                'total_volin' => $total_volin,
                'total_volex' => $total_volex,
                'total_taller' => $total_taller,
                'total_chat' => $total_chat,
                'meta_volin' => $meta_volin,
                'meta_volex' => $meta_volex,
                'meta_chat' => $meta_chat,
                'meta_taller' => $meta_taller,
                'stats' => $stats,
                'stats_anual' => $stats_anual,
                'total_por_mes' => $total_por_mes,
                'total_volin_por_mes' => $total_volin_por_mes,
                'total_volex_por_mes' => $total_volex_por_mes,
                'total_taller_por_mes' => $total_taller_por_mes,
                'total_chat_por_mes' => $total_chat_por_mes,
            ]);
        }



    }


}
