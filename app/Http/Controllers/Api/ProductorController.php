<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Http\Response;   

class ProductorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //consultar todos los registro que exiten en la tabla Productos
        return Producto::query()
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
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|string|max:255|unique:productos,nombre',
            'codigo' => 'required|string|max:50|unique:productos,codigo',
            'precio' => 'required|numeric|decimal:2|min:0',
            'stock' => 'required|integer|min:0',
            'activo' => 'boolean'
            
        
        ]);
        //agregar el registro en la base de dato
        $producto =Producto::create($data);

        //devolver una respuesta
        return response()->json($producto, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
     public function show(Producto $producto) 
    {
    return response()->json($producto);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
        $data = $request->validate([
        'categoria_id' => 'sometimes|required|exists:categorias,id',
        'nombre' => 'sometimes|required|string|max:255|unique:productos,nombre,' . $producto->id,
        'codigo' => 'sometimes|required|string|max:50|unique:productos,codigo,' . $producto->id,
        'precio' => 'sometimes|required|numeric|decimal:2|min:0',
        'stock' => 'sometimes|required|integer|min:0',
        'activo' => 'sometimes|boolean',
        
    ]);

    $producto->update($data);

    return response()->json($producto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
    // Elimina el producto
    $producto->delete();

    // Respuesta 204 (sin contenido, exitoso)
    return response()->json(null, \Illuminate\Http\Response::HTTP_NO_CONTENT);
    }

}
