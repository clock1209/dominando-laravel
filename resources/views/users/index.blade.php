@extends('layout')

@section('content')
    <h1>Usuarios</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary float-right" style="margin-bottom: 10px;">Crear Usuario</a><br>
    <table class="table table-bordered table-hover table-sm">
        <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Role</th>
            <th>Nota</th>
            <th>Etiquetas</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->present()->link() }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->present()->roles() }}</td>
                <td>{{ $user->present()->notes() }}</td>
                <td>{{ $user->present()->tags() }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('users.edit', $user->id) }}">Editar</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-danger btn-sm" value="Eliminar">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop