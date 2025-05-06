@extends('adminlte::page')

@section('title', 'Editar Producto')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-edit mr-2"></i>Editar Producto
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        <form action="{{ route('Productos.update', $producto->id_producto) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria" class="form-control" required>
                    <option value="tintas" {{ $producto->categoria == 'tintas' ? 'selected' : '' }}>Tintas</option>
                    <option value="agujas" {{ $producto->categoria == 'agujas' ? 'selected' : '' }}>Agujas</option>
                    <option value="aftercare" {{ $producto->categoria == 'aftercare' ? 'selected' : '' }}>Aftercare</option>
                    <option value="otros" {{ $producto->categoria == 'otros' ? 'selected' : '' }}>Otros</option>
                </select>
            </div>
            <div class="form-group">
                <label for="precio_unitario">Precio Unitario:</label>
                <input type="number" id="precio_unitario" name="precio_unitario" class="form-control" step="0.01" value="{{ $producto->precio_unitario }}" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" class="form-control" value="{{ $producto->stock }}" required>
            </div>
            <div class="text-right">
                <a href="{{ route('Productos.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
@stop
