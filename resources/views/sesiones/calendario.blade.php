@extends('adminlte::page')

@section('title', 'Calendario de Sesiones')

@section('content_header')
    <h1>Agendar Sesión</h1>
@stop

@section('content')
<div class="container-fluid">
    <div id='calendar'></div>
</div>
@stop

@section('css')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css' rel='stylesheet' />
    <style>
        #calendar {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
        }
    </style>
@stop

@section('js')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var eventos = @json($eventos);
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                events: eventos,
                dateClick: function(info) {
                    let fecha = info.dateStr;
                    Swal.fire({
                        title: 'Agendar sesión',
                        text: '¿Deseas agendar una sesión el ' + fecha + '?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, agendar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/sesiones/crear?fecha=' + fecha;
                        }
                    });
                },
                eventClick: function(info) {
                    let props = info.event.extendedProps;
                    let hora = props.hora_inicio + ' - ' + props.hora_fin;
                    let descripcion = props.descripcion;
                    let costo = props.costo;
                    Swal.fire({
                        title: info.event.title,
                        html: '<b>Hora:</b> ' + hora + '<br><b>Descripción:</b> ' + descripcion + '<br><b>Costo:</b> $' + costo,
                        icon: 'info',
                    });
                }
            });
            calendar.render();
        });
    </script>
@stop
