@csrf
<p>
    <label for="nombre">Nombre:
        <input type="text" class="form-control" name="name" value="{{ $user->name or old('name')}}">
        {!! $errors->first('name', '<span class=error>:message</span>') !!}
    </label>
</p>
<p>
    <label for="email">Email:
        <input type="email" class="form-control" name="email" value="{{ $user->email or old('email')}}">
        {!! $errors->first('email', '<span class=error>:message</span>') !!}
    </label>
</p>
@unless ($user->id)
    <p>
        <label for="password">Contraseña:
            <input type="password" class="form-control" name="password">
            {!! $errors->first('password', '<span class=error>:message</span>') !!}
        </label>
    </p>
    <p>
        <label for="password_confirmation">Confirmar contraseña:
            <input type="password" class="form-control" name="password_confirmation">
            {!! $errors->first('password_confirmation', '<span class=error>:message</span>') !!}
        </label>
    </p>
@endunless
@foreach ($roles as $id => $role)
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" value="{{ $id }}" name="roles[]" {{ $user->roles->contains($id) ? 'checked' : '' }}>{{ $role }}
        </label>
    </div>
@endforeach
{!! $errors->first('roles', '<span class=error>:message</span>') !!}
<br>