@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Item menú</h1>
@stop

@section('content')

<div class="row">
    <div class="col-lg-12 col-sm-12">
        <div id="toolbar">
            <a id="btn-nuevo-item-menu" class="btn btn-success">
                <i class="fas fa-plus"></i> Nuevo
            </a>
        </div>
        <table 
            class="table-bordered table-hover table-striped"
            id="tabla-item-menu" data-show-export="true" data-search="true"
            data-show-print="true" data-toggle="table" data-toolbar="#toolbar"
            data-height="100%" data-only-info-pagination="false"
            data-pagination="true" data-show-columns="true">
            <thead>
                <tr>
                    <th data-sortable="true" data-field="id_item_menu">ID</th>
                    <th data-sortable="true" data-field="nombre">Nombre</th>
                    <th data-sortable="true" data-field="descripcion">Descripcion</th>
                    <th data-sortable="true" data-field="imagen_th">Imagen</th>
                    <th data-sortable="true" data-width="100" data-field="acciones">Acción</th>
                </tr>
            </thead>
        </table>
    </div>
</div>


<!-- modal nuevo item menu-->
<div class="modal fade" id="modal-nuevo-item-menu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Nuevo item menú</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="form-group row">
                        <label for="nombre" class="col-sm-4 col-form-label">Nombre:</label>
                        <div class="col-sm-8">
                            <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ej: hollow">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="precio" class="col-sm-4 col-form-label">Precio:</label>
                        <div class="col-sm-8">
                            <input name="precio" type="number" class="form-control" id="precio" placeholder="Ej: 10">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="descripcion" class="col-sm-4 col-form-label">Descripción:</label>
                        <div class="col-sm-8">
                            <input name="descripcion" type="text" class="form-control" id="descripcion" placeholder="Ej: especial">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="descripcion" class="col-sm-4 col-form-label">Descripción:</label>
                        <div class="col-sm-8">
                           <select name="id_tipo_menu" id="id_tipo_menu" class="form-control">
                                <option value="0">Selecciona una opción</option>
                           </select>
                           
                        </div>
                    </div>
                    <div class="form-group row">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                <i class="fas fa-door-open"></i>    
                Close
            </button>
            <button id="guardar-item-menu" type="button" class="btn btn-success">
                <i class="far fa-save"></i> Guardar
            </button>
        </div>
      </div>
    </div>
  </div>


  <!-- modal editar item menu-->

<div class="modal fade" id="modal-editar-item-menu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Editar item item menú</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="form-group row d-flex" >
                        <label for="hasta" class="col-sm-2 col-form-label">Nombre:</label>
                        <div class="col-sm-12">
                            <input name="nombre-edit" id="nombre-edit" type="text" class="form-control" placeholder="Sopa">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                <i class="fas fa-door-open"></i>    
                Close
            </button>
            <button id="actualizar-item-menu" type="button" class="btn btn-success">
                <i class="far fa-save"></i> Actualizar
            </button>
        </div>
      </div>
    </div>
  </div>



  @stop

@section('css')

    {{-- stilos personalizados --}}
    <link rel="stylesheet" href="{{asset('/terracita/css/style.css')}}"/>

    <link rel="stylesheet" href="{{asset('/bootstrap/css/font-awesome.all.min.css')}}"/>
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
    <script src="{{asset('/terracita/js/item_menu.js')}}"></script>
@stop