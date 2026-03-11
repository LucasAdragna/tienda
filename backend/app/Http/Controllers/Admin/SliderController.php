<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SliderController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::query()
            ->orderBy('s_orden')
            ->orderByDesc('s_id')
            ->paginate(10);

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create(): View
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            's_titulo' => ['required', 'string', 'max:100'],
            's_texto' => ['required', 'string'],
            's_imagen' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            's_link' => ['required', 'string', 'max:100'],
            's_orden' => ['required', 'integer', 'min:0', 'max:999'],
            's_visible' => ['nullable', 'boolean'],
        ]);

        $data['s_imagen'] = $request->file('s_imagen')->store('sliders', 'public');
        $data['s_tag'] = 0;
        $data['s_visible'] = $request->boolean('s_visible') ? 1 : 0;
        $data['s_activo'] = 1;

        Slider::create($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slide creado correctamente.');
    }

    public function edit(Slider $slider): View
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider): RedirectResponse
    {
        $data = $request->validate([
            's_titulo' => ['required', 'string', 'max:100'],
            's_texto' => ['required', 'string'],
            's_imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            's_link' => ['required', 'string', 'max:100'],
            's_orden' => ['required', 'integer', 'min:0', 'max:999'],
            's_visible' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('s_imagen')) {
            if ($slider->s_imagen && Storage::disk('public')->exists($slider->s_imagen)) {
                Storage::disk('public')->delete($slider->s_imagen);
            }

            $data['s_imagen'] = $request->file('s_imagen')->store('sliders', 'public');
        } else {
            unset($data['s_imagen']);
        }

        $data['s_tag'] = 0;
        $data['s_visible'] = $request->boolean('s_visible') ? 1 : 0;
        $data['s_activo'] = 1;

        $slider->update($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slide actualizado correctamente.');
    }

    public function destroy(Slider $slider): RedirectResponse
    {
        if ($slider->s_imagen && Storage::disk('public')->exists($slider->s_imagen)) {
            Storage::disk('public')->delete($slider->s_imagen);
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slide eliminado correctamente.');
    }
}
