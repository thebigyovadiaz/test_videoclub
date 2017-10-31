@extends('layouts.master')

@section('title') Editar una Película | Video Club S.A @endsection

@section('content')
    <div class="row" style="margin-top:20px">
      <div class="col-md-offset-3 col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading" style="background-color:rgba(170, 212, 226, 0.4);font-weight:600;font-size:16px;">
            <h3 class="panel-title text-center">
              <span class="glyphicon glyphicon-film" aria-hidden="true"></span>
              Editar Película
            </h3>
          </div>

          <div class="panel-body" style="padding:30px">

            {!! Form::model($pelicula, ['action' => ['CatalogController@putEdit', $pelicula->id], 'method' => 'PUT']) !!}

                @include('catalog.form')

            {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div> 
@stop