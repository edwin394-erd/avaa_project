<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvidenciaController extends Controller
{
    public function store(Request $request)
    {
        dd("si hay");
        // Valida que existan imágenes y stats_id
        $request->validate([
            'imagen' => 'required',
            'stats_id' => 'required|exists:stats,id',
        ]);

        // Decodifica el array de nombres de imágenes
        $imagenes = json_decode($request->imagen, true);
        

        if (is_array($imagenes)) {
            foreach ($imagenes as $nombreImagen) {
                Evidencia::create([
                    'stats_id' => $request->stats_id,
                    'ruta_imagen' => $nombreImagen,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Evidencias guardadas correctamente');
    }
      

}
