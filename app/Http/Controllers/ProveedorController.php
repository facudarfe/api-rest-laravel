<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Producto;
use Exception;
use Illuminate\Support\Facades\Log;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return response()->json(['status' => 'success', 'data' => $proveedores], 200);
    }

    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return response()->json(['status' => 'error', 'message' => 'Proveedor no encontrado'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $proveedor], 200);
    }

    public function store(Request $request)
    {
        try{
            $proveedor = Proveedor::create($request->all());

            return response()->json(['status' => 'success', 'data' => $proveedor], 201);
        }
        catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error al crear el proveedor'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return response()->json(['status' => 'error', 'message' => 'Proveedor no encontrado'], 404);
        }

        try{
            $proveedor->fill($request->all());
            $proveedor->update();

            return response()->json(['status' => 'success', 'data' => $proveedor], 200);
        }
        catch(Exception $e){
            return response()->json(['status' => 'error', 'message' => 'Error al actualizar el proveedor'], 500);
        }

    }

    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return response()->json(['status' => 'error', 'message' => 'Proveedor no encontrado'], 404);
        }
        $proveedor->delete();
        return response()->json(['status' => 'success', 'message' => 'Proveedor eliminado'], 204);
    }

    public function productos($id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return response()->json(['status' => 'error', 'message' => 'Proveedor no encontrado'], 404);
        }
        $productos = $proveedor->productos;

        foreach ($productos as $producto) {
            $producto->cantidad = $producto->pivot->cantidad;
        }

        if(!$productos){
            return response()->json(['status' => 'error', 'message' => 'No hay productos para este proveedor'], 404);
        }
        else
            return response()->json(['status' => 'success', 'data' => $productos], 200);
    }

    public function addProduct(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return response()->json(['status' => 'error', 'message' => 'Proveedor no encontrado'], 404);
        }

        $producto = Producto::find($request->producto_id);
        if (!$producto) {
            return response()->json(['status' => 'error', 'message' => 'Producto no encontrado'], 404);
        }

        $producto = $proveedor->productos()->attach($request->producto_id, ['cantidad' => $request->cantidad]);

        return response()->json(['status' => 'success', 'data' => $producto], 201);
    }
}
