@extends('adminlte::page')

@section('title', 'Listado de Productos')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-box mr-2"></i>Listado de Productos
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('Productos.create') }}" class="btn btn-primary shadow px-4 py-2 rounded-pill">
                <i class="fas fa-plus mr-2"></i>Nuevo Producto
            </a>
        </div>
        <div class="table-responsive rounded-lg overflow-hidden shadow-sm">
            <table class="table table-bordered table-hover mb-0">
                <thead class="bg-gradient-primary text-white">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th class="text-right">Precio Unitario</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($productos as $producto)
                        <tr>
                            <td class="text-center">{{ $producto->id_producto }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ ucfirst($producto->categoria) }}</td>
                            <td class="text-right">${{ number_format($producto->precio_unitario, 2) }}</td>
                            <td class="text-center">{{ $producto->stock }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm shadow" role="group">
                                    <a href="{{ route('Productos.edit', $producto->id_producto) }}" 
                                       class="btn btn-warning rounded-left" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('Productos.destroy', $producto->id_producto) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-right" title="Eliminar"
                                                onclick="return confirm('¿Está seguro de eliminar este producto?')">
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

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function(){
            $('.table').DataTable({
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
                }
            });
        });
    </script>
@endsection
