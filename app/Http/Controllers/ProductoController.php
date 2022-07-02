<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Exception;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return response()->json(['status' => 'success', 'data' => $productos], 200);
    }
    
    public function store(Request $request)
    {
        try{
            $producto = Producto::create($request->all());
    
            return response()->json(['status' => 'success', 'data' => $producto], 201);
        }
        catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error al crear el producto'], 500);
        }
    }
    
    public function show($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['status' => 'error', 'message' => 'Producto no encontrado'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $producto], 200);
    }
    
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['status' => 'error', 'message' => 'Producto no encontrado'], 404);
        }
    
        try{
            $producto->fill($request->all());
            $producto->update();
    
            return response()->json(['status' => 'success', 'data' => $producto], 200);
        }
        catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error al actualizar el producto'], 500);
        }
    
    }
    
    public function destroy($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['status' => 'error', 'message' => 'Producto no encontrado'], 404);
        }
    
        try{
            $producto->delete();
            return response()->json(['status' => 'success', 'message' => 'Producto eliminado'], 200);
        }
        catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error al eliminar el producto'], 500);
        }
    
    }
}
