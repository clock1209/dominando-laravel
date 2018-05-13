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
                    @if ($message->user_id)
                        <td>{{ $message->id }}</td>
                        <td><a href="{{ route('users.show', $message->user->id) }}">{{ $message->user->name }}</a></td>
                        <td>{{ $message->user->email }}</td>
                    @else
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->nombre }}</td>
                        <td>{{ $message->email }}</td>
                    @endif
                    <td><a href="{{ route('messages.show', $message->id) }}">{{ str_limit($message->mensaje, 30, ' ...') }}</a></td>
                    <td>{!! $message->note->body or '<span class="badge badge-secondary">no tiene</span>' !!}</td>
                    <td>{!! !$message->tags->isEmpty() ? $message->implodeTags() : '<span class="badge badge-secondary">no tiene</span>' !!}</td>
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