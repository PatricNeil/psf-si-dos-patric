@extends('adminlte::page')

@section('title', 'Editar Artista')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-paint-brush mr-2"></i>Editar Artista
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        <form action="{{ route('Artistas.update', $artista->id_artista) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-user mr-1"></i>Nombre:
                        </label>
                        <input type="text" name="nombre" id="nombre" 
                               class="form-control shadow-sm @error('nombre') is-invalid @enderror" 
                               value="{{ old('nombre', $artista->nombre) }}" required>
                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellido" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-user mr-1"></i>Apellido:
                        </label>
                        <input type="text" name="apellido" id="apellido" 
                               class="form-control shadow-sm @error('apellido') is-invalid @enderror" 
                               value="{{ old('apellido', $artista->apellido) }}" required>
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
                        <label for="especialidad" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-star mr-1"></i>Especialidad:
                        </label>
                        <input type="text" name="especialidad" id="especialidad" 
                               class="form-control shadow-sm @error('especialidad') is-invalid @enderror" 
                               value="{{ old('especialidad', $artista->especialidad) }}" required>
                        @error('especialidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-envelope mr-1"></i>Email:
                        </label>
                        <input type="email" name="email" id="email" 
                               class="form-control shadow-sm @error('email') is-invalid @enderror" 
                               value="{{ old('email', $artista->email) }}" required>
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
                        <label for="telefono" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-phone mr-1"></i>Teléfono:
                        </label>
                        <input type="text" name="telefono" id="telefono" 
                               class="form-control shadow-sm @error('telefono') is-invalid @enderror" 
                               value="{{ old('telefono', $artista->telefono) }}">
                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-toggle-on mr-1"></i>Estado:
                        </label>
                        <select name="estado" id="estado" 
                                class="form-control shadow-sm @error('estado') is-invalid @enderror" required>
                            <option value="1" {{ old('estado', $artista->estado) == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('estado', $artista->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6 mb-2">
                    <a href="{{ route('Artistas.index') }}" class="btn btn-secondary btn-block py-3 shadow rounded-pill">
                        <i class="fas fa-arrow-left mr-2"></i> Cancelar y Volver
                    </a>
                </div>
                <div class="col-md-6 mb-2">
                    <button type="submit" class="btn btn-primary btn-block py-3 shadow rounded-pill">
                        <i class="fas fa-save mr-2"></i> Actualizar Artista
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
            background-color: #ffffff;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .form-group label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #4a5568;
        }
        
        .form-control, .form-select {
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        .form-control:focus, .form-select:focus {
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
        
        select.form-control {
            height: calc(2.875rem + 2px);
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
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