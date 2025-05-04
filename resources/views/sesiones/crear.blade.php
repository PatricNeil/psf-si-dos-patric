@extends('adminlte::page')

@section('title', 'Crear Sesión')

@section('content_header')
    <h1>Agendar Sesión para el {{ $fecha }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva Sesión</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('sesiones.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="fecha_sesion" value="{{ $fecha }}">
                        <div class="mb-3">
                            <label for="id_reserva" class="form-label">Reserva asociada</label>
                            <select class="form-control" name="id_reserva" required>
                                <option value="">Selecciona una reserva</option>
                                @foreach($reservas as $reserva)
                                    <option value="{{ $reserva->id_reserva }}">
                                        {{ $reserva->cliente->nombre ?? 'Sin nombre' }} {{ $reserva->cliente->apellido ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="hora_inicio" class="form-label">Hora de inicio</label>
                            <input type="time" class="form-control" name="hora_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora_fin" class="form-label">Hora de fin</label>
                            <input type="time" class="form-control" name="hora_fin" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion_tatuaje" class="form-label">Descripción del tatuaje</label>
                            <textarea class="form-control" name="descripcion_tatuaje" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="imagen_referencia" class="form-label">Imagen de referencia (opcional)</label>
                            <input type="file" class="form-control" name="imagen_referencia" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="costo" class="form-label">Costo</label>
                            <input type="number" class="form-control" name="costo" step="0.01" min="0" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Sesión</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
