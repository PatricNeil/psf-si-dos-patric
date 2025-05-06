@extends('adminlte::page')

@section('title', 'Registrar Compra')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-shopping-cart mr-2"></i>Registrar Producto
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        <form action="{{ route('Compras.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="producto_existente" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-box mr-1"></i>Producto existente:
                    </label>
                    <select id="producto_existente" name="producto_existente" class="form-control shadow-sm">
                        <option value="" disabled selected>Seleccione un producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id_producto }}"
                                data-nombre="{{ $producto->nombre }}"
                                data-precio="{{ $producto->precio_unitario }}"
                                data-descripcion="{{ $producto->descripcion }}"
                                data-categoria="{{ $producto->categoria }}">
                                {{ $producto->nombre }}
                            </option>
                        @endforeach
                        <option value="otro">Otro</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="nombre" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-tag mr-1"></i>Nombre del producto:
                    </label>
                    <input type="text" id="nombre" name="nombre" class="form-control shadow-sm" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="precio_unitario" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-dollar-sign mr-1"></i>Precio Unitario:
                    </label>
                    <input type="number" id="precio_unitario" name="precio_unitario" class="form-control shadow-sm" step="0.1" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="stock" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-boxes mr-1"></i>Stock:
                    </label>
                    <input type="number" id="stock" name="stock" class="form-control shadow-sm" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="descripcion" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-info-circle mr-1"></i>Descripción:
                    </label>
                    <textarea id="descripcion" name="descripcion" class="form-control shadow-sm" rows="3"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="categoria" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-tags mr-1"></i>Categoría:
                    </label>
                    <select id="categoria" name="categoria" class="form-control shadow-sm">
                        <option value="tintas">Tintas</option>
                        <option value="agujas">Agujas</option>
                        <option value="aftercare">Aftercare</option>
                        <option value="otros" selected>Otros</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="id_proveedor" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-truck mr-1"></i>Proveedor:
                    </label>
                    <select id="id_proveedor" name="id_proveedor" class="form-control shadow-sm" required>
                        <option value="" disabled selected>Seleccione un proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="fecha_compra" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-calendar-day mr-1"></i>Fecha de la compra:
                    </label>
                    <input type="date" id="fecha_compra" name="fecha_compra" class="form-control shadow-sm" readonly required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="total" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-calculator mr-1"></i>Total:
                    </label>
                    <input type="number" id="total" name="total" class="form-control shadow-sm" step="0.01" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 text-right">
                    <a href="{{ route('Compras.index') }}" class="btn btn-secondary shadow px-4 py-2 rounded-pill">
                        <i class="fas fa-arrow-left mr-2"></i>Volver
                    </a>
                    <button type="submit" class="btn btn-primary shadow px-4 py-2 rounded-pill">
                        <i class="fas fa-save mr-2"></i>Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
    <style>
        .card {
            border: none;
            border-radius: 0.5rem;
            background-color: #ffffff;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .form-group label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #4a5568;
        }
        
        .form-control, select.form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            height: auto;
        }
        
        .form-control:focus, select.form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .btn {
            font-weight: 500;
            border-radius: 50rem;
            transition: all 0.2s ease;
            border: none;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #a0aec0, #718096);
        }
    </style>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productoSelect = document.getElementById('producto_existente');
            const nombreInput = document.getElementById('nombre');
            const precioUnitarioInput = document.getElementById('precio_unitario');
            const descripcionInput = document.getElementById('descripcion');
            const categoriaSelect = document.getElementById('categoria');
            const stockInput = document.getElementById('stock');
            const totalInput = document.getElementById('total');
            const fechaCompraInput = document.getElementById('fecha_compra');

            // Función para calcular el total
            function calcularTotal() {
                const precioUnitario = parseFloat(precioUnitarioInput.value) || 0;
                const stock = parseInt(stockInput.value) || 0;
                totalInput.value = (precioUnitario * stock).toFixed(2);
            }

            // Escuchar cambios en los campos de precio unitario y stock
            precioUnitarioInput.addEventListener('input', calcularTotal);
            stockInput.addEventListener('input', calcularTotal);

            // Establecer la fecha actual en el campo de fecha
            const hoy = new Date().toISOString().split('T')[0];
            fechaCompraInput.value = hoy;

            // Manejar el cambio en el select de productos existentes
            productoSelect.addEventListener('change', function () {
                const selectedOption = productoSelect.options[productoSelect.selectedIndex];
                if (selectedOption.value === 'otro') {
                    // Limpiar los campos para un nuevo producto
                    nombreInput.value = '';
                    precioUnitarioInput.value = '';
                    descripcionInput.value = '';
                    categoriaSelect.value = 'otros';
                    nombreInput.readOnly = false;
                    precioUnitarioInput.readOnly = false;
                    descripcionInput.readOnly = false;
                    categoriaSelect.disabled = false;
                } else {
                    // Rellenar los campos con los datos del producto seleccionado
                    nombreInput.value = selectedOption.dataset.nombre;
                    precioUnitarioInput.value = selectedOption.dataset.precio;
                    descripcionInput.value = selectedOption.dataset.descripcion;
                    categoriaSelect.value = selectedOption.dataset.categoria;
                    nombreInput.readOnly = true;
                    precioUnitarioInput.readOnly = true;
                    descripcionInput.readOnly = true;
                    categoriaSelect.disabled = true;
                }
                calcularTotal();
            });
        });
    </script>
@stop
