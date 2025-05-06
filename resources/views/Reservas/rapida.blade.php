@extends('adminlte::page')

@section('title', 'Reserva Rápida')

@section('content_header')
    <h1>Reserva Rápida</h1>
    <p class="text-muted">Crea una reserva y verifica o registra un cliente en el mismo proceso</p>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('Reservas.storeRapida') }}" method="POST" id="reservaRapidaForm">
            @csrf
            <!-- Mensaje de éxito o error -->
            <!-- Navegación por pestañas -->
            <ul class="nav nav-tabs" id="reservaTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="cliente-tab" data-toggle="tab" href="#cliente" role="tab" aria-controls="cliente" aria-selected="true">
                        <i class="fas fa-user mr-2"></i>Cliente
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="reserva-tab" data-toggle="tab" href="#reserva" role="tab" aria-controls="reserva" aria-selected="false">
                        <i class="fas fa-calendar-alt mr-2"></i>Reserva
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="confirmar-tab" data-toggle="tab" href="#confirmar" role="tab" aria-controls="confirmar" aria-selected="false">
                        <i class="fas fa-check-circle mr-2"></i>Confirmar
                    </a>
                </li>
            </ul>
            
            <!-- Contenido de las pestañas -->
            <div class="tab-content p-3 border border-top-0 rounded-bottom" id="reservaTabContent">
                <!-- Pestaña Cliente -->
                <div class="tab-pane fade show active" id="cliente" role="tabpanel" aria-labelledby="cliente-tab">
                    <div class="form-row mb-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cliente_search">Buscar Cliente (nombre, apellido o DNI):</label>
                                <div class="input-group">
                                    <input type="text" id="cliente_search" class="form-control" placeholder="Buscar cliente...">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="btnNuevoCliente">
                                            <i class="fas fa-plus mr-1"></i> Nuevo Cliente
                                        </button>
                                    </div>
                                </div>
                                <div id="clienteResults" class="list-group mt-2 shadow-sm d-none"></div>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" id="id_cliente" name="id_cliente">
                    <input type="hidden" id="es_cliente_nuevo" name="es_cliente_nuevo" value="0">
                    
                    <div id="clienteSeleccionado" class="row border p-3 rounded bg-light mb-4 d-none">
                        <div class="col-12">
                            <h5 class="border-bottom pb-2 mb-3">Cliente Seleccionado</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nombre:</strong> <span id="display_nombre"></span></p>
                                    <p><strong>Teléfono:</strong> <span id="display_telefono"></span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>DNI:</strong> <span id="display_dni"></span></p>
                                    <p><strong>Email:</strong> <span id="display_email"></span></p>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="btnCambiarCliente">
                                <i class="fas fa-exchange-alt mr-1"></i>Cambiar Cliente
                            </button>
                        </div>
                    </div>
                    
                    <div id="formNuevoCliente" class="d-none">
                        <div class="alert alert-info mb-4">
                            <i class="fas fa-info-circle mr-2"></i> Por favor, complete los datos del nuevo cliente.
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" name="nombre" id="nombre" 
                                          class="form-control @error('nombre') is-invalid @enderror" 
                                          value="{{ old('nombre') }}">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellido">Apellido:</label>
                                    <input type="text" name="apellido" id="apellido" 
                                          class="form-control @error('apellido') is-invalid @enderror" 
                                          value="{{ old('apellido') }}">
                                    @error('apellido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dni">DNI:</label>
                                    <input type="text" name="dni" id="dni" 
                                          class="form-control @error('dni') is-invalid @enderror" 
                                          value="{{ old('dni') }}">
                                    @error('dni')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="text" name="telefono" id="telefono" 
                                          class="form-control @error('telefono') is-invalid @enderror" 
                                          value="{{ old('telefono') }}">
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email" 
                                          class="form-control @error('email') is-invalid @enderror" 
                                          value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" name="direccion" id="direccion" 
                                  class="form-control @error('direccion') is-invalid @enderror" 
                                  value="{{ old('direccion') }}">
                            @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>
                        <button type="button" class="btn btn-primary btn-siguiente" data-next="reserva-tab">
                            <i class="fas fa-arrow-right mr-2"></i> Siguiente
                        </button>
                    </div>
                </div>
                
                <!-- Pestaña Reserva -->
                <div class="tab-pane fade" id="reserva" role="tabpanel" aria-labelledby="reserva-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_artista">Artista:</label>
                                <select name="id_artista" id="id_artista" 
                                        class="form-control @error('id_artista') is-invalid @enderror" required>
                                    <option value="">Seleccione un artista</option>
                                    @foreach($artistas as $artista)
                                        <option value="{{ $artista->id_artista }}" {{ old('id_artista') == $artista->id_artista ? 'selected' : '' }}>
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_reserva">Fecha:</label>
                                <input type="date" name="fecha_reserva" id="fecha_reserva" 
                                      class="form-control @error('fecha_reserva') is-invalid @enderror" 
                                      value="{{ old('fecha_reserva') }}" 
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
                                <label for="hora_reserva">Hora:</label>
                                <input type="time" name="hora_reserva" id="hora_reserva" 
                                      class="form-control @error('hora_reserva') is-invalid @enderror" 
                                      value="{{ old('hora_reserva') }}" required>
                                @error('hora_reserva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                            <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="confirmada" {{ old('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                            <option value="cancelada" {{ old('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                        @error('estado')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary btn-anterior" data-prev="cliente-tab">
                            <i class="fas fa-arrow-left mr-2"></i> Anterior
                        </button>
                        <button type="button" class="btn btn-primary btn-siguiente" data-next="confirmar-tab">
                            <i class="fas fa-arrow-right mr-2"></i> Siguiente
                        </button>
                    </div>
                </div>
                
                <!-- Pestaña Confirmar -->
                <div class="tab-pane fade" id="confirmar" role="tabpanel" aria-labelledby="confirmar-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Resumen de la Reserva</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Datos del Cliente</h6>
                                            <p><strong>Nombre:</strong> <span id="resumen_nombre"></span></p>
                                            <p><strong>DNI:</strong> <span id="resumen_dni"></span></p>
                                            <p><strong>Teléfono:</strong> <span id="resumen_telefono"></span></p>
                                            <p><strong>Email:</strong> <span id="resumen_email"></span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Datos de la Reserva</h6>
                                            <p><strong>Artista:</strong> <span id="resumen_artista"></span></p>
                                            <p><strong>Fecha:</strong> <span id="resumen_fecha"></span></p>
                                            <p><strong>Hora:</strong> <span id="resumen_hora"></span></p>
                                            <p><strong>Estado:</strong> <span id="resumen_estado"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary btn-anterior" data-prev="reserva-tab">
                            <i class="fas fa-arrow-left mr-2"></i> Anterior
                        </button>
                        <button type="submit" class="btn btn-success" id="btnGuardar">
                            <i class="fas fa-save mr-2"></i> Confirmar y Guardar Reserva
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Agregar SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <style>
        .form-group label {
            font-weight: 600;
        }
        .form-control {
            border-radius: 0.375rem;
        }
        select.form-control {
            height: calc(2.875rem + 2px);
        }
        .alert {
            border-radius: 0.375rem;
        }
        .tab-content {
            min-height: 400px;
        }
        .list-group-item {
            cursor: pointer;
        }
        .list-group-item:hover {
            background-color: #f8f9fa;
        }
        .border-bottom {
            border-bottom: 1px solid #dee2e6 !important;
        }
        .nav-tabs .nav-link {
            font-weight: 600;
        }
        #clienteResults {
            position: absolute;
            z-index: 1000;
            width: 100%;
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
@stop

@section('js')
    <!-- Agregar SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Variables para controlar el estado del formulario
            let clienteSeleccionado = false;
            
            // Inicializar datepicker si es necesario - Verificar si está disponible
            if ($.fn.datepicker) {
                $('#fecha_reserva').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    startDate: new Date()
                });
            }
            
            // Registro de eventos de clic
            $('#btnNuevoCliente').on('click', function() {
                $('#clienteSeleccionado').addClass('d-none');
                $('#formNuevoCliente').removeClass('d-none');
                $('#es_cliente_nuevo').val('1');
                $('#cliente_search').val('');
                $('#clienteResults').addClass('d-none');
                clienteSeleccionado = true;
                $('#nombre').focus();
            });
            
            $('.btn-siguiente').on('click', function() {
                const nextTab = $(this).data('next');
                
                // Validaciones específicas por pestaña
                if (nextTab === 'reserva-tab') {
                    // Validar que hay un cliente seleccionado
                    if (!clienteSeleccionado) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Por favor, seleccione un cliente existente o cree uno nuevo',
                            icon: 'error'
                        });
                        return;
                    }
                    
                    // Si es cliente nuevo, validar campos
                    if ($('#es_cliente_nuevo').val() === '1') {
                        const nombre = $('#nombre').val();
                        const apellido = $('#apellido').val();
                        const dni = $('#dni').val();
                        const telefono = $('#telefono').val();
                        const email = $('#email').val();
                        
                        if (!nombre || !apellido || !dni || !telefono || !email) {
                            Swal.fire({
                                title: 'Error',
                                text: 'Por favor, complete todos los campos obligatorios del cliente',
                                icon: 'error'
                            });
                            return;
                        }
                    }
                }
                
                if (nextTab === 'confirmar-tab') {
                    // Validar campos de la reserva
                    const artista = $('#id_artista').val();
                    const fecha = $('#fecha_reserva').val();
                    const hora = $('#hora_reserva').val();
                    
                    if (!artista || !fecha || !hora) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Por favor, complete todos los campos de la reserva',
                            icon: 'error'
                        });
                        return;
                    }
                    
                    // Actualizar resumen de la reserva
                    actualizarResumen();
                }
                
                // Cambiar a la siguiente pestaña
                $('#' + nextTab).tab('show');
            });
            
            // Búsqueda con autocompletado
            $('#cliente_search').on('input', function() {
                const search = $(this).val();
                
                if (search.length >= 2) {
                    // Mostrar indicador de carga
                    $('#clienteResults').removeClass('d-none').html('<div class="list-group-item text-center"><i class="fas fa-spinner fa-spin mr-2"></i> Buscando...</div>');
                    
                    // Obtener la URL de búsqueda
                    const url = "{{ route('Clientes.verificar') }}";
                    
                    // Petición AJAX para buscar clientes
                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: { search: search },
                        dataType: 'json',
                        success: function(clientes) {
                            $('#clienteResults').empty();
                            
                            if (Array.isArray(clientes) && clientes.length > 0) {
                                // Mostrar resultados
                                $('#clienteResults').removeClass('d-none');
                                
                                // Agregar cada cliente a la lista
                                $.each(clientes, function(index, cliente) {
                                    // Asegurar que cliente.nombre y cliente.apellido existen
                                    const nombreCompleto = ((cliente.nombre || '') + ' ' + (cliente.apellido || '')).trim();
                                    const dni = cliente.dni || '';
                                    const contacto = ((cliente.telefono || '') + ' - ' + (cliente.email || '')).trim();
                                    
                                    const item = $(`<a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">${nombreCompleto}</h6>
                                            <small class="text-muted">DNI: ${dni}</small>
                                        </div>
                                        <small>${contacto}</small>
                                    </a>`);
                                    
                                    // Al hacer clic en un cliente
                                    item.click(function(e) {
                                        e.preventDefault();
                                        seleccionarClienteExistente(cliente);
                                    });
                                    
                                    $('#clienteResults').append(item);
                                });
                            } else {
                                // No hay resultados
                                $('#clienteResults').removeClass('d-none');
                                $('#clienteResults').append(`
                                    <div class="list-group-item text-center text-muted">
                                        No se encontraron clientes con "${search}"
                                        <br><small>Puede crear un nuevo cliente con el botón "Nuevo Cliente"</small>
                                    </div>
                                `);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error en la búsqueda:", error);
                            
                            $('#clienteResults').removeClass('d-none');
                            $('#clienteResults').html(`
                                <div class="list-group-item text-center text-danger">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> 
                                    Error al buscar clientes. Intente nuevamente.
                                </div>
                            `);
                        }
                    });
                } else {
                    $('#clienteResults').addClass('d-none');
                }
            });
            
            // Botón para cambiar cliente seleccionado
            $('#btnCambiarCliente').click(function() {
                $('#clienteSeleccionado').addClass('d-none');
                $('#formNuevoCliente').addClass('d-none');
                $('#cliente_search').val('').focus();
                clienteSeleccionado = false;
            });
            
            // Función para seleccionar un cliente existente
            function seleccionarClienteExistente(cliente) {
                // Ocultar resultados y formulario de nuevo cliente
                $('#clienteResults').addClass('d-none');
                $('#formNuevoCliente').addClass('d-none');
                
                // Establecer ID del cliente y marcar como existente
                $('#id_cliente').val(cliente.id_cliente);
                $('#es_cliente_nuevo').val('0');
                
                // Mostrar información del cliente
                $('#display_nombre').text(cliente.nombre + ' ' + cliente.apellido);
                $('#display_dni').text(cliente.dni);
                $('#display_telefono').text(cliente.telefono);
                $('#display_email').text(cliente.email);
                
                // Mostrar bloque de cliente seleccionado
                $('#clienteSeleccionado').removeClass('d-none');
                
                // Limpiar campo de búsqueda
                $('#cliente_search').val('');
                
                // Marcar que hay un cliente seleccionado
                clienteSeleccionado = true;
            }
            
            // Manejar navegación con teclado en los resultados
            let selectedIndex = -1;

            $('#cliente_search').on('keydown', function(e) {
                const results = $('#clienteResults .list-group-item-action');
                const resultsCount = results.length;
                
                // No hacer nada si no hay resultados visibles
                if ($('#clienteResults').hasClass('d-none') || resultsCount === 0) {
                    return;
                }
                
                // Tecla flecha abajo
                if (e.keyCode === 40) {
                    e.preventDefault();
                    selectedIndex = (selectedIndex + 1) % resultsCount;
                    results.removeClass('active');
                    $(results[selectedIndex]).addClass('active');
                }
                
                // Tecla flecha arriba
                if (e.keyCode === 38) {
                    e.preventDefault();
                    selectedIndex = (selectedIndex - 1 + resultsCount) % resultsCount;
                    results.removeClass('active');
                    $(results[selectedIndex]).addClass('active');
                }
                
                // Tecla Enter
                if (e.keyCode === 13 && selectedIndex !== -1) {
                    e.preventDefault();
                    $(results[selectedIndex]).click();
                }
            });
            
            // Botones para retroceder
            $('.btn-anterior').click(function() {
                const prevTab = $(this).data('prev');
                $('#' + prevTab).tab('show');
            });
            
            // Actualizar resumen antes de enviar
            function actualizarResumen() {
                // Datos del cliente
                if ($('#es_cliente_nuevo').val() === '1') {
                    $('#resumen_nombre').text($('#nombre').val() + ' ' + $('#apellido').val());
                    $('#resumen_dni').text($('#dni').val());
                    $('#resumen_telefono').text($('#telefono').val());
                    $('#resumen_email').text($('#email').val());
                } else {
                    $('#resumen_nombre').text($('#display_nombre').text());
                    $('#resumen_dni').text($('#display_dni').text());
                    $('#resumen_telefono').text($('#display_telefono').text());
                    $('#resumen_email').text($('#display_email').text());
                }
                
                // Datos de la reserva
                $('#resumen_artista').text($('#id_artista option:selected').text());
                $('#resumen_fecha').text($('#fecha_reserva').val());
                $('#resumen_hora').text($('#hora_reserva').val());
                $('#resumen_estado').text($('#estado option:selected').text());
            }
            
            // Manejar clic fuera de la lista de resultados
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#clienteResults, #cliente_search').length) {
                    $('#clienteResults').addClass('d-none');
                }
            });
            
            // Validación antes de enviar el formulario
            $('#reservaRapidaForm').submit(function(e) {
                // Verificar que la información esté completa antes de enviar
                if (!clienteSeleccionado) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Error',
                        text: 'Por favor, seleccione un cliente existente o cree uno nuevo',
                        icon: 'error'
                    });
                    return false;
                }
                
                // Si es cliente nuevo, validar campos
                if ($('#es_cliente_nuevo').val() === '1') {
                    const nombre = $('#nombre').val();
                    const apellido = $('#apellido').val();
                    const dni = $('#dni').val();
                    const telefono = $('#telefono').val();
                    const email = $('#email').val();
                    
                    if (!nombre || !apellido || !dni || !telefono || !email) {
                        e.preventDefault();
                        Swal.fire({
                            title: 'Error',
                            text: 'Por favor, complete todos los campos obligatorios del cliente',
                            icon: 'error'
                        });
                        return false;
                    }
                }
                
                // Validar campos de la reserva
                const artista = $('#id_artista').val();
                const fecha = $('#fecha_reserva').val();
                const hora = $('#hora_reserva').val();
                
                if (!artista || !fecha || !hora) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Error',
                        text: 'Por favor, complete todos los campos de la reserva',
                        icon: 'error'
                    });
                    return false;
                }
                
                // Todo está correcto, permitir el envío y mostrar indicador de carga
                Swal.fire({
                    title: 'Procesando',
                    text: 'Guardando la reserva...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                return true;
            });
        });
    </script>
@stop