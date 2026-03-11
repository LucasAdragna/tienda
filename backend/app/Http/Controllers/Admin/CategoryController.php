<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:categories,name'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        Category::create($data);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria creada correctamente.');
    }

    public function edit(Category $categoria): View
    {
        return view('admin.categories.edit', ['category' => $categoria]);
    }

    public function update(Request $request, Category $categoria): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:categories,name,' . $categoria->id],
            'description' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $categoria->update($data);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria actualizada correctamente.');
    }

    public function destroy(Category $categoria): RedirectResponse
    {
        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria eliminada correctamente.');
    }
}
