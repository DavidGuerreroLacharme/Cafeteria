<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las ventas y mostrarlas en una vista o como JSON, por ejemplo:
        $sells = Sell::all();
        return view('sells.index', compact('sells'));
        // Si prefieres retornar JSON:
        // return response()->json($sells);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario antes de guardarlos en la base de datos, por ejemplo:
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ]);

        // Crear una nueva venta en la base de datos utilizando los datos del formulario:
        $sell = Sell::create($request->all());

        // Redireccionar a la página de detalles de la venta recién creada, por ejemplo:
        return response()->json($sell, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sell $sell)
    {
        // Mostrar la vista de detalles de la venta o retornar los datos como JSON, por ejemplo:
        return view('sells.show', compact('sell'));
        // Si prefieres retornar JSON:
        // return response()->json($sell);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sell $sell)
    {
        // Validar los datos del formulario antes de actualizarlos en la base de datos, por ejemplo:
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric',
        ]);

        // Actualizar la venta en la base de datos utilizando los datos del formulario:
        $sell->update($request->all());

        // Redireccionar a la página de detalles de la venta actualizada, por ejemplo:
        return redirect()->route('sells.show', $sell->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sell $sell)
    {
        // Eliminar la venta de la base de datos:
        $sell->delete();

        // Redireccionar a la página de listado de ventas o a cualquier otra vista que prefieras:
        return redirect()->route('sells.index');
    }
}
