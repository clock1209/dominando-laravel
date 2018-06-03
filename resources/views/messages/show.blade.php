@extends('layout')

@section('content')
    <h1>Mensaje</h1>
    <h4>{{ $message->present()->userName() }} - {{ $message->present()->userEmail() }}</h4>
    <p>{{ $message->mensaje }}</p>
@stop