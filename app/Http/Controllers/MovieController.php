<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    //
    public function index(){
        $movies = Movie::all();
        return response()->json($movies);
    }

    public function show($id){
        $movie = Movie::find($id);
        if (!$movie){
            return response()->json(['message' => 'Pelicula no encontrada'], 404);
        }
        return response()->json($movie);
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string|max:255',
            'year' => 'required|integer',
            'cover' => 'required|string|max:255',
        ]);

        $movie = Movie::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'year' => $request->year,
            'cover' => $request->cover,
        ]);

        return response()->json($movie,201);
    }

    public function update(Request $request, $id){
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Pelicula no encontrada'], 404);
        }
    
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'synopsis' => 'sometimes|string|max:255',
            'year' => 'sometimes|integer',
            'cover' => 'sometimes|string|max:255',
        ]);
    
        $movie->update($request->all());
    
        return response()->json($movie, 201);
    }
    
    public function destroy($id){
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Pelicula no encontrada'], 404);
        }
    
        $movie->delete();
    
        return response()->json(['message' => 'Pelicula eliminada correctamente']);
    }

}

