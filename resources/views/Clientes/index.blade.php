@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1 class="font-weight-bold text-primary">Clientes</h1>
@stop

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('Clientes.create') }}" class="btn btn-primary btn-lg shadow">
                <i class="fas fa-plus-circle mr-2"></i>Agregar Cliente
            </a>

            <form action="{{ route('Clientes.index') }}" method="GET" class="w-50 ml-3">
                <div class="input-group input-group-lg shadow-sm">
                    <input type="text" name="search" 
                           class="form-control border-right-0 rounded-left"
                           placeholder="Buscar por nombre, DNI o email..." 
                           value="{{ request('search') }}"
                           aria-label="Buscar clientes">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                        <a href="{{ route('Clientes.index') }}" class="btn btn-outline-secondary border-left-0">
                            <i class="fas fa-times"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive rounded-lg overflow-hidden shadow-sm">
            <table class="table table-bordered table-hover mb-0">
                <thead class="bg-gradient-primary text-white">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Fecha Registro</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($clientes as $cliente)
                        <tr class="transition-all hover:bg-gray-50">
                            <td class="text-center">{{ $cliente->id_cliente }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->apellido }}</td>
                            <td>{{ $cliente->dni }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ Str::limit($cliente->direccion, 20) }}</td>
                            <td>{{ date('d/m/Y', strtotime($cliente->fecha_registro)) }}</td>
                            <td class="text-center py-2">
                                <div class="btn-group btn-group-sm shadow" role="group">
                                    <a href="{{ route('Clientes.edit', $cliente->id_cliente) }}" 
                                       class="btn btn-dark rounded-left" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('Clientes.destroy', $cliente->id_cliente) }}" 
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-right" 
                                                title="Eliminar"
                                                onclick="return confirm('¿Eliminar este cliente?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                @if(request('search'))
                                    <i class="fas fa-search-minus fa-2x mb-2"></i><br>
                                    No se encontraron clientes con ese criterio de búsqueda
                                @else
                                    <i class="fas fa-users-slash fa-2x mb-2"></i><br>
                                    No hay clientes registrados aún
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($clientes, 'links'))
        <div class="card-footer bg-white d-flex justify-content-center py-3">
            {{ $clientes->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@stop

@section('css')
    <style>
        .card {
            border: none;
            border-radius: 0.5rem;
        }
        
        .table th {
            position: sticky;
            top: 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .table td {
            vertical-align: middle;
            padding: 0.75rem;
        }
        
        .btn-group-sm > .btn {
            padding: 0.35rem 0.65rem;
            border-radius: 0;
        }
        
        .btn-group-sm > .btn:first-child {
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }
        
        .btn-group-sm > .btn:last-child {
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }
        
        .input-group-append .btn {
            border-radius: 0 .25rem .25rem 0;
            border-left: none;
        }
        
        tr:hover {
            background-color: rgba(0, 0, 0, 0.02) !important;
        }
        
        .empty-state {
            padding: 3rem 0;
        }
        
        .pagination {
            margin: 0;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Foco automático en el campo de búsqueda
            $('input[name="search"]').focus();
            
            // Limpiar búsqueda al hacer clic en la X
            $('.btn-outline-secondary').click(function() {
                $('input[name="search"]').val('').focus();
            });
        });
    </script>
@stop