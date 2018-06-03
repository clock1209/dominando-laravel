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
                <th>Nota</th>
                <th>Etiquetas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->present()->userName() }}</td>
                    <td>{{ $message->present()->userEmail() }}</td>
                    <td>{{ $message->present()->link() }}</td>
                    <td>{{ $message->present()->notes() }}</td>
                    <td>{{ $message->present()->tags() }}</td>
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
            {!! $messages->appends(request()->query())->links() !!}
        </tbody>
    </table>
@stop