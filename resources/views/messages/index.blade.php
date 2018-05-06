@extends('layout')

@section('content')
    <h1>Mensajes guardados</h1>
    <table class="table table-bordered table-hover table-sm">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td><a href="{{ route('messages.show', $message->id) }}">{{ $message->nombre }}</a></td>
                    <td>{{ $message->email }}</td>
                    <td>{{ str_limit($message->mensaje, 50, ' ...') }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('messages.edit', $message->id) }}">Editar</a>
                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display: inline;">
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