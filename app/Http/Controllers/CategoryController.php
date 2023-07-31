<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las categorías y mostrarlas en una vista o como JSON, por ejemplo:
        $categories = Category::all();
//        return view('categories.index', compact('categories'));
        // Si prefieres retornar JSON:
         return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario antes de guardarlos en la base de datos, por ejemplo:
        $validate = $request->validate([
            'name' => 'required|string',
            // Agrega aquí más reglas de validación si es necesario
        ]);
        $validate['slug'] = Str::slug($validate['name']);
        // Crear una nueva categoría en la base de datos utilizando los datos del formulario:
        $category = Category::create($validate);

        // Redireccionar a la página de detalles de la categoría recién creada, por ejemplo:
        return redirect()->route('categories.show', $category->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Mostrar la vista de detalles de la categoría o retornar los datos como JSON, por ejemplo:
        return view('categories.show', compact('category'));
        // Si prefieres retornar JSON:
        // return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validar los datos del formulario antes de actualizarlos en la base de datos, por ejemplo:
        $validate = $request->validate([
            'name' => 'required|string',
            // Agrega aquí más reglas de validación si es necesario
        ]);
        $validate['slug'] = Str::slug($validate['name']);
        // Actualizar la categoría en la base de datos utilizando los datos del formulario:
        $category->update($validate);

        // Redireccionar a la página de detalles de la categoría actualizada, por ejemplo:
        return redirect()->route('categories.show', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Eliminar la categoría de la base de datos:
        $category->delete();

        // Redireccionar a la página de listado de categorías o a cualquier otra vista que prefieras:
        return redirect()->route('categories.index');
    }
}
