@extends('layout')

@section('content')
    <h1>Editar Usuario</h1>
    @if (session()->has('info'))
        <div class="alert alert-success">{{ session('info') }}</div>
    @endif
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @method('PUT')
        @csrf
        <p>
            <label for="nombre">Nombre:
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                {!! $errors->first('name', '<span class=error>:message</span>') !!}
            </label>
        </p>
        <p>
            <label for="email">Email:
                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                {!! $errors->first('email', '<span class=error>:message</span>') !!}
            </label>
        </p>
        <p>
            <input class="btn btn-primary" type="submit" value="Editar">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Regresar</a>
        </p>
    </form>
@stop