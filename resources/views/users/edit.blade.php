@extends('layout')

@section('content')
    <h1>Editar Usuario</h1>
    @if (session()->has('info'))
        <div class="alert alert-success">{{ session('info') }}</div>
    @endif
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @method('PUT')
        @includeIf('users.partials.form')
        <p>
            <input class="btn btn-primary" type="submit" value="Editar">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Regresar</a>
        </p>
    </form>
@stop