<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use App\Models\Evidencia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }

    public function index(Request $request){
        $user=auth()->user();
        return view('stats.index')->with([
            'user' => $user,
            'stats' => Stat::with('evidencias')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function modalidadindex(String $modalidad){
        $startOfYear = Carbon::now()->startOfYear();  // Primer día del año (01-01)
        $endOfYear = Carbon::now()->endOfYear();  // Último día del año (31-12)
        $user = auth()->user();
        $meta_volin = $user->becario->meta_volin;
        $meta_volex = $user->becario->meta_volex;
        $meta_taller = $user->becario->meta_taller;
        $meta_chat = $user->becario->meta_chat;

         $stats_anual = Stat::where('user_id', $user->id)
            ->where('anulado', 'NO')
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

        $stats_realizado= Stat::where('user_id', $user->id)
            ->where('actividad', $modalidad)
            ->where('anulado', 'NO')
            ->get();

         //VOLUNTARIADO INTERNO
        $stats_volin = Stat::where('user_id', $user->id)
            ->where('actividad', 'volin')
            ->where('anulado', 'NO')
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
            ->where('fecha', '>=', $startOfYear)
            ->get();
        $total_chat = $stats_chat->sum('duracion'); //TOTAL HORAS
        $porcen_chat = ($total_chat / $meta_chat) * 100;
        $porcen_chat = number_format($porcen_chat, 2); //PORCENTAJE
        if ($porcen_chat > 100) {
            $porcen_chat = 100;
        }

         // Crear arrays vacíos con valores predeterminados de 0
        $total_volin_por_mes = array_fill(0, 11, 0);
        $total_volex_por_mes = array_fill(0, 11, 0);
        $total_taller_por_mes = array_fill(0, 11, 0);
        $total_chat_por_mes = array_fill(0, 11, 0);

        // Rellenar los arrays con los datos obtenidos en la consulta
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

        return redirect()->route('stats.index')->with('success', 'La actividad se ha registrado exitosamente');

    }


}
