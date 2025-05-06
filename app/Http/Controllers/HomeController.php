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

        $meta_volin= $user->meta_volin;
        $meta_volex= $user->meta_volex;
        $meta_taller= $user->meta_taller;
        $meta_chat= $user->meta_chat;

        //VOLUNTARIADO INTERNO
        $stats_volin = Stat::where('user_id', $user->id)->where('actividad', 'volin')->get();
        $total_volin = $stats_volin->sum('duracion');//TOTAL HORAS
        $porcen_volin = ($total_volin/$user->meta_volin)*100;
        $porcen_volin = number_format($porcen_volin, 2);//PORCENTAJE
        if($porcen_volin>100){
            $porcen_volin=100;
        }

        //VOLUNTARIADO EXTERNO
        $stats_volex = Stat::where('user_id', $user->id)->where('actividad', 'volex')->get();
        $total_volex = $stats_volex->sum('duracion');//TOTAL HORAS
        $porcen_volex = ($total_volex/$user->meta_volex)*100;
        $porcen_volex = number_format($porcen_volex, 2);//PORCENTAJE
        if($porcen_volex>100){
            $porcen_volex=100;
        }
        

        //TALLER
        $stats_taller = Stat::where('user_id', $user->id)->where('actividad', 'taller')->get();
        $total_taller = $stats_taller->sum('duracion');//TOTAL HORAS
        $porcen_taller = ($total_taller/$user->meta_taller)*100;
        $porcen_taller = number_format($porcen_taller, 2);//PORCENTAJE
        if($porcen_taller>100){
            $porcen_taller=100;
        }

        //CHAT
        $stats_chat = Stat::where('user_id', $user->id)->where('actividad', 'chat')->get();
        $total_chat = $stats_chat->sum('duracion');//TOTAL HORAS
        $porcen_chat = ($total_chat/$user->meta_chat)*100;
        $porcen_chat = number_format($porcen_chat, 2);//PORCENTAJE
        if($porcen_chat>100){
            $porcen_chat=100;
        }

        //STATS
        $stats= Stat::where('user_id', $user->id)->get();

 
 
        
        return view('dashboard')->with(['user'=>$user,
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
