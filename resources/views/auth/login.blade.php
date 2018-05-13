@extends('layout')

@section('content')
    <h1>Login</h1>
    <form action="/login" method="POST" class="form-inline">
        @csrf
        <input class="form-control" placeholder="email" type="email" name="email">
        {!! $errors->first('email', '<span class=error>:message</span>') !!}
        <input class="form-control" placeholder="password" type="password" name="password">
        {!! $errors->first('password', '<span class=error>:message</span>') !!}
        <input type="submit" value="Entrar" class="btn btn-primary">
    </form>
@stop