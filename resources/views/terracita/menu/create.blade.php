@extends('adminlte::page')

@section('title', 'Crear Menú')

@section('content_header')
    <h1>Catálogo Menú</h1>
@stop

@section('content')

<div class="card">
    <div class="row">
        <div class="col-4 m-3">
            <a href="{{asset('/menu')}}" class="btn btn-infor">
                <i class="fas fa-arrow-left"></i> Regresar 
            </a>
        </div>
    </div>
    <div class="card-header">
        Datos
    </div>
    <div class="card-body">
        <div class="row d-flex">
            <div class="col-lg-5 col-md-5 col-xl-5 col-sm-12">
                <div class="form-group d-flex" >
                    <label for="nombre" class="col-sm-3 col-form-label">Nombre:</label>
                    <div class="col-9">
                        <input name="nombre" id="nombre" type="text" class="form-control" placeholder="Almuerzos">
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-xl-7 col-sm-12">
                <div class="form-group d-flex" >
                    <label for="descripcion" class="col-sm-3 col-form-label">Descripción:</label>
                    <div class="col-9">
                        <textarea name="descripcion" id="descripcion" type="text" class="form-control" placeholder="Descripción"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-xl-5 col-sm-12">
                <div class="form-group d-flex" >
                    <label for="fecha" class="col-sm-3 col-form-label">Fecha:</label>
                    <div class="col-9">
                        <input name="fecha" id="fecha" type="date" class="form-control" required>
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
                <div class="row">
                    <!-- Primer Item -->
                    <div class="col-md-6 col-sm-5 col-lg-4 col-xl-4 mb-4">
                        <div class="card card-sm menu-card" style="width: 10rem;">
                            <img src="{{asset('images/item_menu/1701560893-1.PNG')}}" alt="Item 1">
                                <div class="menu-card-content">
                                    <h3>Item 1</h3>
                                    <p>Descripción del Item 1...</p>
                                    <p>Precio: <span class="menu-card-price">Bs 10.99</span></p>
                                    <button class="add-to-cart-btn">Agregar</button>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-5 col-lg-4 col-xl-4 mb-4">
                        <div class="card card-sm menu-card" style="width: 10rem;">
                            <img src="{{asset('images/item_menu/1701560893-1.PNG')}}" alt="Item 1">
                                <div class="menu-card-content">
                                    <h3>Item 1</h3>
                                    <p>Descripción del Item 1...</p>
                                    <p>Precio: <span class="menu-card-price">Bs 10.99</span></p>
                                    <button class="add-to-cart-btn">Agregar</button>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-5 col-lg-4 col-xl-4 mb-4">
                        <div class="card card-sm menu-card" style="width: 10rem;">
                            <img src="{{asset('images/item_menu/1701560893-1.PNG')}}" alt="Item 1">
                                <div class="menu-card-content">
                                    <h3>Item 1</h3>
                                    <p>Descripción del Item 1...</p>
                                    <p>Precio: <span class="menu-card-price">Bs 10.99</span></p>
                                    <button class="add-to-cart-btn">Agregar</button>
                                </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-5 col-lg-4 col-xl-4 mb-4">
                        <div class="card card-sm menu-card" style="width: 10rem;">
                            <img src="{{asset('images/item_menu/1701560893-1.PNG')}}" alt="Item 1">
                                <div class="menu-card-content">
                                    <h3>Item 1</h3>
                                    <p>Descripción del Item 1...</p>
                                    <p>Precio: <span class="menu-card-price">Bs 10.99</span></p>
                                    <button class="add-to-cart-btn">Agregar</button>
                                </div>
                        </div>
                    </div>
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
                    <input type="text" class="form-control" id="buscar-agregado" placeholder="Escribe para buscar...">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-5 col-lg-4 col-xl-4 mb-4">
                        <div class="card card-sm menu-card agregado" style="width: 10rem;">
                            <img src="{{asset('images/item_menu/1701560893-1.PNG')}}" alt="Item 1">
                            <div class="menu-card-content">
                                <h3>Item 6</h3>
                                <p>Precio: <span class="menu-card-price">Bs 35.99</span></p>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control form-control-sm" value="1">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success btn-sm mx-1">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-warning btn-sm">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center my-1">
                                        <button type="button" class="btn btn-info btn-sm mx-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                        
                                        <button class="btn btn-danger btn-sm mx-1">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-5 col-lg-4 col-xl-4 mb-4">
                        <div class="card card-sm menu-card agregado" style="width: 10rem;">
                            <img src="{{asset('images/item_menu/1701560893-1.PNG')}}" alt="Item 1">
                            <div class="menu-card-content">
                                <h3>Item 6</h3>
                                <p>Precio: <span class="menu-card-price">Bs 35.99</span></p>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control form-control-sm" value="1">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success btn-sm mx-1">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-warning btn-sm">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center my-1">
                                        <button type="button" class="btn btn-info btn-sm mx-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                        
                                        <button class="btn btn-danger btn-sm mx-1">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-5 col-lg-4 col-xl-4 mb-4">
                        <div class="card card-sm menu-card agregado" style="width: 10rem;">
                            <img src="{{asset('images/item_menu/1701560893-1.PNG')}}" alt="Item 1">
                            <div class="menu-card-content">
                                <h3>Item 7</h3>
                                <p>Precio: <span class="menu-card-price">Bs 35.99</span></p>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control form-control-sm" value="1">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success btn-sm mx-1">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-warning btn-sm">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center my-1">
                                        <button type="button" class="btn btn-info btn-sm mx-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                        
                                        <button class="btn btn-danger btn-sm mx-1">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-5 col-lg-4 col-xl-4 mb-4">
                        <div class="card card-sm menu-card agregado" style="width: 10rem;">
                            <img src="{{asset('images/item_menu/1701560893-1.PNG')}}" alt="Item 1">
                            <div class="menu-card-content">
                                <h3>Item 8</h3>
                                <p>Precio: <span class="menu-card-price">Bs 35.99</span></p>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control form-control-sm" value="1">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-success btn-sm mx-1">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-warning btn-sm">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center my-1">
                                        <button type="button" class="btn btn-info btn-sm mx-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                        
                                        <button class="btn btn-danger btn-sm mx-1">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Botón flotante para agregar al carrito -->
<div class="floating-btn">
    <button class="btn btn-primary" id="carritoBtn" data-toggle="modal" data-target="#carritoModal">
        <i class="bi bi-cart"></i> <span id="carritoCount">0</span>
    </button>
</div>

<div class="floating-btn">
    <button class="btn btn-primary" id="carritoBtn" data-toggle="modal" data-target="#carritoModal">
        <i class="bi bi-cart"></i> <span id="carritoCount">0</span>
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

    <style>
        /* Agrega estilos para el botón flotante en la esquina inferior derecha */
        .floating-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999; /* Ajusta el índice z según sea necesario para que esté por encima de otros elementos */
        }

        /* Ajusta el estilo del botón según tus preferencias */
        .floating-btn button {
            /* Agrega estilos personalizados aquí */
        }
    </style>
    


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

    <script>
        $(document).ready(function () {
            // Función para realizar la búsqueda
            $('#buscar').on('keyup', function () {
                var searchText = $(this).val().toLowerCase();

                // Iterar sobre cada tarjeta y mostrar/ocultar según la búsqueda
                $('.menu-card').each(function () {
                    var cardText = $(this).text().toLowerCase();
                    if (cardText.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });

        $(document).ready(function () {
            // Función para realizar la búsqueda
            $('#buscar-agregado').on('keyup', function () {
                var searchText = $(this).val().toLowerCase();

                // Iterar sobre cada tarjeta y mostrar/ocultar según la búsqueda
                $('.agregado').each(function () {
                    var cardText = $(this).text().toLowerCase();
                    if (cardText.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
@stop