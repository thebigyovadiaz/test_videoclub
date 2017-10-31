@extends('layouts.master')

@section('title') Detalles de la Película | Video Club S.A @endsection

@section('content')
    <div class="row">
        <div class="col-sm-4 text-center">
            {{-- Insertamos la Imagen --}}
            <img src="{{ $pelicula['poster'] }}" class="img-rounded" title="{{ $pelicula['title'] }}" alt="{{ $pelicula['title'] }}" />
        </div>
        <div class="col-sm-8">
            <h1>{{ $pelicula['title'] }}</h1>
            <h4>Año: {{ $pelicula['year'] }}</h4>
            <h4>Director: {{ $pelicula['director'] }}</h4>

            <br>

            <p class="text-justify">
                <strong>Resumen:</strong> {{ $pelicula['synopsis'] }}

                <br><br>

                <strong>Estado:</strong> @if($pelicula['rented']) Película actualmente alquilada @else Película disponible @endif

            </p>

            <br>

            <div class="">
                <a href="{{ url('/catalog') }}" class="btn btn-default">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Volver al listado
                </a>
                
                <div class="btn-group">
                @if($pelicula['rented'])
                    <form action="{{ action('CatalogController@putReturn', $pelicula['id']) }}"
                     method="POST">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>
                            Devolver película
                        </button>
                    </form>
                @else
                    <form action="{{ action('CatalogController@putRent', $pelicula['id']) }}"
                     method="POST">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>
                            Alquilar película
                        </button>
                    </form>
                @endif
                </div>

                <a href="{{ url('/catalog/edit/' . $pelicula['id']) }}" class="btn btn-warning">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar película
                </a>

                <div class="btn-group">
                <form action="{{ action('CatalogController@deleteMovie', $pelicula['id']) }}"
                    method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        Eliminar película
                    </button>
                </form>
                </div>
            </div>
        </div>
    </div>
@stop