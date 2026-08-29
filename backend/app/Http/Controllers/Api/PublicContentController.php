<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;

class PublicContentController extends Controller
{
    private function roomPayload(Product $product): array
    {
        $images = $product->images
            ->where('is_visible', true)
            ->map(function ($image) use ($product): array {
                $imageUrl = str_starts_with($image->path, 'http')
                    ? $image->path
                    : asset('storage/' . ltrim($image->path, '/'));

                return [
                    'src' => $imageUrl,
                    'alt' => (string) $product->name,
                ];
            })
            ->values();

        $firstImage = $images->first();

        return [
            'id' => (string) $product->id,
            'slug' => (string) $product->slug,
            'name' => (string) $product->name,
            'description' => (string) ($product->description ?? 'Habitacion disponible.'),
            'capacity' => max(1, (int) $product->stock),
            'pricePerNight' => (float) $product->price,
            'image' => $firstImage['src'] ?? null,
            'images' => $images,
            'amenities' => array_values(array_filter([
                $product->category?->name,
            ])),
        ];
    }

    public function rooms(): JsonResponse
    {
        $rooms = Product::query()
            ->with(['category', 'images'])
            ->where('is_active', true)
            ->where('is_visible', true)
            ->orderBy('id')
            ->get()
            ->map(function (Product $product): array {
                return $this->roomPayload($product);
            })
            ->values();

        return response()->json([
            'data' => $rooms,
        ]);
    }

    public function room(Product $product): JsonResponse
    {
        abort_unless($product->is_active && $product->is_visible, 404);

        $product->load(['category', 'images']);

        return response()->json([
            'data' => $this->roomPayload($product),
        ]);
    }

    public function amenities(): JsonResponse
    {
        $amenities = Category::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(function (Category $category): array {
                return [
                    'title' => (string) $category->name,
                    'description' => (string) ($category->description ?: 'Servicio disponible en el hotel.'),
                ];
            })
            ->values();

        return response()->json([
            'data' => $amenities,
        ]);
    }

    public function aboutUs(): JsonResponse
    {
        $aboutUs = AboutUs::query()
            ->where('so_activo', true)
            ->latest('so_id')
            ->first();

        if (! $aboutUs) {
            return response()->json(['data' => null]);
        }

        return response()->json([
            'data' => [
                'title' => (string) $aboutUs->so_titulo,
                'text' => (string) $aboutUs->so_texto,
                'image' => asset('storage/'.ltrim($aboutUs->so_imagen, '/')),
                'pdf' => asset('storage/'.ltrim($aboutUs->so_pdf, '/')),
            ],
        ]);
    }

    public function gallery(): JsonResponse
    {
        $gallery = Slider::query()
            ->where('s_visible', 1)
            ->where('s_activo', 1)
            ->orderBy('s_orden')
            ->take(6)
            ->get()
            ->map(function (Slider $slider): array {
                $imageUrl = str_starts_with($slider->s_imagen, 'http')
                    ? $slider->s_imagen
                    : asset('storage/' . ltrim($slider->s_imagen, '/'));

                return [
                    'src' => $imageUrl,
                    'alt' => (string) $slider->s_titulo,
                ];
            })
            ->values();

        return response()->json([
            'data' => $gallery,
        ]);
    }
}
