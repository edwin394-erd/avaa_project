<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
       

    public function __construct(){
        $this->middleware('auth');
        
    }
    public function index(){

        $user = auth()->user();
 
        if ($user->role == 'admin') {
            return view('admin_dashboard');
            
        } else {
        $meta_volin= $user->becario->meta_volin;
        $meta_volex= $user->becario->meta_volex;
        $meta_taller= $user->becario->meta_taller;
        $meta_chat= $user->becario->meta_chat;
        $nombre_becario= $user->becario->nombre;
        $cedula_becario= $user->becario->cedula;

     

        //VOLUNTARIADO INTERNO
        $stats_volin = Stat::where('user_id', $user->id)->where('actividad', 'volin')->get();
        $total_volin = $stats_volin->sum('duracion');//TOTAL HORAS
        $porcen_volin = ($total_volin/$meta_volin)*100;
        $porcen_volin = number_format($porcen_volin, 2);//PORCENTAJE
        if($porcen_volin>100){
            $porcen_volin=100;
        }

        //VOLUNTARIADO EXTERNO
        $stats_volex = Stat::where('user_id', $user->id)->where('actividad', 'volex')->get();
        $total_volex = $stats_volex->sum('duracion');//TOTAL HORAS
        $porcen_volex = ($total_volex/$meta_volex)*100;
        $porcen_volex = number_format($porcen_volex, 2);//PORCENTAJE
        if($porcen_volex>100){
            $porcen_volex=100;
        }
        

        //TALLER
        $stats_taller = Stat::where('user_id', $user->id)->where('actividad', 'taller')->get();
        $total_taller = $stats_taller->sum('duracion');//TOTAL HORAS
        $porcen_taller = ($total_taller/$meta_taller)*100;
        $porcen_taller = number_format($porcen_taller, 2);//PORCENTAJE
        if($porcen_taller>100){
            $porcen_taller=100;
        }

        //CHAT
        $stats_chat = Stat::where('user_id', $user->id)->where('actividad', 'chat')->get();
        $total_chat = $stats_chat->sum('duracion');//TOTAL HORAS
        $porcen_chat = ($total_chat/$meta_chat)*100;
        $porcen_chat = number_format($porcen_chat, 2);//PORCENTAJE
        if($porcen_chat>100){
            $porcen_chat=100;
        }

        //STATS
        $stats= Stat::where('user_id', $user->id)->get();

        //PROGRESO TOTAL
        $progreso_total = ($porcen_volin + $porcen_volex + $porcen_taller + $porcen_chat) / 4;
        $horas_totales = $total_volin + $total_volex + $total_taller + $total_chat;
        $meta_total = $meta_volin + $meta_volex + $meta_taller + $meta_chat;

        //PROGRESO POR MES
        //stats con campo fecha de enero a diciembre
       // Consulta optimizada para obtener los datos de los últimos 12 meses
       // Obtener el inicio y el fin del año actual
        $startOfYear = Carbon::now()->startOfYear();  // Primer día del año (01-01)
        $endOfYear = Carbon::now()->endOfYear();  // Último día del año (31-12)

       
        $stats_anual = Stat::where('user_id', $user->id)
            ->whereBetween('fecha', [$startOfYear, $endOfYear])
            ->selectRaw('
                MONTH(fecha) as month, 
                SUM(duracion) as total_duracion,
                SUM(CASE WHEN actividad = "volin" THEN duracion ELSE 0 END) as total_volin_duracion,
                SUM(CASE WHEN actividad = "volexs" THEN duracion ELSE 0 END) as total_volex_duracion,
                SUM(CASE WHEN actividad = "taller" THEN duracion ELSE 0 END) as total_taller_duracion,
                SUM(CASE WHEN actividad = "chat" THEN duracion ELSE 0 END) as total_chat_duracion
            ')
            ->groupBy('month')
            ->get()
            ->keyBy('month'); // Agrupa por mes para acceso rápido

        // Crear arrays vacíos con valores predeterminados de 0
        $total_por_mes = array_fill(1, 12, 0);
        $total_volin_por_mes = array_fill(1, 12, 0);
        $total_volex_por_mes = array_fill(1, 12, 0);
        $total_taller_por_mes = array_fill(1, 12, 0);
        $total_chat_por_mes = array_fill(1, 12, 0);

        // Rellenar los arrays con los datos obtenidos en la consulta
        foreach ($stats_anual as $mes => $datos) {
            $total_por_mes[$mes] = $datos->total_duracion ?? 0;
            $total_volin_por_mes[$mes] = $datos->total_volin_duracion ?? 0;
            $total_volex_por_mes[$mes] = $datos->total_volex_duracion ?? 0;
            $total_taller_por_mes[$mes] = $datos->total_taller_duracion ?? 0;
            $total_chat_por_mes[$mes] = $datos->total_chat_duracion ?? 0;
        }
 
            return view('dashboard')->with([
                'user' => $user,
                'progreso_total' => $progreso_total,
                'horas_totales' => $horas_totales,
                'meta_total' => $meta_total,
                'nombre_becario' => $nombre_becario,
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
                'total_por_mes' => $total_por_mes // Ya contiene todos los meses
            ]);
        } 
       

                                    
    }

    
}