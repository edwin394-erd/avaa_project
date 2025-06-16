<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request){
    $user = auth()->user();

    $query = Event::query();

    // Filtro por búsqueda
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('actividad', 'like', "%$search%")
              ->orWhere('location', 'like', "%$search%")
              ->orWhere('status', 'like', "%$search%")
              ->orWhere('facilitador', 'like', "%$search%");
        });
    }

    $activities = $query->orderBy('created_at', 'desc')->paginate(8);

    return view('activities.index')->with('activities', $activities)
                                   ->with('user', $user);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'facilitador' => 'max:255',
            'duration' => 'required|numeric|min:0',
            'location' => 'required|max:255',
            'actividad' => 'required|in:volin,volex,chat,taller',
            'hora_inicio' => 'required',
            'fecha' => 'required|date',
            'quorum_minimo' => 'nullable|integer|min:0',
            'quorum_maximo' => 'nullable|integer|min:0',
        ]);

        // status por defecto
        $validated['status'] = 'pendiente';

        Event::create($validated);

        return redirect()->route('activities.index')->with('success', 'Evento creado correctamente.');
    }

    public function cancelar($id)
    {
        $actividad = \App\Models\Event::findOrFail($id);
        $actividad->status = 'cancelada';
        $actividad->save();

        return redirect()->route('activities.index')->with('success', 'Evento cancelado correctamente.');
    }

    public function restaurar($id)
    {
        $actividad = \App\Models\Event::findOrFail($id);
        $actividad->status = 'pendiente';
        $actividad->save();

        return redirect()->route('activities.index')->with('success', 'Evento restaurado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'facilitador' => 'max:255',
            'duration' => 'required|numeric|min:0',
            'location' => 'required|max:255',
            'actividad' => 'required|in:volin,volex,chat,taller',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'quorum_minimo' => 'nullable|integer|min:0',
            'quorum_maximo' => 'nullable|integer|min:0',
        ], [], [], function($validator) use ($request, $id) {
            if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }
        });

        $actividad = \App\Models\Event::findOrFail($id);
        $actividad->update($validated);

        return redirect()->route('activities.index')->with('success', 'Evento actualizado correctamente.');
    }

       public function allEvents()
        {
            $activities = Event::orderBy('created_at', 'desc')->get();
            return response()->json($activities);
        }

}
