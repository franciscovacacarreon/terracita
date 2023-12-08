@extends('adminlte::page')

@section('title', 'Crear Menú')

@section('content_header')
    <h1>Nueva venta</h1>
@stop

@section('content')

<div class="card">
    <div class="row">
        <div class="col-4 m-3">
            <a href="{{asset('/nota-venta')}}" class="btn btn-infor">
                <i class="fas fa-arrow-left"></i> Regresar 
            </a>
        </div>
    </div>
    <div class="card-header">
        Datos
    </div>
    <div class="card-body">
        <div class="row d-flex">
            <div class="col-lg-6 col-md-6 col-xl-6 col-sm-12">
                <div class="form-group d-flex" >
                    <label for="id-menu" class="col-sm-3 col-form-label">Menús:</label>
                    <div class="col-9">
                        <select  name="id-menu" id="id-menu" class="form-control">
                            <option value="0">Seleccione el menú</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xl-6 col-sm-12">
                <div class="form-group d-flex" >
                    <label for="id-cliente" class="col-sm-3 col-form-label">Clientes:</label>
                    <div class="col-9">
                        <select  name="id-cliente" id="id-cliente" class="form-control">
                            <option value="0">Seleccione el cliente</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-6 col-md-6 col-xl-6 col-sm-12">
                <div class="form-group d-flex" >
                    <label for="id-tipo-pago" class="col-sm-3 col-form-label">Método de pago:</label>
                    <div class="col-9">
                        <select  name="id-tipo-pago" id="id-tipo-pago" class="form-control">
                            <option value="0">Seleccione el cliente</option>
                        </select>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-6 col-md-6 col-xl-6 col-sm-12">
                <div class="form-group d-flex" >
                    <label for="descripcion" class="col-sm-3 col-form-label">Fecha:</label>
                    <div class="col-9">
                        <input type="date" class="form-control" id="fecha" name="fecha" disabled>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xl-6 col-sm-12">
                <div class="form-group d-flex" >
                    <label for="monto" class="col-sm-3 col-form-label">Monto total:</label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="monto" name="monto" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Primera mitad para mostrar los primeros 3 items disponibles -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title my-2">Items Disponibles</h5>
                <div class="form-group">
                    <input type="text" class="form-control" id="buscar" placeholder="Escribe para buscar...">
                </div>
            </div>
            <div class="card-body">
                <div class="row" id="content-card-disponible">
                </div>
            </div>
        </div>
    </div>

    <!-- Segunda mitad para mostrar los siguientes 3 items disponibles -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title my-2">Items agregados</h5>
                <div class="form-group">
                    <input type="text" class="form-control" id="buscar-add" placeholder="Escribe para buscar...">
                </div>
            </div>
            <div class="card-body">
                <div class="row" id="content-card-add">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Botón flotante para agregar al carrito -->

<div class="floating-btn">
    <button class="btn btn-primary" id="guardar-nota-venta" data-toggle="modal" data-target="#carritoModal">
        <i class="fa fa-save"></i> Guardar
    </button>
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

    {{-- select 2 --}}
    <link rel="stylesheet" href="{{asset('/bootstrap/css/select2.min.css')}}"/>


@stop

@section('js')

    <script>
        const user = <?=$user?>;
    </script>

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


    {{-- select 2 --}}
    <script src="{{asset('/bootstrap/js/select2.min.js')}}"></script>

    <script src="{{asset('/terracita/js/parametros.js')}}"></script>
    <script src="{{asset('/terracita/js/nota_venta/create_nota_venta.js')}}"></script>
@stop