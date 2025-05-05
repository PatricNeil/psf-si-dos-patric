@extends('adminlte::page')

@section('title', 'Crear Cliente')

@section('content_header')
    <h1 class="font-weight-bold text-primary">Crear Nuevo Cliente</h1>
@stop

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('Clientes.store') }}" method="POST">
            @csrf

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre" class="text-gray-700">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" 
                               class="form-control shadow-sm @error('nombre') is-invalid @enderror" 
                               value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellido" class="text-gray-700">Apellido:</label>
                        <input type="text" name="apellido" id="apellido" 
                               class="form-control shadow-sm @error('apellido') is-invalid @enderror" 
                               value="{{ old('apellido') }}" required>
                        @error('apellido')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dni" class="text-gray-700">DNI:</label>
                        <input type="text" name="dni" id="dni" 
                               class="form-control shadow-sm @error('dni') is-invalid @enderror" 
                               value="{{ old('dni') }}" required>
                        @error('dni')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="text-gray-700">Email:</label>
                        <input type="email" name="email" id="email" 
                               class="form-control shadow-sm @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono" class="text-gray-700">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" 
                               class="form-control shadow-sm @error('telefono') is-invalid @enderror" 
                               value="{{ old('telefono') }}">
                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_registro" class="text-gray-700">Fecha de Registro:</label>
                        <input type="date" name="fecha_registro" id="fecha_registro" 
                               class="form-control shadow-sm @error('fecha_registro') is-invalid @enderror" 
                               value="{{ old('fecha_registro', date('Y-m-d')) }}" required>
                        @error('fecha_registro')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label for="direccion" class="text-gray-700">Dirección:</label>
                <textarea name="direccion" id="direccion" 
                          class="form-control shadow-sm @error('direccion') is-invalid @enderror" 
                          rows="3">{{ old('direccion') }}</textarea>
                @error('direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-flex justify-content-between mt-5">
                <a href="{{ route('Clientes.index') }}" class="btn btn-secondary shadow px-4 py-2">
                    <i class="fas fa-arrow-left mr-2"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary shadow px-4 py-2">
                    <i class="fas fa-save mr-2"></i> Guardar Cliente
                </button>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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
        
        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .btn {
            font-weight: 500;
            border-radius: 0.375rem;
            transition: all 0.2s;
            border: none;
        }
        
        .btn:hover {
            transform: translateY(-1px);
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
        }
        
        .shadow-sm {
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#telefono').inputmask('(999) 999-9999');
            
            // Focus first field automatically
            $('form').find('input, textarea, select').first().focus();
        });
    </script>
@stop