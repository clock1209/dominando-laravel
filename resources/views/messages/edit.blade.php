@extends('layout')

@section('content')
    <h1>Editar Mensaje</h1>
    @if (session()->has('info'))
        <h3>{{ session('info') }}</h3>
    @else
        <form method="POST" action="{{ route('messages.update', $message->id) }}">
            @method('PUT')
            @csrf
            <p>
                <label for="nombre">Nombre:
                    <input type="text" class="form-control" name="nombre" value="{{ $message->nombre }}">
                    {!! $errors->first('nombre', '<span class=error>:message</span>') !!}
                </label>
            </p>
            <p>
                <label for="email">Email:
                    <input type="email" class="form-control" name="email" value="{{ $message->email }}">
                    {!! $errors->first('email', '<span class=error>:message</span>') !!}
                </label>
            </p>
            <p>
                <label for="mensaje">Mensaje:
                    <textarea name="mensaje" class="form-control">{{ $message->mensaje }}</textarea>
                    {!! $errors->first('mensaje', '<span class=error>:message</span>') !!}
                </label>
            </p>
            <p>
                <input class="btn btn-primary" type="submit" value="Editar">
                <a href="{{ route('messages.index') }}" class="btn btn-secondary">Regresar</a>
            </p>
        </form>
    @endif
@stop