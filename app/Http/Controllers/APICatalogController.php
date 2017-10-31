<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie as Movie;

class APICatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peliculas = Movie::all();
        return response()->json( Movie::all() );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }

        // Reglas para validación
        $rules = [
            'title' => 'required',
            'year' => 'required',
            'director' => 'required',
            'poster' => 'required',
            'synopsis' => 'required'
        ];

        try {

            // Ejecutamos el validador, en caso de que falle devolvemos la respuesta
            $validator = \Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }

            $pelicula = new Movie;
            $pelicula->title = $request->title;
            $pelicula->year = $request->year;
            $pelicula->director = $request->director;
            $pelicula->poster = $request->poster;

            if($request->synopsis != '' or !empty($request->synopsis)) {
                $pelicula->synopsis = $request->synopsis;
            }

            $pelicula->rented = false;
            $pelicula->save();
            
            return [
                'created' => true,
                'id_movie' => $pelicula->id,
                'msg'  => 'La pelicula fué creada satisfactoriamente.'
            ];

        } catch (Exception $e) {
            \Log::info('Error creating movie: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelicula = Movie::find($id);

        if(!$pelicula) {
            \Log::info('Error al buscar la película: '.$id. ', es inexistente o fué eliminada.');
            return response()->json(['error' => true, 'msg' => 'Registro no encontrado'], 404);
        }

        try {
            return response()->json($pelicula);
        } catch (Exception $e) {
            if($e instanceof ModelNotFoundException) {            
                \Log::info('Error al buscar una película: '.$e);
                return \Response::json(['search' => false], 500);
            }
        }

        //return response()->json($pelicula);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pelicula = Movie::find($id);

        if(!$pelicula) {
            \Log::info('Error al buscar la película: '.$id. ', es inexistente o fué eliminada.');
            return response()->json(['error' => true, 'msg' => 'Registro no encontrado'], 404);
        }

        if($request->title) $pelicula->title = $request->title;
        if($request->year) $pelicula->year = $request->year;
        if($request->director) $pelicula->director = $request->director;
        if($request->poster) $pelicula->poster = $request->poster;
        if($request->synopsis) $pelicula->synopsis = $request->synopsis;        
        $pelicula->save();

        return response()->json(['error' => false, 'msg' => 'La Pelicula se actualizó satisfactoriamente'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelicula = Movie::find($id);

        if(!$pelicula) {
            \Log::info('Error al buscar la película: '.$id. ', es inexistente o fué eliminada.');
            return response()->json(['error' => true, 'msg' => 'Registro no encontrado'], 404);
        }

        $pelicula->delete();

        return response()->json(['error' => false, 'msg' => 'La Pelicula fué eliminada satisfactoriamente.']);
    }

    /**
     * Update the rent in the movie to true
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function putRent($id)
    {
        $pelicula = Movie::find($id);

        if(!$pelicula) {
            \Log::info('Error al buscar la película: '.$id. ', es inexistente o fué eliminada.');
            return response()->json(['error' => true, 'msg' => 'Registro no encontrado'], 404);
        }

        $pelicula->rented = true;
        $pelicula->save();

        return response()->json(['error' => false, 'msg' => 'La Pelicula ha sido rentada.']);
    }

    /**
     * Update the rent in the movie to false
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function putReturn($id)
    {
        $pelicula = Movie::find($id);

        if(!$pelicula) {
            \Log::info('Error al buscar la película: '.$id. ', es inexistente o fué eliminada.');
            return response()->json(['error' => true, 'msg' => 'Registro no encontrado'], 404);
        }
        
        $pelicula->rented = false;
        $pelicula->save();

        return response()->json(['error' => false, 'msg' => 'La Pelicula ha sido devuelta satisfactoriamente.']);
    }
}
