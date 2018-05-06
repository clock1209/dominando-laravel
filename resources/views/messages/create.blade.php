@extends('layout')

@section('content')
    <h1>Contactos</h1>
    <h2>Escríbeme</h2>
    @if (session()->has('info'))
        <h3>{{ session('info') }}</h3>
    @else
        <form method="POST" action="{{ route('messages.store') }}">
            @csrf
            <p>
                <label for="nombre">Nombre:
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control">
                    {!! $errors->first('nombre', '<span class=error>:message</span>') !!}
                </label>
            </p>
            <p>
                <label for="email">Email:
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                    {!! $errors->first('email', '<span class=error>:message</span>') !!}
                </label>
            </p>
            <p>
                <label for="mensaje">Mensaje:
                    <textarea name="mensaje" class="form-control">{{ old('mensaje') }}</textarea>
                    {!! $errors->first('mensaje', '<span class=error>:message</span>') !!}
                </label>
            </p>
            <p>
                <input type="submit" value="Enviar" class="btn btn-primary">
            </p>
        </form>
    @endif
@stop