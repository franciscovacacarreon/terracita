@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')

<!-- BAARRA DE NAVEGACION -->
<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#usuario-tab"
                    data-toggle="tab"><i class="fas fa-user"></i>&nbsp;&nbsp;Usuarios</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#usuario-eliminados-tab"
                    data-toggle="tab"><i class="far fa-trash-alt"></i>&nbsp;&nbsp;Eliminados</a>
            </li>
        </ul>
    </div>
</div>


<div class="card-body">

    <div class="tab-content">
        <!------------------- INDEX ------------------->
        <div class="active tab-pane" id="usuario-tab">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div id="toolbar">
                        <a id="btn-nuevo-usuario" class="btn btn-success">
                            <i class="fas fa-plus"></i> Nuevo
                        </a>
                    </div>
                    <table 
                        class="table-bordered table-hover table-striped"
                        id="tabla-usuario" data-show-export="true" data-search="true"
                        data-show-print="true" data-toggle="table" data-toolbar="#toolbar"
                        data-height="100%" data-only-info-pagination="false"
                        data-pagination="true" data-show-columns="true">
                        <thead>
                            <tr>
                                <th data-sortable="true" data-field="id">ID</th>
                                <th data-sortable="true" data-field="name">Nombre</th>
                                <th data-sortable="true" data-field="email">Correo</th>
                                <th data-sortable="true" data-field="rol">Rol</th>
                                <th data-sortable="true" data-field="persona">Nombre persona</th>
                                <th data-sortable="true" data-width="200" data-field="imagen_td">Imagen</th>
                                <th data-sortable="true" data-width="100" data-field="acciones">Acción</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <!------------------- ELIMINADOS ------------------->
        <div class="tab-pane" id="usuario-eliminados-tab">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <table 
                        class="table-bordered table-hover table-striped"
                        id="tabla-usuario-eliminados" 
                        data-show-export="true" data-search="true"
                        data-show-print="true" data-toggle="table" 
                        data-height="100%" data-only-info-pagination="false"
                        data-pagination="true" data-show-columns="true">
                        <thead>
                            <tr>
                                <th data-sortable="true" data-field="id">ID</th>
                                <th data-sortable="true" data-field="name">Nombre</th>
                                <th data-sortable="true" data-field="email">Correo</th>
                                <th data-sortable="true" data-field="rol">Rol</th>
                                <th data-sortable="true" data-field="persona">Nombre persona</th>
                                <th data-sortable="true" data-width="200" data-field="imagen_td">Imagen</th>
                                <th data-sortable="true" data-width="100" data-field="acciones">Acción</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div> 
        </div>
    </div>

</div>


<div class="modal fade" id="modal-nuevo-usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Nuevo usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Nombre de usuario:</label>
                        <div class="col-sm-8">
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="Ej: juanenrique"
                                required
                            >
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label">Contraseña:</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    aria-describedby="toggle-password"
                                    required
                                >
                                <div class="input-group-append">
                                    <button
                                        class="btn btn-outline-secondary"
                                        type="button"
                                        id="toggle-password"
                                        title="Mostrar/ocultar contraseña"
                                    >
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="password-repite" class="col-sm-4 col-form-label">Repite la contraseña:</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password-repite"
                                    name="password-repite"
                                    required
                                >
                                <div class="input-group-append">
                                    <button
                                        class="btn btn-outline-secondary"
                                        type="button"
                                        id="toggle-password-repite"
                                        title="Mostrar/ocultar contraseña"
                                    >
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="id-rol" class="col-sm-4 col-form-label">Rol:</label>
                        <div class="col-sm-8">
                            <select
                                class="form-control"
                                id="id-rol"
                                name="id-rol"
                                required
                            ></select>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="id-persona" class="col-sm-4 col-form-label">Persona:</label>
                        <div class="col-sm-8">
                            <select
                                class="form-control"
                                id="id-persona"
                                name="id-persona"
                                required
                            ></select>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="imagen" class="col-sm-4 col-form-label">Imagen:</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input
                                    type="file"
                                    class="custom-file-input"
                                    id="imagen"
                                    name="imagen"
                                    accept="image/*"
                                    onchange="mostrarVistaPrevia()"
                                >
                                <label class="custom-file-label" for="imagen">Seleccionar imagen</label>
                            </div>
                            <div class="mt-3">
                                <img
                                    id="vista-previa"
                                    src="#"
                                    alt="Vista previa de la imagen"
                                    style="max-width: 100%; max-height: 200px; display: none;"
                                >
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
            <button id="guardar-usuario" type="button" class="btn btn-success">
                <i class="far fa-save"></i> Guardar
            </button>
        </div>
      </div>
    </div>
  </div>


  <!-- modal edit usuario-->

  <div class="modal fade" id="modal-edit-usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Editar usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="form-group row">
                        <label for="nombre-edit" class="col-sm-4 col-form-label">Nombre:</label>
                        <div class="col-sm-8">
                            <input name="nombre-edit" type="text" class="form-control" id="nombre-edit" placeholder="Ej: Pollo al jugo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="precio-edit" class="col-sm-4 col-form-label">Precio:</label>
                        <div class="col-sm-8">
                            <input name="precio-edit" type="number" class="form-control" id="precio-edit" placeholder="Ej: 10" step="any">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="descripcion-edit" class="col-sm-4 col-form-label">Descripción:</label>
                        <div class="col-sm-8">
                            <textarea name="descripcion-edit" class="form-control" id="descripcion-edit" placeholder="Ej: Especial con extra de carne"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id-tipo-menu-edit" class="col-sm-4 col-form-label">Tipo item menú:</label>
                        <div class="col-sm-8">
                            <select name="id-tipo-menu-edit" id="id-tipo-menu-edit"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="imagen-edit" class="col-sm-4 col-form-label">Imagen:</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imagen-edit" accept="image/*" onchange="mostrarVistaPreviaEdit()">
                                    <label class="custom-file-label" for="imagen-edit">Seleccionar imagen</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <img id="vista-previa-edit" src="#" alt="Vista previa de la imagen" style="max-width: 100%; max-height: 200px; display: none;">
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
            <button id="actualizar-usuario" type="button" class="btn btn-success">
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

    {{-- bootstrap --}}
    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap-table.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    {{-- Alert --}}
    <link rel="stylesheet" href="{{asset('/bootstrap/css/alertify.min.css')}}"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="{{asset('/bootstrap/css/default.min.css')}}"/>

    {{-- select 2 --}}
    <link rel="stylesheet" href="{{asset('/bootstrap/css/select2.min.css')}}"/>


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
    
    {{-- select 2 --}}
    <script src="{{asset('/bootstrap/js/select2.min.js')}}"></script>

    <script src="{{asset('/terracita/js/parametros.js')}}"></script>
    <script src="{{asset('/terracita/js/user.js')}}"></script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
    
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
            });
    
            const togglePasswordRepite = document.getElementById('toggle-password-repite');
            const passwordRepiteInput = document.getElementById('password-repite');
    
            togglePasswordRepite.addEventListener('click', function () {
                const type = passwordRepiteInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordRepiteInput.setAttribute('type', type);
            });
        });
    </script>
@stop