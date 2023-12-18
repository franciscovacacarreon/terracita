@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ventas</h1>
@stop

@section('content')

{{-- Loader --}}
<div id="loader-container"></div>

<!-- BAARRA DE NAVEGACION -->
{{-- <div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#nota-venta-tab"
                    data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Ventas realizadas</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#nota-venta-eliminados-tab"
                    data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a>
            </li> 
        </ul>
    </div>
</div> --}}


<div class="card-body">

    <div class="tab-content">
        <!------------------- INDEX ------------------->
        <div class="active tab-pane" id="nota-venta-tab">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div id="toolbar">
                        <a id="btn-nuevo-nota-venta" href="{{asset('admin/nota-venta-create')}}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Nuevo
                        </a>
                    </div>
                    <table id="tabla-nota-venta"
                            data-toggle="table"
                            data-show-print="true" 
                            data-show-columns="true" 
                            data-search="true" 
                            data-show-export="true" 
                            data-show-export="true"
                            data-pagination="true" 
                            data-toolbar="#toolbar"
                            data-detail-view="true" 
                            data-detail-formatter="detailFormatter">

                        <thead>
                            <tr>
                                <th data-sortable="true" data-field="id_nota_venta">ID</th>
                                <th data-sortable="true" data-field="monto">Monto</th>
                                <th data-sortable="true" data-field="descuento">Descuento %</th>
                                <th data-sortable="true" data-field="cliente_td">Cliente</th>
                                <th data-sortable="true" data-field="empleado_td">Empleado</th>
                                <th data-sortable="true" data-field="metodo_pago">Método de pago</th>
                                <th data-sortable="true" data-width="100" data-field="acciones">Acción</th>
                            </tr>
                        </thead>
                    </table>
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
    <script src="{{asset('/terracita/js/nota_venta/index_nota_venta.js')}}"></script>
@stop