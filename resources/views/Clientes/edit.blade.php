@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1 class="font-weight-bold text-primary">Editar Cliente</h1>
@stop

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('Clientes.update', $cliente->id_cliente) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre" class="text-gray-700">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" 
                               class="form-control shadow-sm @error('nombre') is-invalid @enderror" 
                               value="{{ old('nombre', $cliente->nombre) }}" required>
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
                               value="{{ old('apellido', $cliente->apellido) }}" required>
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
                               value="{{ old('dni', $cliente->dni) }}" required>
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
                               value="{{ old('email', $cliente->email) }}" required>
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
                               value="{{ old('telefono', $cliente->telefono) }}">
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
                               value="{{ old('fecha_registro', $cliente->fecha_registro) }}">
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
                          rows="3">{{ old('direccion', $cliente->direccion) }}</textarea>
                @error('direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="row mt-5">
                <div class="col-md-6 mb-2">
                    <a href="{{ route('Clientes.index') }}" class="btn btn-secondary btn-block py-3 shadow">
                        <i class="fas fa-arrow-left mr-2"></i> Cancelar y Volver
                    </a>
                </div>
                <div class="col-md-6 mb-2">
                    <button type="submit" class="btn btn-primary btn-block py-3 shadow">
                        <i class="fas fa-save mr-2"></i> Actualizar Cliente
                    </button>
                </div>
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
        }
        
        .btn:hover {
            transform: translateY(-1px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #a0aec0, #718096);
            border: none;
        }
        
        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#telefono').inputmask('(999) 999-9999');
            
            // Foco automático en el primer campo
            $('form').find('input, textarea, select').first().focus();
        });
    </script>
@stop