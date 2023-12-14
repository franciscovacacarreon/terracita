@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><i class="fas fa-lock"></i> Acceso denegado</h1>
@stop

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h2 class="card-title">No tienes permiso para acceder a esta vista</h2>
                    <p class="card-text">Por favor, contacta al administrador para obtener acceso.</p>
                    {{-- <a href="{{asset('/')}}" class="btn btn-primary">Volver al inicio</a> --}}
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
    <script src="{{asset('/terracita/js/rol.js')}}"></script>
@stop