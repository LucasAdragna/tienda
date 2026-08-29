<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AboutUsController extends Controller
{
    public function index(): View
    {
        return view('admin.about-us.index', [
            'aboutEntries' => AboutUs::query()->orderByDesc('so_id')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.about-us.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request, true);
        $data['so_imagen'] = $this->storeFile($request->file('so_imagen'), 'about-us/images');
        $data['so_pdf'] = $this->storeFile($request->file('so_pdf'), 'about-us/documents');
        $data['so_activo'] = $request->boolean('so_activo');

        $this->deactivateOtherEntriesWhenActive($data['so_activo']);
        AboutUs::create($data);

        return redirect()->route('admin.sobre-nosotros.index')->with('success', 'Contenido "Sobre nosotros" creado correctamente.');
    }

    public function edit(AboutUs $aboutUs): View
    {
        return view('admin.about-us.edit', compact('aboutUs'));
    }

    public function update(Request $request, AboutUs $aboutUs): RedirectResponse
    {
        $data = $this->validatedData($request, false);

        if ($request->hasFile('so_imagen')) {
            $this->deleteFile($aboutUs->so_imagen);
            $data['so_imagen'] = $this->storeFile($request->file('so_imagen'), 'about-us/images');
        }

        if ($request->hasFile('so_pdf')) {
            $this->deleteFile($aboutUs->so_pdf);
            $data['so_pdf'] = $this->storeFile($request->file('so_pdf'), 'about-us/documents');
        }

        $data['so_activo'] = $request->boolean('so_activo');
        $this->deactivateOtherEntriesWhenActive($data['so_activo'], $aboutUs->so_id);
        $aboutUs->update($data);

        return redirect()->route('admin.sobre-nosotros.index')->with('success', 'Contenido "Sobre nosotros" actualizado correctamente.');
    }

    public function destroy(AboutUs $aboutUs): RedirectResponse
    {
        $this->deleteFile($aboutUs->so_imagen);
        $this->deleteFile($aboutUs->so_pdf);
        $aboutUs->delete();

        return redirect()->route('admin.sobre-nosotros.index')->with('success', 'Contenido "Sobre nosotros" eliminado correctamente.');
    }

    private function validatedData(Request $request, bool $isCreating): array
    {
        return $request->validate([
            'so_titulo' => ['required', 'string', 'max:150'],
            'so_texto' => ['required', 'string', 'max:150'],
            'so_imagen' => [$isCreating ? 'required' : 'nullable', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'so_pdf' => [$isCreating ? 'required' : 'nullable', 'file', 'mimes:pdf', 'max:10240'],
            'so_activo' => ['nullable', 'boolean'],
        ]);
    }

    private function deactivateOtherEntriesWhenActive(bool $isActive, ?int $exceptId = null): void
    {
        if (! $isActive) {
            return;
        }

        AboutUs::query()
            ->when($exceptId, fn ($query) => $query->where('so_id', '!=', $exceptId))
            ->update(['so_activo' => false]);
    }

    private function storeFile($file, string $directory): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = Str::uuid().'.'.$extension;
        $targetDirectory = storage_path('app/public/'.$directory);

        if (! is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        $file->move($targetDirectory, $filename);

        return $directory.'/'.$filename;
    }

    private function deleteFile(?string $path): void
    {
        if (! $path) {
            return;
        }

        $filePath = storage_path('app/public/'.$path);

        if (is_file($filePath)) {
            @unlink($filePath);
        }
    }
}
