@extends('adminlte::page')

@section('title', 'Editar Reserva')

@section('content_header')
    <h1 class="font-weight-bold text-primary">
        <i class="fas fa-calendar-edit mr-2"></i>Editar Reserva
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-body">
        <form action="{{ route('Reservas.update', $reserva->id_reserva) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_cliente" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-user mr-1"></i>Cliente:
                        </label>
                        <select name="id_cliente" id="id_cliente" 
                                class="form-control shadow-sm @error('id_cliente') is-invalid @enderror" required>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}" 
                                    {{ old('id_cliente', $reserva->id_cliente) == $cliente->id_cliente ? 'selected' : '' }}>
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
                        <label for="id_artista" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-paint-brush mr-1"></i>Artista:
                        </label>
                        <select name="id_artista" id="id_artista" 
                                class="form-control shadow-sm @error('id_artista') is-invalid @enderror" required>
                            @foreach($artistas as $artista)
                                <option value="{{ $artista->id_artista }}" 
                                    {{ old('id_artista', $reserva->id_artista) == $artista->id_artista ? 'selected' : '' }}>
                                    {{ $artista->nombre }} {{ $artista->apellido }} ({{ $artista->especialidad }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_artista')
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
                        <label for="fecha_reserva" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-calendar-day mr-1"></i>Fecha:
                        </label>
                        <input type="date" name="fecha_reserva" id="fecha_reserva" 
                               class="form-control shadow-sm @error('fecha_reserva') is-invalid @enderror" 
                               value="{{ old('fecha_reserva', $reserva->fecha_reserva->format('Y-m-d')) }}" 
                               min="{{ date('Y-m-d') }}" required>
                        @error('fecha_reserva')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hora_reserva" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-clock mr-1"></i>Hora:
                        </label>
                        <input type="time" name="hora_reserva" id="hora_reserva" 
                               class="form-control shadow-sm @error('hora_reserva') is-invalid @enderror" 
                               value="{{ old('hora_reserva', date('H:i', strtotime($reserva->hora_reserva))) }}" required>
                        @error('hora_reserva')
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
                        <label for="estado" class="text-gray-700 font-weight-bold">
                            <i class="fas fa-info-circle mr-1"></i>Estado:
                        </label>
                        <select name="estado" id="estado" 
                                class="form-control shadow-sm @error('estado') is-invalid @enderror" required>
                            <option value="pendiente" {{ old('estado', $reserva->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="confirmada" {{ old('estado', $reserva->estado) == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                            <option value="cancelada" {{ old('estado', $reserva->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
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
                    <a href="{{ route('Reservas.index') }}" class="btn btn-secondary btn-block py-3 shadow rounded-pill">
                        <i class="fas fa-arrow-left mr-2"></i> Cancelar y Volver
                    </a>
                </div>
                <div class="col-md-6 mb-2">
                    <button type="submit" class="btn btn-primary btn-block py-3 shadow rounded-pill">
                        <i class="fas fa-save mr-2"></i> Actualizar Reserva
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
        
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
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
            // Enfocar el primer campo al cargar
            $('#id_cliente').focus();
            
            // Inicializar datepicker si es necesario
            $('#fecha_reserva').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                startDate: new Date(),
                language: 'es'
            });
            
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