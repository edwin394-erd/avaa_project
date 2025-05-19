<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagenes = $request->file('file') ?? $request->file('imagen');
        if (!$imagenes) {
            return response()->json(['error' => 'No se recibieron archivos'], 400);
        }

        $nombres = [];
        $manager = new ImageManager(Driver::class);

        if (is_array($imagenes)) {
            foreach ($imagenes as $imagen) {
                $nombreImagen = Str::uuid() . "." . $imagen->getClientOriginalExtension();
                $imagenServidor = $manager->read($imagen)->cover(1000, 1000);
                $imagenServidor->save(public_path('uploads') . '/' . $nombreImagen);
                $nombres[] = $nombreImagen;
            }
        } else {
            $nombreImagen = Str::uuid() . "." . $imagenes->getClientOriginalExtension();
            $imagenServidor = $manager->read($imagenes)->cover(1000, 1000);
            $imagenServidor->save(public_path('uploads') . '/' . $nombreImagen);
            $nombres[] = $nombreImagen;
        }

        return response()->json(['imagenes' => $nombres]);
    }
}