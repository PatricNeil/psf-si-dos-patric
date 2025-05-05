@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-truck mr-2"></i>Listado de Proveedores
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('Proveedores.create') }}" class="btn btn-primary shadow px-4 py-2 rounded-pill">
                <i class="fas fa-plus mr-2"></i>Agregar Proveedor
            </a>
            
            <form action="{{ route('Proveedores.index') }}" method="GET" class="ml-4 w-50">
                <div class="input-group input-group-lg shadow-sm">
                    <input type="text" name="search" 
                           class="form-control border-right-0 rounded-left"
                           placeholder="Buscar proveedor..." 
                           value="{{ request('search') }}"
                           aria-label="Buscar proveedores">
                    <div class="input-group-append">
                        <button class="btn btn-primary rounded-right" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                        <a href="{{ route('Proveedores.index') }}" class="btn btn-outline-secondary border-left-0">
                            <i class="fas fa-times"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive rounded-lg overflow-hidden shadow-sm">
            <table id="proveedores" class="table table-bordered table-hover mb-0">
                <thead class="bg-gradient-primary text-white">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($proveedores as $proveedor)
                        <tr class="transition-all hover:bg-gray-50">
                            <td class="text-center">{{ $proveedor->id_proveedor}}</td>
                            <td>{{ $proveedor->nombre }}</td>
                            <td>{{ $proveedor->telefono }}</td>
                            <td>{{ $proveedor->email }}</td>
                            <td class="text-center py-2">
                                <div class="btn-group btn-group-sm shadow" role="group">
                                    <a href="{{ route('Proveedores.show', $proveedor) }}" 
                                       class="btn btn-info rounded-left" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('Proveedores.edit', $proveedor) }}" 
                                       class="btn btn-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('Proveedores.destroy', $proveedor) }}" 
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-right" 
                                                title="Eliminar"
                                                onclick="return confirm('¿Eliminar este proveedor?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
        
        .btn-info {
            background: linear-gradient(135deg, #4299e1, #3182ce);
            border: none;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #ed8936, #dd6b20);
            border: none;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #f56565, #e53e3e);
            border: none;
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
        $(document).ready(function(){
            $('#proveedores').DataTable({
                "ordering": false,
                "language": {
                    "search": "Buscar",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente",
                        "first": "Primero",
                        "last": "Último"
                    }
                },
                "dom": '<"top"f>rt<"bottom"lip><"clear">',
                "initComplete": function() {
                    $('input[aria-controls="proveedores"]').addClass('form-control-sm');
                }
            });
            
            // Foco automático en el campo de búsqueda
            $('input[aria-controls="proveedores"]').focus();
        });
    </script>
@stop