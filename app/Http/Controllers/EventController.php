<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Becario;
use Illuminate\Support\Facades\Auth;
use App\Models\event_asistence;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request){
    $user = auth()->user();

    $query = Event::query();

    $query->where(function($q) {
        $q->where('status', '!=', 'finalizado')
          ->orWhereNull('status');
    });

    // Actualizar eventos pendientes cuya fecha y hora ya pasaron
    Event::where('status', 'pendiente')
        ->whereRaw("CONCAT(fecha, ' ', hora_inicio) < ?", [now()])
        ->update(['status' => 'completada']);

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

    //asistencias
    $asistencias= event_asistence::all();

    $activities = $query->orderBy('created_at', 'desc')->get();

    return view('activities.index')->with('activities', $activities)
                                   ->with('user', $user)
                                   ->with('asistencias', $asistencias);
    }

     public function index2(Request $request){
    $user = auth()->user();

    $query = Event::query();

    $query->where(function($q) {
        $q->where('status', '!=', 'finalizado')
          ->orWhereNull('status');
    });

    // Actualizar eventos pendientes cuya fecha y hora ya pasaron
    Event::where('status', 'pendiente')
        ->whereRaw("CONCAT(fecha, ' ', hora_inicio) < ?", [now()])
        ->update(['status' => 'completada']);

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

    return view('activities.index-old')->with('activities', $activities)
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
            'flyer' => 'nullable', // Validación para el flyer
        ]);

        // Manejo del archivo flyer
        if ($request->hasFile('flyer')) {
            $file = $request->file('flyer');
            $path = $file->store('flyers', 'public');
            $validated['flyer'] = $path;
        }

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

        return back()->with('success', 'Evento cancelado correctamente.');
    }

    public function restaurar($id)
    {
        $actividad = \App\Models\Event::findOrFail($id);
        $actividad->status = 'pendiente';
        $actividad->save();

        return back()->with('success', 'Evento restaurado correctamente.');
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

        public function asistencia($eventId, $becarioId)
        {
        
            $event = Event::findOrFail($eventId);
            $becario = Becario::findOrFail($becarioId);

            

            // Verificar si el becario ya está registrado para este evento
            $asistenciaExistente = event_asistence::where('event_id', $eventId)
                ->where('becario_id', $becarioId)
                ->first();

            if ($asistenciaExistente) {
                return back()->with('error', 'El becario ya está registrado para este evento.');
            }

            // Registrar la asistencia
            event_asistence::create([
                'event_id' => $eventId,
                'becario_id' => $becarioId,
            ]);

            return back()->with('success', 'Asistencia registrada correctamente.');
        }

    public function asistenciaCancelar($eventId, $becarioId)
    {
        $event = Event::findOrFail($eventId);
        $becario = Becario::findOrFail($becarioId);

        // Verificar si el becario está registrado para este evento
        $asistenciaExistente = event_asistence::where('event_id', $eventId)
            ->where('becario_id', $becarioId)
            ->first();

        if (!$asistenciaExistente) {
            return back()->with('error', 'El becario no está registrado para este evento.');
        }

        // Cancelar la asistencia
        $asistenciaExistente->delete();

        return back()->with('success', 'Asistencia cancelada correctamente.');
    }

}
