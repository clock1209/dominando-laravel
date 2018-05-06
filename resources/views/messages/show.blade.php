@extends('layout')

@section('content')
    <h1>Mensaje</h1>
    <h4>{{ $message->nombre }} - {{ $message->email }}</h4>
    <p>{{ $message->mensaje }}</p>
@stop