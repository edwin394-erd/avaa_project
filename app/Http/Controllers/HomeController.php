<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use Illuminate\Http\Request;

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



 
            return view('dashboard')->with(['user'=>$user,
                                        'progreso_total'=>$progreso_total,
                                        'horas_totales'=>$horas_totales,
                                        'meta_total'=>$meta_total,
                                        'nombre_becario'=>$nombre_becario,
                                        'cedula_becario'=>$cedula_becario,
                                        'porcen_volin'=>$porcen_volin,
                                        'porcen_volex'=>$porcen_volex,
                                        'porcen_taller'=>$porcen_taller,
                                        'porcen_chat'=>$porcen_chat,
                                        'total_volin'=>$total_volin,
                                        'total_volex'=>$total_volex,
                                        'total_taller'=>$total_taller,
                                        'total_chat'=>$total_chat,
                                        'meta_volin'=>$meta_volin,
                                        'meta_volex'=>$meta_volex,
                                        'meta_chat'=>$meta_chat,
                                        'meta_taller'=>$meta_taller,
                                        'stats' => $stats,
                                    ]);
        } 
       

                                    
    }

    
}
