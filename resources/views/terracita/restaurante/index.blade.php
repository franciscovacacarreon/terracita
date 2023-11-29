@extends('adminlte::page')

@section('title', 'Restaurante')

@section('content_header')
    <h1>Restaurante</h1>
@stop

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Información del Restaurante</h3>
                </div>
                <div class="card-body">
                    <!-- Aquí incluir el código para mostrar/permitir editar la información del restaurante -->
                    <form>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>ID:</strong> <span id="restaurantId" class="fw-bold">123</span>
                            </li>
                            <li class="list-group-item">
                                <strong>Nombre:</strong> <input type="text" id="restaurantName" class="form-control" value="Nombre del Restaurante">
                            </li>
                            <li class="list-group-item">
                                <strong>Dirección:</strong> <input type="text" id="restaurantAddress" class="form-control" value="Dirección del Restaurante">
                            </li>
                            <li class="list-group-item">
                                <strong>Teléfono:</strong> <input type="tel" id="restaurantPhone" class="form-control" value="123-456-7890">
                            </li>
                            <li class="list-group-item">
                                <strong>Correo:</strong> <input type="email" id="restaurantEmail" class="form-control" value="correo@restaurante.com">
                            </li>
                            <li class="list-group-item">
                                <strong>Horario Apertura:</strong> <input type="text" id="openingHours" class="form-control" value="09:00 AM">
                            </li>
                            <li class="list-group-item">
                                <strong>Horario Cierre:</strong> <input type="text" id="closingHours" class="form-control" value="08:00 PM">
                            </li>
                            <li class="list-group-item">
                                <strong>Descripción:</strong> <textarea id="restaurantDescription" class="form-control">Descripción del restaurante</textarea>
                            </li>
                            <li class="list-group-item">
                                    <label for="imagen" class="col-sm-4 col-form-label">Imagen:</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="imagen" accept="image/*" onchange="mostrarVistaPrevia()">
                                                <label class="custom-file-label" for="imagen">Seleccionar imagen</label>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <img id="vista-previa" src="#" alt="Vista previa de la imagen" style="max-width: 100%; max-height: 200px; display: none;">
                                        </div>
                                </div>
                            </li>
                        </ul>
                        <button type="button" onclick="guardarCambios()" class="btn btn-primary mt-3">Guardar Cambios</button>
                    </form>
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
    
    <script src="{{asset('/terracita/js/parametros.js')}}"></script>
    <script src="{{asset('/terracita/js/cliente.js')}}"></script>
@stop
