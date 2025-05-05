@extends('adminlte::page')

@section('title', 'Listado de Ventas')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-receipt mr-2"></i>Listado de Ventas
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('Ventas.create') }}" class="btn btn-primary shadow px-4 py-2 rounded-pill">
                <i class="fas fa-plus mr-2"></i>Nueva Venta
            </a>
        </div>

        <div class="table-responsive rounded-lg overflow-hidden shadow-sm">
            <table class="table table-bordered table-hover mb-0">
                <thead class="bg-gradient-primary text-white">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th class="text-right">Total</th>
                        <th>Método Pago</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($ventas as $venta)
                    <tr class="transition-all hover:bg-gray-50">
                        <td class="text-center">{{ $venta->id_venta }}</td>
                        <td>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y H:i') }}</td>
                        <td>{{ $venta->cliente->nombre ?? 'Cliente no disponible' }}</td>
                        <td class="text-right">${{ number_format($venta->total, 2) }}</td>
                        <td>
                            <span class="badge badge-pill py-2 px-3
                                @if($venta->metodo_pago == 'efectivo') bg-success
                                @elseif($venta->metodo_pago == 'tarjeta') bg-primary
                                @elseif($venta->metodo_pago == 'transferencia') bg-info
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($venta->metodo_pago) }}
                            </span>
                        </td>
                        <td class="text-center py-2">
                            <div class="btn-group btn-group-sm shadow" role="group">
                                <a href="{{ route('Ventas.edit', $venta->id_venta) }}" 
                                   class="btn btn-warning rounded-left" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('Ventas.destroy', $venta->id_venta) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-right" title="Eliminar"
                                            onclick="return confirm('¿Está seguro de eliminar esta venta?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fas fa-receipt fa-2x mb-2"></i><br>
                            No hay ventas registradas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($ventas->count() > 0)
                <tfoot class="bg-gray-100">
                    <tr>
                        <td colspan="3" class="text-right font-weight-bold text-gray-700">Total General:</td>
                        <td class="text-right font-weight-bold text-gray-900">${{ number_format($ventas->sum('total'), 2) }}</td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>

        <div class="card-footer bg-white d-flex justify-content-center py-3">
            {{ $ventas->links() }}
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
        
        .badge-pill {
            border-radius: 50rem;
        }
        
        .bg-success {
            background: linear-gradient(135deg, #48bb78, #38a169);
        }
        
        .bg-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        
        .bg-info {
            background: linear-gradient(135deg, #4299e1, #3182ce);
        }
        
        .bg-secondary {
            background: linear-gradient(135deg, #a0aec0, #718096);
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
        
        .alert {
            position: fixed;
            top: 60px;
            right: 20px;
            z-index: 1000;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: none;
        }
        
        tr:hover {
            background-color: rgba(0, 0, 0, 0.02) !important;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Cierre automático de alertas después de 5 segundos
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);

            // Efecto hover para botones
            $('.btn').hover(
                function() {
                    $(this).css('transform', 'translateY(-2px)');
                },
                function() {
                    $(this).css('transform', 'translateY(0)');
                }
            );
        });
    </script>
@stop