@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Correo</h1>
@stop

@section('content')

{{-- Loader --}}
<div id="loader-container"></div>


<div class="container mt-5">
    <div class="col-12 d-flex justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3>Enviar correo</h3>
                </div>
                <div class="card-body">
                        <div class="form-group">
                            <label for="asunto">Asunto:</label>
                            <input type="text" class="form-control" id="asunto" name="asunto" required>
                        </div>
        
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
        
                        <div class="form-group">
                            <label for="correo_remitente">Correo Remitente:</label>
                            <input type="email" class="form-control" id="correo_remitente" name="correo_remitente" required>
                        </div>
        
                        <div class="form-group">
                            <label for="correo_destinatario">Correo Destinatario:</label>
                            <input type="email" class="form-control" id="correo_destinatario" name="correo_destinatario" required>
                        </div>
        
                        <div class="form-group">
                            <label for="mensaje">Mensaje:</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                        </div>
        
                        <a href="{{asset('/admin/correo-enviar-mesaje')}}"class="btn btn-primary">Enviar Mensaje</a>
                </div>
            </div>
        </div>
    </div>
</div>




@stop

@section('css')

    {{-- stilos personalizados --}}
    <link rel="stylesheet" href="{{asset('/terracita/css/style.css')}}"/>

    {{-- <link rel="stylesheet" href="{{asset('/bootstrap/css/font-awesome.all.min.css')}}"/> --}}
    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap-table.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap-icons.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    {{-- Alert --}}
    <link rel="stylesheet" href="{{asset('/bootstrap/css/alertify.min.css')}}"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="{{asset('/bootstrap/css/default.min.css')}}"/>
    


@stop

@section('js')

    {{-- bootstrap table --}}
    <script src="{{asset('/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/bootstrap/js/bootstrap-table.min.js')}}"></script>
    
    {{-- para imprimir --}}
    <script src="{{asset('/bootstrap/js/bootstrap-table-print.min.js')}}"></script>
    
    {{-- para exportar --}}
    <script src="{{asset('/bootstrap/js/tableExport.min.js')}}"></script>
    <script src="{{asset('/bootstrap/js/jspdf.min.js')}}"></script>
    <script src="{{asset('/bootstrap/js/jspdf.plugin.autotable.js')}}"></script> 
    <script src="{{asset('/bootstrap/js/bootstrap-table-export.min.js')}}"></script> 

    {{-- alert --}}
    <script src="{{asset('/bootstrap/js/alertify.min.js')}}"></script>

    {{-- perzonalizado --}}
    {{-- loader --}}
    <script src="{{asset('/bootstrap/js/spin.min.js')}}"></script>


    <script src="{{asset('/terracita/js/parametros.js')}}"></script>
    <script src="{{asset('/terracita/js/menu/index_menu.js')}}"></script>
@stop