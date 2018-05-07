@extends('layout')

@section('content')
    <h1>{{ $user->name }}</h1>
    <table class="table">
        <tr>
            <td>Nombre: </td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>Email: </td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Roles: </td>
            <td>{{ $user->roles->pluck('display_name')->implode(', ') }}</td>
        </tr>
    </table>

    @can('edit', $user)
        <a class="btn btn-info" href="{{ route('users.edit', $user->id) }}">Editar</a>
    @endcan

    @can('destroy', $user)
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
            @method('DELETE')
            @csrf
            <input type="submit" class="btn btn-danger" value="Eliminar">
        </form>
    @endcan
@endsection