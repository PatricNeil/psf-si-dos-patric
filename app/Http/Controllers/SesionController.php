<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sesion;
use Illuminate\Support\Facades\Storage;
use App\Models\Reserva;

class SesionController extends Controller
{
    public function calendario()
    {
        $sesiones = Sesion::with('reserva')->get();
        $eventos = $sesiones->map(function($sesion) {
            return [
                'title' => $sesion->reserva ? 'Reserva #' . $sesion->id_reserva : 'Sesión',
                'start' => $sesion->fecha_sesion . 'T' . $sesion->hora_inicio,
                'end' => $sesion->fecha_sesion . 'T' . $sesion->hora_fin,
                'extendedProps' => [
                    'descripcion' => $sesion->descripcion_tatuaje,
                    'hora_inicio' => $sesion->hora_inicio,
                    'hora_fin' => $sesion->hora_fin,
                    'costo' => $sesion->costo,
                ],
            ];
        });
        return view('sesiones.calendario', ['eventos' => $eventos]);
    }

    public function crear(Request $request)
    {
        $fecha = $request->query('fecha');
        $reservas = Reserva::where('estado', '!=', 'cancelada')->get();
        return view('sesiones.crear', compact('fecha', 'reservas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_sesion' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'descripcion_tatuaje' => 'required',
            'imagen_referencia' => 'nullable|image',
            'costo' => 'required|numeric|min:0',
            'id_reserva' => 'required|exists:reservas,id_reserva',
        ]);

        $sesion = new Sesion();
        $sesion->fecha_sesion = $validated['fecha_sesion'];
        $sesion->hora_inicio = $validated['hora_inicio'];
        $sesion->hora_fin = $validated['hora_fin'];
        $sesion->descripcion_tatuaje = $validated['descripcion_tatuaje'];
        $sesion->costo = $validated['costo'];
        $sesion->estado = 'en progreso';
        // Si hay imagen, guardarla
        if ($request->hasFile('imagen_referencia')) {
            $path = $request->file('imagen_referencia')->store('sesiones', 'public');
            $sesion->imagen_referencia = $path;
        }
        // Relacionar con reserva
        $sesion->id_reserva = $validated['id_reserva'];
        $sesion->save();

        return redirect()->route('sesiones.calendario')->with('success', 'Sesión agendada correctamente.');
    }
}
