<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')->latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'categories' => Category::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = $this->generateUniqueSlug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        Product::create($data);

        return redirect()->route('admin.productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Product $producto): View
    {
        return view('admin.products.edit', [
            'product' => $producto,
            'categories' => Category::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $producto): RedirectResponse
    {
        $data = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($producto->name !== $data['name']) {
            $data['slug'] = $this->generateUniqueSlug($data['name'], $producto->id);
        }

        $data['is_active'] = $request->boolean('is_active');

        $producto->update($data);

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $producto): RedirectResponse
    {
        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (
            Product::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
