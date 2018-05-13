@extends('layout')

@section('content')
    <h1>Sin autorización</h1>
    <h3>No tiene autorización para acceder a esta ruta</h3>
    <a class="btn btn-default" href="{{ route('home') }}">regresar</a>
@stop