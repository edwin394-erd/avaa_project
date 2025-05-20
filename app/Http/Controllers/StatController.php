<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use App\Models\Evidencia;
use Illuminate\Http\Request;

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
    public function anular(Stat $stat)
    {
        $stat->anulado = 'SI';
        $stat->save();
        return back()->with('success', 'Actividad anulada');
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

        return redirect()->route('home')->with('msg_registroExitoso', 'Registro exitoso, ya puedes iniciar sesión');

    }


}
