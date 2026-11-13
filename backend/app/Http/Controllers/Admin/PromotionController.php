<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PromotionController extends Controller
{
    public function index(): View
    {
        return view('admin.promotions.index', ['promotions' => Promotion::latest('id')->paginate(10)]);
    }

    public function create(): View
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Promotion::create($this->validated($request));

        return redirect()->route('admin.promociones.index')->with('success', 'Promoción creada correctamente.');
    }

    public function edit(Promotion $promotion): View
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion): RedirectResponse
    {
        $promotion->update($this->validated($request));

        return redirect()->route('admin.promociones.index')->with('success', 'Promoción actualizada correctamente.');
    }

    public function destroy(Promotion $promotion): RedirectResponse
    {
        $promotion->delete();

        return redirect()->route('admin.promociones.index')->with('success', 'Promoción eliminada correctamente.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:500'],
            'cta_label' => ['required', 'string', 'max:60'],
            'cta_url' => ['required', 'string', 'max:500', function (string $attribute, mixed $value, Closure $fail): void {
                $hasUnsafeCharacters = preg_match('/[\\x00-\\x20\\x7f\\\\]/', $value);
                $internal = str_starts_with($value, '/') && ! str_starts_with($value, '//');
                $external = filter_var($value, FILTER_VALIDATE_URL)
                    && in_array(strtolower(parse_url($value, PHP_URL_SCHEME) ?? ''), ['http', 'https'], true);
                if ($hasUnsafeCharacters || (! $internal && ! $external)) {
                    $fail('Usá una ruta interna (por ejemplo /reservas) o una URL http/https válida.');
                }
            }],
            'starts_on' => ['required', 'date_format:Y-m-d'],
            'ends_on' => ['required', 'date_format:Y-m-d', 'after_or_equal:starts_on'],
            'is_active' => ['sometimes', 'boolean'],
        ]);
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
