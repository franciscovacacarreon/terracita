@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tipo item menú</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/bootstrap_table/css/font-awesome.all.min.css')}}" integrity="sha512-..." crossorigin="anonymous" /> 
    <link href="{{asset('/bootstrap_table/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/bootstrap_table/css/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('/bootstrap_table/css/bootstrap-table.min.css')}}">
@stop

@section('js')
    {{-- bootstrap table --}}
    <script src="{{asset('/bootstrap_table/js/bootstrap.bundle.min.js')}}" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="{{asset('/bootstrap_table/js/bootstrap-table.min.js')}}"></script>
    {{-- para imprimir --}}
    <script src="{{asset('/bootstrap_table/js/bootstrap-table-print.min.js')}}"></script>
    {{-- para exportar --}}
    <script src="{{asset('/bootstrap_table/js/tableExport.min.js')}}"></script>
    <script src="{{asset('/bootstrap_table/js/jspdf.min.js')}}"></script>
    <script src="{{asset('/bootstrap_table/js/jspdf.plugin.autotable.js')}}"></script> 
    <script src="{{asset('/bootstrap_table/js/bootstrap-table-export.min.js')}}"></script> 
@stop