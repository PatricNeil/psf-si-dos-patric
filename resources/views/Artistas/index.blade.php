@extends('adminlte::page')

@section('title', 'Artistas')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-paint-brush mr-2"></i>Artistas
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <a href="{{ route('Artistas.create') }}" class="btn btn-primary shadow px-4 py-2 rounded-pill">
                <i class="fas fa-plus-circle mr-2"></i>Agregar Artista
            </a>

            <form action="{{ route('Artistas.index') }}" method="GET" class="w-50 ml-4">
                <div class="input-group input-group-lg shadow-sm">
                    <input type="text" name="search" 
                           class="form-control border-right-0 rounded-left"
                           placeholder="Buscar por nombre, especialidad o email..." 
                           value="{{ request('search') }}"
                           aria-label="Buscar artistas">
                    <div class="input-group-append">
                        <button class="btn btn-primary rounded-right" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                        <a href="{{ route('Artistas.index') }}" class="btn btn-outline-secondary border-left-0">
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
                        <th>Especialidad</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($artistas as $artista)
                        <tr class="transition-all hover:bg-gray-50">
                            <td class="text-center">{{ $artista->id_artista }}</td>
                            <td>{{ $artista->nombre }}</td>
                            <td>{{ $artista->apellido }}</td>
                            <td>{{ $artista->especialidad }}</td>
                            <td>{{ $artista->email }}</td>
                            <td>{{ $artista->telefono }}</td>
                            <td>
                                @if($artista->estado)
                                    <span class="badge badge-pill badge-success py-2 px-3">Activo</span>
                                @else
                                    <span class="badge badge-pill badge-danger py-2 px-3">Inactivo</span>
                                @endif
                            </td>
                            <td class="text-center py-2">
                                <div class="btn-group btn-group-sm shadow" role="group">
                                    <a href="{{ route('Artistas.edit', $artista->id_artista) }}" 
                                       class="btn btn-dark rounded-left" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('Artistas.destroy', $artista->id_artista) }}" 
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-right" 
                                                title="Eliminar"
                                                onclick="return confirm('¿Eliminar este artista?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                @if(request('search'))
                                    <i class="fas fa-search-minus fa-2x mb-2"></i><br>
                                    No se encontraron artistas con ese criterio de búsqueda
                                @else
                                    <i class="fas fa-users-slash fa-2x mb-2"></i><br>
                                    No hay artistas registrados aún
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($artistas, 'links'))
        <div class="card-footer bg-white d-flex justify-content-center py-3">
            {{ $artistas->appends(request()->query())->links() }}
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
        
        .badge {
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .empty-state {
            padding: 3rem 0;
        }
        
        .pagination {
            margin: 0;
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
            
            // Efecto hover para filas
            $('tr').hover(
                function() {
                    $(this).css('transform', 'translateY(-1px)');
                    $(this).css('box-shadow', '0 4px 6px -1px rgba(0, 0, 0, 0.1)');
                },
                function() {
                    $(this).css('transform', 'translateY(0)');
                    $(this).css('box-shadow', 'none');
                }
            );
        });
    </script>
@stop