<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;

class PublicSliderController extends Controller
{
    public function index(): JsonResponse
    {
        $sliders = Slider::query()
            ->where('s_visible', 1)
            ->where('s_activo', 1)
            ->orderBy('s_orden')
            ->get()
            ->map(function (Slider $slider): array {
                $imageUrl = str_starts_with($slider->s_imagen, 'http')
                    ? $slider->s_imagen
                    : asset('storage/' . ltrim($slider->s_imagen, '/'));

                return [
                    'id' => (int) $slider->s_id,
                    'title' => (string) $slider->s_titulo,
                    'text' => (string) $slider->s_texto,
                    'image' => $imageUrl,
                    'link' => (string) $slider->s_link,
                    'order' => (int) $slider->s_orden,
                ];
            })
            ->values();

        return response()->json([
            'data' => $sliders,
        ]);
    }
}
