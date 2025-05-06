@extends('adminlte::page')

@section('title', 'Listado de Compras')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-shopping-cart mr-2"></i>Listado de Compras
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('Compras.create') }}" class="btn btn-primary shadow px-4 py-2 rounded-pill">
                <i class="fas fa-plus mr-2"></i>Nueva Compra
            </a>
        </div>
        <div class="table-responsive rounded-lg overflow-hidden shadow-sm">
            <table class="table table-bordered table-hover mb-0">
                <thead class="bg-gradient-primary text-white">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th class="text-right">Total</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($compras as $compra)
                        <tr>
                            <td class="text-center">{{ $compra->id_compra }}</td>
                            <td>{{ $compra->fecha_compra }}</td>
                            <td>{{ $compra->proveedor->nombre }}</td>
                            <td class="text-right">${{ number_format($compra->total, 2) }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm shadow" role="group">
                                    <a href="{{ route('Compras.edit', $compra->id_compra) }}" 
                                       class="btn btn-warning rounded-left" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('Compras.destroy', $compra->id_compra) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-right" title="Eliminar"
                                                onclick="return confirm('¿Está seguro de eliminar esta compra?')">
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
