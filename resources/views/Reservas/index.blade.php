@extends('adminlte::page')

@section('title', 'Reservas')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-calendar-check mr-2"></i>Reservas
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('Reservas.create') }}" class="btn btn-primary shadow px-4 py-2 rounded-pill">
                <i class="fas fa-plus-circle mr-2"></i>Nueva Reserva
            </a>

            <form action="{{ route('Reservas.index') }}" method="GET" class="ml-4 w-50">
                <div class="input-group input-group-lg shadow-sm">
                    <input type="text" name="search" 
                           class="form-control border-right-0 rounded-left"
                           placeholder="Buscar por cliente, artista o estado..." 
                           value="{{ request('search') }}"
                           aria-label="Buscar reservas">
                    <div class="input-group-append">
                        <button class="btn btn-primary rounded-right" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                        <a href="{{ route('Reservas.index') }}" class="btn btn-outline-secondary border-left-0">
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
                        <th>Cliente</th>
                        <th>Artista</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($reservas as $reserva)
                        <tr class="transition-all hover:bg-gray-50">
                            <td class="text-center">{{ $reserva->id_reserva }}</td>
                            <td>{{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellido }}</td>
                            <td>{{ $reserva->artista->nombre }} {{ $reserva->artista->apellido }}</td>
                            <td>{{ $reserva->fecha_reserva->format('d/m/Y') }}</td>
                            <td>{{ date('H:i', strtotime($reserva->hora_reserva)) }}</td>
                            <td>
                                @if($reserva->estado == 'confirmada')
                                    <span class="badge badge-pill badge-success py-2 px-3">Confirmada</span>
                                @elseif($reserva->estado == 'cancelada')
                                    <span class="badge badge-pill badge-danger py-2 px-3">Cancelada</span>
                                @else
                                    <span class="badge badge-pill badge-warning py-2 px-3">Pendiente</span>
                                @endif
                            </td>
                            <td class="text-center py-2">
                                <div class="btn-group btn-group-sm shadow" role="group">
                                    <a href="{{ route('Reservas.edit', $reserva->id_reserva) }}" 
                                       class="btn btn-dark rounded-left" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('Reservas.destroy', $reserva->id_reserva) }}" 
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-right" 
                                                title="Eliminar"
                                                onclick="return confirm('¿Eliminar esta reserva?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                @if(request('search'))
                                    <i class="fas fa-search-minus fa-2x mb-2"></i><br>
                                    No se encontraron reservas con ese criterio
                                @else
                                    <i class="fas fa-calendar-times fa-2x mb-2"></i><br>
                                    No hay reservas registradas aún
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($reservas, 'links'))
        <div class="card-footer bg-white d-flex justify-content-center py-3">
            {{ $reservas->appends(request()->query())->links() }}
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
        
        .badge-success {
            background: linear-gradient(135deg, #48bb78, #38a169);
        }
        
        .badge-warning {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
        }
        
        .badge-danger {
            background: linear-gradient(135deg, #f56565, #e53e3e);
        }
        
        .badge-pill {
            border-radius: 50rem;
        }
        
        .rounded-pill {
            border-radius: 50rem;
        }
        
        .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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

            // Inicializar datepicker si es necesario
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                language: 'es'
            });
        });
    </script>
@stop