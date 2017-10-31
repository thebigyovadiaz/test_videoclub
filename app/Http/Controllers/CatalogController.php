<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie as Movie;
use Notification;

class CatalogController extends Controller {
    
    // Función que muestra listado de catalogo de películas
    public function getIndex() {
        $peliculas = Movie::all();
        return view('catalog.index', array('peliculas' => $peliculas));
    }

    // Función que muestra formulario para crear nueva pelicula
    public function getCreate() {
        return view('catalog.create');
    }

    // Función que permite guardar la nueva pelicula
    public function postCreate(Request $request) {

        $validator = \Validator::make($request->all(), [
            'title' => 'required|min:10|max:255',
            'year' => 'required|max:4|min:4',
            'director' => 'required|min:3',
            'poster' => 'required|min:10',
            'synopsis' => 'required|min:20',
        ]);

        if ($validator->fails()) {
            return redirect('catalog/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {

            $pelicula = new Movie;
            $pelicula->title = $request->title;
            $pelicula->year = $request->year;
            $pelicula->director = $request->director;
            $pelicula->poster = $request->poster;
            $pelicula->synopsis = $request->synopsis;
            $pelicula->rented = false;
            $pelicula->save();

            return view('catalog.show', compact('pelicula'));
        }
    }

    // Función que muestra el detalle de una película
    public function getShow($id) {
        $pelicula = Movie::findOrFail($id);

        if(!$pelicula) {
            \Log::info('Error al buscar la película: '.$id. ', es inexistente o fué eliminada.');
            return view('errors.404');
        }

        return view('catalog.show', compact('pelicula'));
    }

    // Función que muestra formulario para crear nueva pelicula
    public function getEdit($id) {
        $pelicula = Movie::find($id);
        
        if(!$pelicula) {
            \Log::info('Error al buscar la película: '.$id. ', es inexistente o fué eliminada.');
            return view('errors.404');
        }

        return view('catalog.edit', compact('pelicula'));
    }

    // Función que permite la edición de una película
    public function putEdit(Request $request, $id) {
        
        $validator = \Validator::make($request->all(), [
            'title' => 'required|min:10|max:255',
            'year' => 'required|max:4|min:4',
            'director' => 'required|min:3',
            'poster' => 'required|min:10',
            'synopsis' => 'required|min:20',
        ]);

        if ($validator->fails()) {
            return redirect('catalog/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        } else {

            $pelicula = Movie::find($id);
            $pelicula->title = $request->title;
            $pelicula->year = $request->year;
            $pelicula->director = $request->director;
            $pelicula->poster = $request->poster;
            $pelicula->synopsis = $request->synopsis;        
            $pelicula->save();

            return view('catalog.show', compact('pelicula'));
        }
    }

    // Función que permite actualizar el campo rented de pelicula
    public function putRent($id) {
        $pelicula = Movie::find($id);
        
        if(!$pelicula) {
            \Log::info('Error al buscar la película: '.$id. ', es inexistente o fué eliminada.');
            return view('errors.404');
        }

        $pelicula->rented = true;
        $pelicula->save();

        return view('catalog.show', compact('pelicula'));
    }

    // Función que permite actualizar el campo rented de pelicula
    public function putReturn($id) {
        $pelicula = Movie::find($id);

        if(!$pelicula) {
            return view('errors.404');
        }

        $pelicula->rented = false;
        $pelicula->save();

        return view('catalog.show', compact('pelicula'));
    }

    // Función que permite eliminar una pelicula
    public function deleteMovie($id) {
        $pelicula = Movie::find($id);
        
        if(!$pelicula) {
            \Log::info('Error al buscar la película: '.$id. ', es inexistente o fué eliminada.');
            return view('errors.404');
        }

        $pelicula->delete();

        Notification::error('Película eliminada satisfactoriamente.');
        return redirect('/catalog');
    }

}
