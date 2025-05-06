<?php

namespace App\Http\Controllers;

use App\Models\Stat;
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
            'stats' => Stat::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5),
        ]);
    }

    public function create(){
        $user=auth()->user();
        return view('stats.create')->with('user', $user);
    }

    public function store(Request $request){
        $this->validate($request,[

            'titulo' => 'required|max:30',
            'actividad' => 'required|min:1',
            'modalidad' => 'required|min:1',
            'duracion' => 'required|numeric|max:120',
            'fecha' => 'required|date|before_or_equal:today',
        ]);


        Stat::create([
            'titulo' => $request->titulo,
            'actividad' => $request->actividad,
            'modalidad' => $request->modalidad,
            'duracion' => $request->duracion,
            'fecha' => $request->fecha,
            'user_id' => auth()->user()->id,
   
        ]);

        return redirect()->route('home')->with('msg_registroExitoso', 'Registro exitoso, ya puedes iniciar sesión');

    }

   
}
