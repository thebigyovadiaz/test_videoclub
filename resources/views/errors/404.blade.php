@extends('layouts.master')

@section('title') Error 404 | VideoClub S.A @endsection

@section('content')
    <div class="container">
        <div class="jumbotron text-center">
            <h1>Page Not Found <small><font face="Tahoma" color="red">Error 404</font></small></h1>
            <br />
            <p>The page you requested could not be found, either contact your webmaster or try again. Use your browsers <b>Back</b> button to navigate to the page you have prevously come from</p>
            <p><b>Or you could just press this neat little button:</b></p>
            <a href="{{ url('/catalog') }}" class="btn btn-large btn-info"><span class="glyphicon glyphicon-home"></span> Back to Home</a>
        </div>
    </div>
@endsection