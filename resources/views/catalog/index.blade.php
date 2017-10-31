@extends('layouts.master')

@section('title') Listado de Películas | Video Club S.A @endsection

@section('content')
    <div class="row">
        @foreach($peliculas as $key => $pelicula)
        <div class="col-xs-6 col-sm-4 col-md-3 text-center">
            
            <a href="{{ url('/catalog/show/' . $pelicula['id']) }}">
                <img src="{{ $pelicula['poster'] }}" class="img-rounded" style="height:200px;box-shadow:0 0 5px #000;" />
                <h4 style="min-height:45px;margin:5px 0 10px 0;">
                    {{ $pelicula['title'] }}
                </h4>
            </a>

        </div>
        @endforeach
    </div>
@stop