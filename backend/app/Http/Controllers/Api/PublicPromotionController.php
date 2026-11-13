<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class PublicPromotionController extends Controller
{
    public function index(): JsonResponse
    {
        $promotion = Promotion::current()->latest('id')->first();

        $data = $promotion?->only([
            'id', 'title', 'description', 'cta_label', 'cta_url', 'starts_on', 'ends_on',
        ]);
        if ($promotion) {
            // only() returns Carbon attributes directly rather than applying model date serialization.
            $data['starts_on'] = $promotion->starts_on->format('Y-m-d');
            $data['ends_on'] = $promotion->ends_on->format('Y-m-d');
            $data['expires_at'] = Carbon::parse($promotion->ends_on->format('Y-m-d'), config('app.timezone'))
                ->addDay()->startOfDay()->toIso8601String();
        }

        return response()->json(['data' => $data])->header('Cache-Control', 'no-store');
    }
}
