@extends('layout')

@section('content')
    <h1>Login</h1>
    <form action="/login" method="POST" class="form-inline">
        @csrf
        <input class="form-control" placeholder="email" type="email" name="email">
        <input class="form-control" placeholder="password" type="password" name="password">
        <input type="submit" value="Entrar" class="btn btn-primary">
    </form>
@stop