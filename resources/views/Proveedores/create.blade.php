@extends('adminlte::page')

@section('title', 'Agregar Proveedor')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-truck mr-2"></i>Agregar datos del proveedor
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        <form action="{{ route('Proveedores.store') }}" method="POST">
            @csrf
            
            <div class="form-row mb-4">
                <div class="form-group col-md-8">
                    <label for="nombre" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-signature mr-1"></i>Nombre del proveedor:
                    </label>
                    <input type="text" id="nombre" name="nombre" 
                           class="form-control shadow-sm @error('nombre') is-invalid @enderror" 
                           value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-row mb-4">
                <div class="form-group col-md-6">
                    <label for="telefono" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-phone mr-1"></i>Teléfono:
                    </label>
                    <input type="text" id="telefono" name="telefono" 
                           class="form-control shadow-sm @error('telefono') is-invalid @enderror" 
                           value="{{ old('telefono') }}" required>
                    @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group col-md-6">
                    <label for="email" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-envelope mr-1"></i>Correo electrónico:
                    </label>
                    <input type="email" id="email" name="email" 
                           class="form-control shadow-sm @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-row mb-4">
                <div class="form-group col-md-12">
                    <label for="direccion" class="text-gray-700 font-weight-bold">
                        <i class="fas fa-map-marker-alt mr-1"></i>Dirección:
                    </label>
                    <textarea id="direccion" name="direccion" 
                              class="form-control shadow-sm @error('direccion') is-invalid @enderror" 
                              rows="3">{{ old('direccion') }}</textarea>
                    @error('direccion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-row mt-5">
                <div class="col-md-12 text-right">
                    <a href="{{ route('Proveedores.index') }}" class="btn btn-secondary shadow px-4 py-2 rounded-pill mr-2">
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
        
        .form-control, textarea.form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        .form-control:focus, textarea.form-control:focus {
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
        
        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 0.25rem;
            color: #e53e3e;
        }
        
        .rounded-pill {
            border-radius: 50rem;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Máscara para el teléfono
            $('#telefono').inputmask('(999) 999-9999');
            
            // Enfocar el primer campo al cargar
            $('#nombre').focus();
            
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