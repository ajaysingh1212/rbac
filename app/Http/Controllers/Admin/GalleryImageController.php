<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryImageController extends Controller
{
    public function index(): View
    {
        Gate::authorize('gallery-list');

        return view('admin.gallery-images.index', [
            'images' => GalleryImage::query()
                ->orderBy('sort_order')
                ->orderByDesc('id')
                ->paginate(18),
        ]);
    }

    public function create(): View
    {
        Gate::authorize('gallery-create');

        return view('admin.gallery-images.create', [
            'image' => new GalleryImage(['is_active' => true]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('gallery-create');

        $validated = $request->validate([
            'image' => ['required', 'image', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $galleryImage = GalleryImage::create([
            'image_path' => $request->file('image')->store('advocated/gallery', 'public'),
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.gallery-images.index')
            ->with('success', 'Gallery image #'.$galleryImage->id.' created successfully.');
    }

    public function edit(GalleryImage $galleryImage): View
    {
        Gate::authorize('gallery-edit');

        return view('admin.gallery-images.edit', [
            'image' => $galleryImage,
        ]);
    }

    public function update(Request $request, GalleryImage $galleryImage): RedirectResponse
    {
        Gate::authorize('gallery-edit');

        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($galleryImage->image_path && Storage::disk('public')->exists($galleryImage->image_path)) {
                Storage::disk('public')->delete($galleryImage->image_path);
            }

            $galleryImage->image_path = $request->file('image')->store('advocated/gallery', 'public');
        }

        $galleryImage->sort_order = (int) ($validated['sort_order'] ?? 0);
        $galleryImage->is_active = $request->boolean('is_active');
        $galleryImage->save();

        return redirect()
            ->route('admin.gallery-images.index')
            ->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(GalleryImage $galleryImage): RedirectResponse
    {
        Gate::authorize('gallery-delete');

        if ($galleryImage->image_path && Storage::disk('public')->exists($galleryImage->image_path)) {
            Storage::disk('public')->delete($galleryImage->image_path);
        }

        $galleryImage->delete();

        return back()->with('success', 'Gallery image deleted successfully.');
    }
}
