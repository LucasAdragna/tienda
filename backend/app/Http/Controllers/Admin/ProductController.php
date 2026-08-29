<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with(['category', 'images'])
            ->where('is_active', true)
            ->latest()
            ->paginate(10);

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
            'is_visible' => ['nullable', 'boolean'],
            'images' => ['nullable', 'array', 'max:12'],
            'images.*' => ['file', 'max:4096'],
        ]);

        if ($redirect = $this->validateImageFiles($request, 'images')) {
            return $redirect;
        }

        $data['slug'] = $this->generateUniqueSlug($data['name']);
        $data['is_active'] = true;
        $data['is_visible'] = $request->boolean('is_visible');
        unset($data['images']);

        $product = Product::create($data);
        $this->storeImages($request, $product);

        return redirect()->route('admin.productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Product $producto): View
    {
        $producto->load('images');

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
            'is_visible' => ['nullable', 'boolean'],
            'images' => ['nullable', 'array', 'max:12'],
            'images.*' => ['file', 'max:4096'],
            'image_order' => ['nullable', 'array'],
            'image_order.*' => ['integer', 'min:0', 'max:999'],
            'visible_images' => ['nullable', 'array'],
            'visible_images.*' => ['integer', 'exists:product_images,id'],
            'delete_images' => ['nullable', 'array'],
            'delete_images.*' => ['integer', 'exists:product_images,id'],
        ]);

        if ($redirect = $this->validateImageFiles($request, 'images')) {
            return $redirect;
        }

        if ($producto->name !== $data['name']) {
            $data['slug'] = $this->generateUniqueSlug($data['name'], $producto->id);
        }

        $data['is_visible'] = $request->boolean('is_visible');
        unset($data['images'], $data['image_order'], $data['visible_images'], $data['delete_images']);

        $producto->update($data);
        $this->syncImageOrder($request, $producto);
        $this->syncImageVisibility($request, $producto);
        $this->deleteImages($request, $producto);
        $this->storeImages($request, $producto);

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $producto): RedirectResponse
    {
        $producto->update(['is_active' => false]);

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function toggleVisibility(Request $request, Product $producto): RedirectResponse|JsonResponse
    {
        $producto->update([
            'is_visible' => ! $producto->is_visible,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'visible' => $producto->is_visible,
                'label' => $producto->is_visible ? 'Visible' : 'No visible',
                'symbol' => $producto->is_visible ? '&#10003;' : '&#10005;',
            ]);
        }

        return redirect()->route('admin.productos.index')->with('success', 'Visibilidad actualizada correctamente.');
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

    private function storeImages(Request $request, Product $product): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        $nextOrder = ((int) $product->images()->max('sort_order')) + 1;

        foreach ($request->file('images') as $image) {
            $product->images()->create([
                'path' => $this->storeImageFile($image, 'products'),
                'sort_order' => $nextOrder,
                'is_visible' => true,
                'is_active' => true,
            ]);

            $nextOrder++;
        }
    }

    private function validateImageFiles(Request $request, string $field): ?RedirectResponse
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        foreach ($request->file($field) as $image) {
            $extension = strtolower($image->getClientOriginalExtension());

            if (! in_array($extension, ['jpg', 'jpeg', 'png', 'webp'], true) || @getimagesize($image->getRealPath()) === false) {
                return back()
                    ->withErrors([$field => 'Solo se permiten imagenes JPG, PNG o WEBP validas.'])
                    ->withInput();
            }
        }

        return null;
    }

    private function syncImageOrder(Request $request, Product $product): void
    {
        $orders = $request->input('image_order', []);

        foreach ($orders as $imageId => $sortOrder) {
            ProductImage::query()
                ->where('product_id', $product->id)
                ->where('id', $imageId)
                ->update(['sort_order' => (int) $sortOrder]);
        }
    }

    private function deleteImages(Request $request, Product $product): void
    {
        $imageIds = $request->input('delete_images', []);

        if ($imageIds === []) {
            return;
        }

        ProductImage::query()
            ->where('product_id', $product->id)
            ->whereIn('id', $imageIds)
            ->update(['is_active' => false]);
    }

    private function syncImageVisibility(Request $request, Product $product): void
    {
        $visibleImageIds = array_map('intval', $request->input('visible_images', []));

        ProductImage::query()
            ->where('product_id', $product->id)
            ->where('is_active', true)
            ->update(['is_visible' => false]);

        if ($visibleImageIds === []) {
            return;
        }

        ProductImage::query()
            ->where('product_id', $product->id)
            ->whereIn('id', $visibleImageIds)
            ->where('is_active', true)
            ->update(['is_visible' => true]);
    }

    private function deleteImageFile(ProductImage $image): void
    {
        $filePath = storage_path('app/public/'.$image->path);

        if ($image->path && is_file($filePath)) {
            @unlink($filePath);
        }
    }

    private function storeImageFile($image, string $directory): string
    {
        $extension = strtolower($image->getClientOriginalExtension());
        $filename = Str::uuid().'.'.$extension;
        $targetDirectory = storage_path('app/public/'.$directory);

        if (! is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        $image->move($targetDirectory, $filename);

        return $directory.'/'.$filename;
    }
}
