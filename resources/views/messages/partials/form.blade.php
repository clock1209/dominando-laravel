@csrf
@unless ($message->user_id)
    <p>
        <label for="nombre">Nombre:
            <input type="text" name="nombre" value="{{ $message->nombre or old('nombre') }}" class="form-control">
            {!! $errors->first('nombre', '<span class=error>:message</span>') !!}
        </label>
    </p>
    <p>
        <label for="email">Email:
            <input type="email" name="email" value="{{ $message->email or old('email') }}" class="form-control">
            {!! $errors->first('email', '<span class=error>:message</span>') !!}
        </label>
    </p>
@endunless
<p>
    <label for="mensaje">Mensaje:
        <textarea name="mensaje" class="form-control">{{ $message->mensaje or old('mensaje') }}</textarea>
        {!! $errors->first('mensaje', '<span class=error>:message</span>') !!}
    </label>
</p>
<p>
    <input type="submit" value="{{ $btnTxt or 'Guardar' }}" class="btn btn-primary">
</p>