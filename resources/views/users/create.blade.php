@extends('layout')

@section('content')
    <h1>Crear Usuario</h1>
    @if (session()->has('info'))
        <div class="alert alert-success">{{ session('info') }}</div>
    @endif
    <form method="POST" action="{{ route('users.store') }}">
        @includeIf('users.partials.form', ['user' => new \App\User])
        <p>
            <input class="btn btn-primary" type="submit" value="Crear">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Regresar</a>
        </p>
    </form>
@stop