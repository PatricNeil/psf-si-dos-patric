@extends('adminlte::page')

@section('title', 'Detalle de Ventas')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-receipt mr-2"></i>Detalle de Ventas
    </h1>
@stop

@section('content')
<div class="mb-3">
    <a href="{{ route('reporte.pdf') }}" class="btn btn-danger shadow px-4 py-2 rounded-pill d-flex align-items-center">
        <i class="fas fa-file-pdf mr-2"></i> Descargar PDF
    </a>
</div>
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        <div class="table-responsive rounded-lg overflow-hidden shadow-sm">
            <table class="table table-bordered table-hover mb-0">
                <thead class="bg-gradient-primary text-white">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Venta</th>
                        <th>Fecha de Venta</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th class="text-right">Precio Unitario</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($detalles as $detalle)
                        <tr>
                            <td class="text-center">{{ $detalle->id_detalle }}</td>
                            <td>{{ $detalle->venta->id_venta }}</td>
                            <td>{{ $detalle->venta->fecha_venta }}</td>
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td class="text-right">${{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td class="text-right">${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('#detalle-venta').DataTable({
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

<style>
    .btn-danger:hover {
        background-color: #c82333 !important;
        border-color: #bd2130 !important;
    }
</style>
