@extends('adminlte::page')

@section('title', 'Registrar Venta')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-cash-register mr-2"></i>Registrar Venta
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        <form action="{{ route('Ventas.store') }}" method="POST">
            @csrf
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_cliente" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-user mr-1"></i>Cliente
                        </label>
                        <select name="id_cliente" id="id_cliente" 
                                class="form-control shadow-sm @error('id_cliente') is-invalid @enderror" required>
                            <option value="">Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}" {{ old('id_cliente') == $cliente->id_cliente ? 'selected' : '' }}>
                                    {{ $cliente->nombre }} {{ $cliente->apellido }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_cliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="metodo_pago" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-credit-card mr-1"></i>Método de Pago
                        </label>
                        <select name="metodo_pago" id="metodo_pago" 
                                class="form-control shadow-sm @error('metodo_pago') is-invalid @enderror" required>
                            <option value="efectivo" {{ old('metodo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                            <option value="tarjeta" {{ old('metodo_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                            <option value="transferencia" {{ old('metodo_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                            <option value="otro" {{ old('metodo_pago') == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('metodo_pago')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="fecha_venta" class="text-gray-700 font-weight-bold">
                    <i class="fas fa-calendar-day mr-1"></i>Fecha de Venta
                </label>
                <input type="date" name="fecha_venta" id="fecha_venta" 
                       class="form-control shadow-sm @error('fecha_venta') is-invalid @enderror" 
                       value="{{ old('fecha_venta', date('Y-m-d')) }}" required>
                @error('fecha_venta')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label class="text-gray-700 font-weight-bold">
                    <i class="fas fa-boxes mr-1"></i>Productos
                </label>
                <div class="table-responsive rounded-lg overflow-hidden shadow-sm">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="bg-gradient-primary text-white">
                            <tr>
                                <th class="text-center">Seleccionar</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" 
                                               name="productos[{{ $producto->id_producto }}][id_producto]" 
                                               value="{{ $producto->id_producto }}" 
                                               class="producto-checkbox" 
                                               data-stock="{{ $producto->stock }}"
                                               data-precio="{{ $producto->precio_unitario }}"
                                               {{ old('productos.'.$producto->id_producto.'.id_producto') ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        {{ $producto->nombre }}
                                        <small class="text-muted d-block">Stock: {{ $producto->stock }}</small>
                                    </td>
                                    <td>
                                        <input type="number" 
                                               name="productos[{{ $producto->id_producto }}][cantidad]" 
                                               class="form-control shadow-sm cantidad-input" 
                                               min="1" 
                                               max="{{ $producto->stock }}"
                                               value="{{ old('productos.'.$producto->id_producto.'.cantidad', 1) }}"
                                               disabled>
                                    </td>
                                    <td>
                                        <input type="text" 
                                               class="form-control shadow-sm precio-unitario" 
                                               value="{{ number_format($producto->precio_unitario, 2) }}" 
                                               readonly disabled>
                                    </td>
                                    <td>
                                        <input type="text" 
                                               class="form-control shadow-sm subtotal" 
                                               value="0.00" 
                                               readonly disabled>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-100">
                            <tr>
                                <td colspan="4" class="text-right font-weight-bold">Total:</td>
                                <td>
                                    <input type="text" 
                                           id="total-venta" 
                                           class="form-control shadow-sm font-weight-bold" 
                                           value="0.00" 
                                           readonly>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-5">
                <a href="{{ route('Ventas.index') }}" class="btn btn-secondary shadow px-4 py-2 rounded-pill">
                    <i class="fas fa-arrow-left mr-2"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary shadow px-4 py-2 rounded-pill">
                    <i class="fas fa-save mr-2"></i> Registrar Venta
                </button>
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
        }
        
        .form-control:focus, select.form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .table th {
            position: sticky;
            top: 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-weight: 500;
        }
        
        tr:hover {
            background-color: rgba(0, 0, 0, 0.02) !important;
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
        
        .rounded-pill {
            border-radius: 50rem;
        }
    </style>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Habilitar campos cuando se selecciona un producto
            const checkboxes = document.querySelectorAll('.producto-checkbox');
            
            checkboxes.forEach(checkbox => {
                const row = checkbox.closest('tr');
                const cantidadInput = row.querySelector('.cantidad-input');
                const precioInput = row.querySelector('.precio-unitario');
                const subtotalInput = row.querySelector('.subtotal');
                
                // Manejar cambios en los checkboxes
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        cantidadInput.disabled = false;
                        precioInput.disabled = false;
                        subtotalInput.disabled = false;
                        calcularSubtotal(row);
                    } else {
                        cantidadInput.disabled = true;
                        precioInput.disabled = true;
                        subtotalInput.disabled = true;
                        cantidadInput.value = 1;
                        subtotalInput.value = '0.00';
                        calcularTotal();
                    }
                });
                
                // Manejar cambios en la cantidad
                cantidadInput.addEventListener('input', function() {
                    const stock = parseInt(checkbox.dataset.stock);
                    if (parseInt(this.value) > stock) {
                        alert(`No hay suficiente stock. Disponible: ${stock}`);
                        this.value = stock;
                    }
                    calcularSubtotal(row);
                });
                
                // Inicializar checkboxes marcados anteriormente
                if (checkbox.checked) {
                    checkbox.dispatchEvent(new Event('change'));
                }
            });
            
            // Función para calcular subtotal por fila
            function calcularSubtotal(row) {
                const cantidad = parseFloat(row.querySelector('.cantidad-input').value) || 0;
                const precio = parseFloat(row.querySelector('.precio-unitario').value.replace(',', '')) || 0;
                const subtotal = cantidad * precio;
                row.querySelector('.subtotal').value = subtotal.toFixed(2);
                calcularTotal();
            }
            
            // Función para calcular el total general
            function calcularTotal() {
                let total = 0;
                document.querySelectorAll('.subtotal').forEach(input => {
                    if (!input.disabled) {
                        total += parseFloat(input.value) || 0;
                    }
                });
                document.getElementById('total-venta').value = total.toFixed(2);
            }
            
            // Establecer fecha actual si no hay valor
            if (!document.getElementById('fecha_venta').value) {
                document.getElementById('fecha_venta').valueAsDate = new Date();
            }
        });
    </script>
@stop