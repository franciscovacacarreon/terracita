@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')

{{-- Loader --}}
<div id="loader-container"></div>

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
                        <a id="btn-nuevo-user" class="btn btn-success">
                            <i class="fas fa-plus"></i> Nuevo
                        </a>
                    </div>
                    <table 
                        class="table-bordered table-hover table-striped"
                        id="tabla-user" data-show-export="true" data-search="true"
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
                        id="tabla-user-eliminados" 
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


{{-- modal nuevo user --}}
<div class="modal fade" id="modal-nuevo-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nuevo usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="juanenrique" required>

                        <label for="email" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@gmail.com" required>
                        <p for="email-advertencia" id="email-advertencia" class="form-label text-danger d-none">Correo no disponible</p>

                        <label for="password" class="form-label">Contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="toggle-password" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggle-password" title="Mostrar/ocultar contraseña">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <label for="form-control" class="text-danger d-none password-advertencia">Las contraseñas no coinciden</label>

                        <label for="password-repite" class="form-label">Repite la contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password-repite" name="password-repite" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggle-password-repite" title="Mostrar/ocultar contraseña">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <label for="form-control" class="text-danger d-none password-advertencia">Las contraseñas no coinciden</label>
                    </div>

                    <div class="col-md-6">
                        <label for="id-rol" class="form-label">Rol:</label>
                        <select id="id-rol" name="id-rol" data-placeholder="Selecciona un rol" multiple required></select>

                        <label for="id-persona" class="form-label">Persona:</label>
                        <select id="id-persona" name="id-persona" data-placeholder="Selecciona una persona" multiple required></select>

                        <label for="imagen" class="form-label">Imagen:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imagen" name="imagen" accept="image/*" onchange="mostrarVistaPrevia()">
                            <label class="custom-file-label" for="imagen">Seleccionar imagen</label>
                        </div>
                        <div class="mt-3">
                            <img id="vista-previa" src="#" alt="Vista previa de la imagen" style="max-width: 100%; max-height: 200px; display: none;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                    <i class="fas fa-door-open"></i>
                    Close
                </button>
                <button id="guardar-user" type="button" class="btn btn-success">
                    <i class="far fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>




  <!-- modal edit usuario-->

  <div class="modal fade" id="modal-edit-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Editar usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name-edit" class="form-label">Nombre de usuario:</label>
                    <input type="text" class="form-control" id="name-edit" name="name-edit" placeholder="juanenrique" required>

                    <label for="email-edit" class="form-label">Correo:</label>
                    <input type="email-edit" class="form-control" id="email-edit" name="email-edit" placeholder="ejemplo@gmail.com" required>
                    <p for="email-advertencia-edit" id="email-advertencia-edit" class="form-label text-danger d-none">Correo no disponible</p>

                    <label for="password-edit" class="form-label">Contraseña:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password-edit" name="password-edit" aria-describedby="toggle-password-edit" required>
                        <button class="btn btn-outline-secondary" type="button" id="toggle-password-edit" title="Mostrar/ocultar contraseña">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <p for="form-control" class="text-danger d-none password-advertencia-edit">Las contraseñas no coinciden</p>

                    <label for="password-repite-edit" class="form-label">Repite la contraseña:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password-repite-edit" name="password-repite-edit" required>
                        <button class="btn btn-outline-secondary" type="button" id="toggle-password-repite-edit" title="Mostrar/ocultar contraseña">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <p for="form-control" class="text-danger d-none password-advertencia-edit">Las contraseñas no coinciden</p>
                </div>

                <div class="col-md-6">
                    <label for="id-rol-edit" class="form-label">Rol:</label>
                    <select id="id-rol-edit" name="id-rol-edit" data-placeholder="Selecciona un rol" multiple required></select>

                    <label for="id-persona-edit" class="form-label">Persona:</label>
                    <select id="id-persona-edit" name="id-persona-edit" data-placeholder="Selecciona una persona" multiple required></select>

                    <label for="imagen-edit" class="form-label">Imagen:</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imagen-edit" name="imagen-edit" accept="image/*" onchange="mostrarVistaPreviaEdit()">
                        <label class="custom-file-label" for="imagen-edit">Seleccionar imagen</label>
                    </div>
                    <div class="mt-3">
                        <img id="vista-previa-edit" src="#" alt="Vista previa de la imagen" style="max-width: 100%; max-height: 200px; display: none;">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                <i class="fas fa-door-open"></i>    
                Close
            </button>
            <button id="actualizar-user" type="button" class="btn btn-success">
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
    <link rel="stylesheet" href="{{asset('/bootstrap/css/chosen.css')}}"/>


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
    <script src="{{asset('/bootstrap/js/chosen.jquery.js')}}"></script>
    <script src="{{asset('/bootstrap/js/chosen.jquery.min.js')}}"></script>

    {{-- loader --}}
    <script src="{{asset('/bootstrap/js/spin.min.js')}}"></script>


    <script src="{{asset('/terracita/js/parametros.js')}}"></script>
    <script src="{{asset('/terracita/js/user.js')}}"></script>
@stop