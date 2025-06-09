<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
     public function index(){
            $user = auth()->user();
            $activities = Activity::paginate(8);

            return view('activities.index')->with('activities', $activities)
                                           ->with('user', $user);

    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'max:255',
            'duration' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'actividad' => 'required|in:volin,volex,chat,taller',
            'hora_inicio' => 'required',
            'fecha' => 'required|date',
            'quorum_minimo' => 'nullable|integer|min:0',
            'quorum_maximo' => 'nullable|integer|min:0',
        ]);

        // status por defecto
        $validated['status'] = 'pendiente';

        Activity::create($validated);

        return redirect()->route('activities.index')->with('success', 'Evento creado correctamente.');
    }
}
