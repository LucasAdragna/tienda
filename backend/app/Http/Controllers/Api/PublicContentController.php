<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;

class PublicContentController extends Controller
{
    public function rooms(): JsonResponse
    {
        $rooms = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->orderBy('id')
            ->get()
            ->map(function (Product $product): array {
                return [
                    'id' => (string) $product->id,
                    'name' => (string) $product->name,
                    'description' => (string) ($product->description ?? 'Habitacion disponible.'),
                    'capacity' => max(1, (int) $product->stock),
                    'pricePerNight' => (float) $product->price,
                    'image' => null,
                    'amenities' => array_values(array_filter([
                        $product->category?->name,
                    ])),
                ];
            })
            ->values();

        return response()->json([
            'data' => $rooms,
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
