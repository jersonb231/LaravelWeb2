<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Http\Response;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //consultar todos los registro que exiten en la tabla categorias
        return Categoria::query()
        ->withCount('productos')
        ->OrdeBy('id','desc')
        ->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar la data que nos envia el cliente
        $data = $request->validate([
            'nombre'=> 'required|string|max:255|unique:categorias,nombre',
            'descripcion'=>'nullable|string|',
            'activa' => 'boolean'
        ]);

        //agregar el registro en la base de dato
        $categoria =Categoria::create($data);

        //devolver una respuesta
        return response()->json($categoria, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
        return $categoria->load('productos');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Categoria $categoria)
    {
        //
        $data = $request ->validate([
            'nombre'=> 'sometimes|required|string|max:255|unique:categorias,nombre', $categoria->id,
            'descripcion'=> 'nullable|string',
            'activa'=>'boolean'
        ]);

        $categoria->update($data);

        return reponse()->json($categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
        $categoria->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
