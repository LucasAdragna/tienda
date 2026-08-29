<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            's_imagen' => ['required', 'file', 'max:4096'],
            's_link' => ['required', 'string', 'max:100'],
            's_orden' => ['required', 'integer', 'min:0', 'max:999'],
            's_visible' => ['nullable', 'boolean'],
        ]);

        if ($redirect = $this->validateImageFile($request, 's_imagen')) {
            return $redirect;
        }

        $data['s_imagen'] = $this->storeImageFile($request->file('s_imagen'), 'sliders');
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
            's_imagen' => ['nullable', 'file', 'max:4096'],
            's_link' => ['required', 'string', 'max:100'],
            's_orden' => ['required', 'integer', 'min:0', 'max:999'],
            's_visible' => ['nullable', 'boolean'],
        ]);

        if ($redirect = $this->validateImageFile($request, 's_imagen')) {
            return $redirect;
        }

        if ($request->hasFile('s_imagen')) {
            $imagePath = storage_path('app/public/'.$slider->s_imagen);
            if ($slider->s_imagen && is_file($imagePath)) {
                @unlink($imagePath);
            }

            $data['s_imagen'] = $this->storeImageFile($request->file('s_imagen'), 'sliders');
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
        $imagePath = storage_path('app/public/'.$slider->s_imagen);
        if ($slider->s_imagen && is_file($imagePath)) {
            @unlink($imagePath);
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slide eliminado correctamente.');
    }

    private function validateImageFile(Request $request, string $field): ?RedirectResponse
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $image = $request->file($field);
        $extension = strtolower($image->getClientOriginalExtension());

        if (! in_array($extension, ['jpg', 'jpeg', 'png', 'webp'], true) || @getimagesize($image->getRealPath()) === false) {
            return back()
                ->withErrors([$field => 'Solo se permiten imagenes JPG, PNG o WEBP validas.'])
                ->withInput();
        }

        return null;
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
