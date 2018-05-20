@extends('layout')

@section('content')
    <h1>Mensaje</h1>
    <h4>{{ $message->nombre or $message->user->name }} - {{ $message->email or $message->user->email }}</h4>
    <p>{{ $message->mensaje }}</p>
@stop