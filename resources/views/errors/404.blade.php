@extends('layout')

@section('content')
    <h1>Error</h1>
    <h3>No pudimos encontrar esta página</h3>
    <a class="btn btn-default" href="{{ url()->previous() }}">regresar</a>
@stop