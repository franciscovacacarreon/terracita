@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Catálogo Menú</h1>
@stop

@section('content')

<!-- BAARRA DE NAVEGACION -->
<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#menu-tab"
                    data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Catálogo Menú</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#menu-eliminados-tab"
                    data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a>
            </li>
        </ul>
    </div>
</div>


<div class="card-body">

    <div class="tab-content">
        <!------------------- INDEX ------------------->
        <div class="active tab-pane" id="menu-tab">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div id="toolbar">
                        <a id="btn-nuevo-menu" href="{{asset('/menu-create')}}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Nuevo
                        </a>
                    </div>
                    <table 
                        class="table-bordered table-hover table-striped"
                        id="tabla-menu" data-show-export="true" data-search="true"
                        data-show-print="true" data-toggle="table" data-toolbar="#toolbar"
                        data-height="100%" data-only-info-pagination="false"
                        data-pagination="true" data-show-columns="true">
                        <thead>
                            <tr>
                                <th data-sortable="true" data-field="id_menu">ID</th>
                                <th data-sortable="true" data-field="nombre">Nombre</th>
                                <th data-sortable="true" data-field="descripcion">Descripción</th>
                                <th data-sortable="true" data-width="100" data-field="acciones">Acción</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <!------------------- ELIMINADOS ------------------->
        <div class="tab-pane" id="menu-eliminados-tab">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <table 
                        class="table-bordered table-hover table-striped"
                        id="tabla-menu-eliminados" 
                        data-show-export="true" data-search="true"
                        data-show-print="true" data-toggle="table" 
                        data-height="100%" data-only-info-pagination="false"
                        data-pagination="true" data-show-columns="true">
                        <thead>
                            <tr>
                                <th data-sortable="true" data-field="id_menu">ID</th>
                                <th data-sortable="true" data-field="nombre">Nombre</th>
                                <th data-sortable="true" data-field="descripcion">Descripción</th>
                                <th data-sortable="true" data-width="100" data-field="acciones">Acción</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div> 
        </div>
    </div>

</div>


<!-- modal nuevo menu-->
<div class="modal fade" id="modal-nuevo-menu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nuevo tipo item menú</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                    <i class="fas fa-door-open"></i>    
                    Close
                </button>
                <button id="guardar-menu" type="button" class="btn btn-success">
                    <i class="far fa-save"></i> Guardar
                </button>
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
    <script src="{{asset('/terracita/js/menu.js')}}"></script>
@stop