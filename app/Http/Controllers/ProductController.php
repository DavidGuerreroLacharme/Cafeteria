<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los productos y mostrarlos en una vista o como JSON, por ejemplo:
        $products = Product::with('category')->get();
//        return view('products.index', compact('products'));
        // Si prefieres retornar JSON:9
         return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario antes de guardarlos en la base de datos, por ejemplo:
        $request->validate([
            'name' => 'required|string',
            'reference' => 'required|string',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Crear un nuevo producto en la base de datos utilizando los datos del formulario:
        $product = Product::create($request->all());
        $product->load('category');
        // Redireccionar a la página de detalles del producto recién creado, por ejemplo:
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Mostrar la vista de detalles del producto o retornar los datos como JSON, por ejemplo:
        return view('products.show', compact('product'));
        // Si prefieres retornar JSON:
        // return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validar los datos del formulario antes de actualizarlos en la base de datos, por ejemplo:
        $request->validate([
            'name' => 'required|string',
            'reference' => 'required|string',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Actualizar el producto en la base de datos utilizando los datos del formulario:
        $product->update($request->all());
        $product->load('category');

        // Redireccionar a la página de detalles del producto actualizado, por ejemplo:
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Eliminar el producto de la base de datos:
        $product->delete();
        // Redireccionar a la página de listado de productos o a cualquier otra vista que prefieras:
        return response(null);
    }


    public function getMetric(): \Illuminate\Http\JsonResponse
    {
        // Obtener el producto con más stock
        $productStock = DB::select('CALL GetProductWithMostStock()');
        if ($productStock[0]?->id){
            $productStock = Product::query()->find($productStock[0]->id);
        }
        $productSold = DB::select('CALL GetMostSoldProduct()');
        if ($productSold[0]?->id){
            $sold = $productSold[0]?->total_quantity;
            $productSold = Product::query()->find($productSold[0]->id);
            $productSold['sold'] = $sold;
        }
        return response()->json([
            'productStock' => $productStock,
            'productSold' => $productSold,
        ]);
    }

}
