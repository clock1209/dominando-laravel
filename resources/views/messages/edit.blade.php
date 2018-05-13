@extends('layout')

@section('content')
    <h1>Editar Mensaje</h1>
    @if (session()->has('info'))
        <h3>{{ session('info') }}</h3>
    @else
        <form method="POST" action="{{ route('messages.update', $message->id) }}">
            @method('PUT')
            @includeIf('messages.partials.form', [
                'btnTxt' => 'Actualizar',
                'showFields' => !$message->user_id,
            ])
        </form>
    @endif
@stop