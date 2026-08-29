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
        $categories = Category::orderBy('sort_order')->orderBy('name')->paginate(10);

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
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
            'is_visible' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['sort_order'] = $request->filled('sort_order')
            ? (int) $data['sort_order']
            : ((int) Category::max('sort_order')) + 1;
        $data['is_visible'] = $request->boolean('is_visible');
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
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
            'is_visible' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['sort_order'] = $request->filled('sort_order')
            ? (int) $data['sort_order']
            : $categoria->sort_order;
        $data['is_visible'] = $request->boolean('is_visible');
        $data['is_active'] = $request->boolean('is_active');

        $categoria->update($data);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria actualizada correctamente.');
    }

    public function destroy(Category $categoria): RedirectResponse
    {
        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria eliminada correctamente.');
    }

    public function toggleVisibility(Request $request, Category $categoria): RedirectResponse|\Illuminate\Http\JsonResponse
    {
        $categoria->update([
            'is_visible' => ! $categoria->is_visible,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'visible' => $categoria->is_visible,
                'label' => $categoria->is_visible ? 'Visible' : 'No visible',
                'symbol' => $categoria->is_visible ? '&#10003;' : '&#10005;',
            ]);
        }

        return redirect()->route('admin.categorias.index')->with('success', 'Visibilidad actualizada correctamente.');
    }
}
