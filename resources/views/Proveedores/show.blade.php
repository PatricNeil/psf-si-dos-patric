@extends('adminlte::page')

@section('title', 'Detalles del Proveedor')

@section('content_header')
    <h1 class="font-weight-bold text-primary text-center">
        <i class="fas fa-truck mr-2"></i>Detalles del Proveedor
    </h1>
@stop

@section('content')
<div class="card shadow-lg border-0 rounded-lg">
    <div class="card-header bg-gradient-primary text-white text-center py-3">
        <h4 class="font-weight-bold mb-0">
            <i class="fas fa-info-circle mr-2"></i>Información del Proveedor
        </h4>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-4 font-weight-bold text-gray-700">
                <i class="fas fa-id-card mr-2"></i>ID:
            </div>
            <div class="col-md-8 text-gray-900">
                {{ $proveedor->id_proveedor }}
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4 font-weight-bold text-gray-700">
                <i class="fas fa-signature mr-2"></i>Nombre:
            </div>
            <div class="col-md-8 text-gray-900">
                {{ $proveedor->nombre }}
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4 font-weight-bold text-gray-700">
                <i class="fas fa-phone mr-2"></i>Teléfono:
            </div>
            <div class="col-md-8 text-gray-900">
                {{ $proveedor->telefono }}
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4 font-weight-bold text-gray-700">
                <i class="fas fa-envelope mr-2"></i>Correo Electrónico:
            </div>
            <div class="col-md-8 text-gray-900">
                {{ $proveedor->email }}
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4 font-weight-bold text-gray-700">
                <i class="fas fa-map-marker-alt mr-2"></i>Dirección:
            </div>
            <div class="col-md-8 text-gray-900">
                {{ $proveedor->direccion ?? 'Sin dirección' }}
            </div>
        </div>
    </div>
    <div class="card-footer bg-white text-right py-3">
        <a href="{{ route('Proveedores.index') }}" class="btn btn-secondary shadow px-4 py-2 rounded-pill mr-2">
            <i class="fas fa-arrow-left mr-2"></i>Volver
        </a>
        <a href="{{ route('Proveedores.edit', $proveedor) }}" class="btn btn-primary shadow px-4 py-2 rounded-pill">
            <i class="fas fa-edit mr-2"></i>Editar
        </a>
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
        
        .card-header {
            border-radius: 0.5rem 0.5rem 0 0;
        }
        
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
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
        
        .text-gray-700 {
            color: #4a5568;
        }
        
        .text-gray-900 {
            color: #1a202c;
        }
        
        .rounded-pill {
            border-radius: 50rem;
        }
        
        .row {
            padding: 0.75rem 0;
            border-bottom: 1px solid #edf2f7;
        }
        
        .row:last-child {
            border-bottom: none;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
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