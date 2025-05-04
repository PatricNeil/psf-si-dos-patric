<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
        // Mostrar todos los clientes
    public function index()
    {
        $search = request('search');
            
        $clientes = Cliente::when($search, function($query) use ($search) {
            return $query->where('nombre', 'like', "%$search%")
                        ->orWhere('apellido', 'like', "%$search%")
                        ->orWhere('dni', 'like', "%$search%");
        })->paginate(10); // <- Esto devuelve un objeto paginable
        
        return view('Clientes.index', compact('clientes', 'search'));
    }

    public function create()
    {
        return view('Clientes.create');
    }
    public function  store(Request $request)
    {
        Cliente::create ($request->all());
        return redirect()->route('Clientes.index')->with('success', 'El nuevo cliente fue registrado correctamente');
    }
  
    public function edit ($id_cliente)
    {
        $cliente = Cliente::find($id_cliente);
        return view('Clientes.edit', compact('cliente'));
    }
    public function update(Request $request, $id_cliente)
    {
        $cliente  = Cliente::find($id_cliente);
        $cliente->update($request->all());

        return redirect()->route("Clientes.index")->with('success', 'el cliente fue modificado correctamente ');
    }
    public function destroy($id_cliente)
    {
        try {
            $cliente = Cliente::findOrFail($id_cliente);
            $cliente->delete();

            return redirect()->route('Clientes.index')->with('success', 'El Cliente fue eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('Clientes.index')->with('error', 'Error al eliminar el cliente: ' . $e->getMessage());
        }
    }

    public function verificarCliente(Request $request)
    {
        // Si la petición incluye un DNI específico
        if ($request->has('dni')) {
            $dni = $request->input('dni');
            
            // Obtenemos todos los clientes (no podemos buscar directamente por DNI encriptado)
            $clientes = Cliente::all();
            
            // Buscamos manualmente el cliente con el DNI correspondiente
            $cliente = null;
            foreach ($clientes as $c) {
                if ($c->dni == $dni) {
                    $cliente = $c;
                    break;
                }
            }
            
            if ($cliente) {
                return response()->json([
                    'exists' => true,
                    'cliente' => $cliente
                ]);
            } else {
                return response()->json([
                    'exists' => false
                ]);
            }
        }
        
        // Para búsqueda general (nombre, apellido, etc.)
        $search = $request->input('search');
        
        if (!$search || strlen($search) < 2) {
            return response()->json([]);
        }
        
        // Obtenemos todos los clientes para búsqueda
        $todosClientes = Cliente::all();
        $resultados = [];
        
        // Filtramos manualmente
        foreach ($todosClientes as $cliente) {
            if (
                stripos($cliente->nombre, $search) !== false || 
                stripos($cliente->apellido, $search) !== false || 
                stripos($cliente->dni, $search) !== false
            ) {
                $resultados[] = $cliente;
                
                // Limitamos a 10 resultados para no saturar la respuesta
                if (count($resultados) >= 10) {
                    break;
                }
            }
        }
        
        return response()->json($resultados);
    }
}
