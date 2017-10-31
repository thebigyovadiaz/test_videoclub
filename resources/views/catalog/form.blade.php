<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Título de la Película') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el titulo de la película']) !!}
    @if ($errors->has('title')) <span class="help-block text-danger">{{ $errors->first('title') }}</span> @endif
</div>

<div class="form-group {{ $errors->has('year') ? ' has-error' : '' }}">
    {!! Form::label('year', 'Año de la Película') !!}
    {!! Form::text('year', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el año de la película']) !!}
    @if ($errors->has('year')) <span class="help-block">{{ $errors->first('year') }}</span> @endif
</div>

<div class="form-group {{ $errors->has('director') ? ' has-error' : '' }}">
    {!! Form::label('director', 'Director de la Película') !!}
    {!! Form::text('director', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el director de la película']) !!}
    @if ($errors->has('director')) <span class="help-block">{{ $errors->first('director') }}</span> @endif
</div>

<div class="form-group {{ $errors->has('poster') ? ' has-error' : '' }}">
    {!! Form::label('poster', 'Poster de la Película') !!}
    {!! Form::text('poster', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la caratula de la película']) !!}
    @if ($errors->has('poster')) <span class="help-block">{{ $errors->first('poster') }}</span> @endif
</div>

<div class="form-group {{ $errors->has('synopsis') ? ' has-error' : '' }}">
    {!! Form::label('synopsis', 'Synopsis de la Película') !!}
    {!! Form::textarea('synopsis', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la synopsis de la película']) !!}
    @if ($errors->has('synopsis')) <span class="help-block">{{ $errors->first('synopsis') }}</span> @endif
</div>

<div class="form-group text-right">
    <a href="{{ url('/catalog') }}" class="btn btn-default">Regresar</a>
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>