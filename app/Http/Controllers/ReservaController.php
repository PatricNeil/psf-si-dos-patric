<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReservaController extends Controller
{
    public function index()
    {
        $search = request('search');
            
        $reservas = Reserva::with(['cliente', 'artista'])
            ->when($search, function($query) use ($search) {
                return $query->whereHas('cliente', function($q) use ($search) {
                    $q->where('nombre', 'like', "%$search%")
                      ->orWhere('apellido', 'like', "%$search%");
                })
                ->orWhereHas('artista', function($q) use ($search) {
                    $q->where('nombre', 'like', "%$search%")
                      ->orWhere('apellido', 'like', "%$search%");
                })
                ->orWhere('estado', 'like', "%$search%");
            })
            ->orderBy('fecha_reserva', 'desc')
            ->orderBy('hora_reserva', 'desc')
            ->paginate(10);
        
        return view('Reservas.index', compact('reservas', 'search'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $artistas = Artista::where('estado', true)->get();
        return view('Reservas.create', compact('clientes', 'artistas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_artista' => 'required|exists:artistas,id_artista',
            'fecha_reserva' => 'required|date|after_or_equal:today',
            'hora_reserva' => 'required',
            'estado' => 'required|in:pendiente,confirmada,cancelada'
        ]);

        Reserva::create($request->all());
        return redirect()->route('Reservas.index')->with('success', 'La nueva reserva fue registrada correctamente');
    }
    
    public function edit($id_reserva)
    {
        $reserva = Reserva::findOrFail($id_reserva);
        $clientes = Cliente::all();
        $artistas = Artista::where('estado', true)->get();
        return view('Reservas.edit', compact('reserva', 'clientes', 'artistas'));
    }

    public function update(Request $request, $id_reserva)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_artista' => 'required|exists:artistas,id_artista',
            'fecha_reserva' => 'required|date',
            'hora_reserva' => 'required',
            'estado' => 'required|in:pendiente,confirmada,cancelada'
        ]);

        $reserva = Reserva::findOrFail($id_reserva);
        $reserva->update($request->all());

        return redirect()->route("Reservas.index")->with('success', 'La reserva fue modificada correctamente');
    }

    public function destroy($id_reserva)
    {
        try {
            $reserva = Reserva::findOrFail($id_reserva);
            $reserva->delete();

            return redirect()->route('Reservas.index')->with('success', 'La reserva fue eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->route('Reservas.index')->with('error', 'Error al eliminar la reserva: ' . $e->getMessage());
        }
    }

    public function createRapida()
    {
        $clientes = Cliente::all();
        $artistas = Artista::where('estado', true)->get();
        return view('Reservas.rapida', compact('clientes', 'artistas'));
    }
    
    public function storeRapida(Request $request)
    {
        // Iniciar transacción de base de datos
        DB::beginTransaction();
        
        try {
            // Verificar si es un cliente nuevo o existente
            $clienteId = $request->input('id_cliente');
            $esClienteNuevo = $request->input('es_cliente_nuevo');
            
            Log::info('Procesando reserva rápida con datos:', [
                'es_cliente_nuevo' => $esClienteNuevo,
                'cliente_id' => $clienteId,
                'id_artista' => $request->id_artista,
                'fecha_reserva' => $request->fecha_reserva,
                'hora_reserva' => $request->hora_reserva,
            ]);
            
            // Si es cliente nuevo, crearlo primero
            if ($esClienteNuevo == '1') {
                Log::info('Creando nuevo cliente con datos:', [
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'dni' => $request->dni,
                    'telefono' => $request->telefono,
                    'email' => $request->email,
                ]);
                
                // Validar campos obligatorios
                if (!$request->nombre || !$request->apellido || !$request->dni || !$request->telefono || !$request->email) {
                    return back()->withInput()->with('error', 'Todos los campos del cliente son obligatorios.');
                }
                
                // Validar email único de forma convencional (ya que no está encriptado)
                $emailExistente = Cliente::where('email', $request->email)->exists();
                if ($emailExistente) {
                    return back()->withInput()->with('error', 'Ya existe un cliente con este email.');
                }
                
                // Verificar DNI duplicado - tenemos que hacer esto manualmente debido a la encriptación
                $dniExistente = false;
                $clientes = Cliente::all();
                
                foreach ($clientes as $cliente) {
                    try {
                        // Comparamos el DNI desencriptado con el que viene en el request
                        if ($cliente->dni == $request->dni) {
                            $dniExistente = true;
                            break;
                        }
                    } catch (\Exception $e) {
                        Log::warning('Error al desencriptar DNI: ' . $e->getMessage());
                        // Si hay error al desencriptar, seguimos con el siguiente
                        continue;
                    }
                }
                
                if ($dniExistente) {
                    return back()->withInput()->with('error', 'Ya existe un cliente con este DNI.');
                }
                
                try {
                    // Crear el cliente con todos los campos requeridos
                    $cliente = new Cliente();
                    $cliente->nombre = $request->nombre;
                    $cliente->apellido = $request->apellido;
                    $cliente->dni = $request->dni; // El mutator lo encriptará
                    $cliente->email = $request->email;
                    $cliente->telefono = $request->telefono;
                    $cliente->direccion = $request->direccion ?? 'No especificada';
                    $cliente->fecha_registro = now()->toDateString();
                    $cliente->save();
                    
                    Log::info('Cliente creado exitosamente con ID: ' . $cliente->id_cliente);
                    $clienteId = $cliente->id_cliente;
                } catch (\Exception $e) {
                    Log::error('Error al guardar cliente: ' . $e->getMessage());
                    throw $e; // Re-lanzar para el manejo global de errores
                }
            } else {
                // Validar que exista el cliente seleccionado
                if (!$clienteId) {
                    return back()->withInput()->with('error', 'No se ha seleccionado un cliente válido.');
                }
                
                $cliente = Cliente::find($clienteId);
                if (!$cliente) {
                    return back()->withInput()->with('error', 'El cliente seleccionado no existe.');
                }
            }
            
            // Validar datos de la reserva
            if (!$request->id_artista || !$request->fecha_reserva || !$request->hora_reserva) {
                return back()->withInput()->with('error', 'Todos los campos de la reserva son obligatorios.');
            }
            
            // Crear la reserva
            $reserva = new Reserva();
            $reserva->id_cliente = $clienteId;
            $reserva->id_artista = $request->id_artista;
            $reserva->fecha_reserva = $request->fecha_reserva;
            $reserva->hora_reserva = $request->hora_reserva;
            $reserva->estado = $request->estado ?? 'pendiente';
            $reserva->save();
            
            Log::info('Reserva creada exitosamente con ID: ' . $reserva->id_reserva);
            
            // Confirmar la transacción
            DB::commit();
            
            return redirect()->route('Reservas.index')->with('success', 'Reserva creada exitosamente');
            
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            
            // Registrar el error detallado para diagnóstico
            Log::error('Error al crear reserva rápida: ' . $e->getMessage());
            Log::error('Traza: ' . $e->getTraceAsString());
            
            return back()->withInput()->with('error', 'Error al crear la reserva: ' . $e->getMessage());
        }
    }
}