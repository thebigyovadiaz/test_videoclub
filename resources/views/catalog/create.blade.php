@extends('layouts.master')

@section('title') Agregar una Película | Video Club S.A @endsection

@section('content')
  	<div class="row" style="margin-top:20px">
      <div class="col-md-offset-3 col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading" style="background-color:rgba(170, 212, 226, 0.4);font-weight:600;font-size:16px;">
            <h3 class="panel-title text-center">
              <span class="glyphicon glyphicon-film" aria-hidden="true"></span>
              Añadir Película
            </h3>
          </div>

          <div class="panel-body" style="padding:30px">

            {!! Form::open(['action' => 'CatalogController@postCreate', 'method' => 'POST']) !!}

                @include('catalog.form')

            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
@stop