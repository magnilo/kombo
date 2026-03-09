<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use App\Models\Berita;
use App\Services\ImageUploadService;

class BeritaController extends Controller
{
    public function __construct(
        private ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('berita.index', compact('beritas'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        return view('berita.show', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('berita.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBeritaRequest $request)
    {
        $validated = $request->validated();

        $data = [
            'title' => $validated['title'],
            'slug' => Berita::generateSlug($validated['title']),
            'content' => $validated['content'],
            'image' => $request->hasFile('image') 
                ? $this->imageService->upload($request->file('image'), 'images')
                : null,
        ];

        Berita::create($data);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        return view('berita.form', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBeritaRequest $request, Berita $berita)
    {
        $validated = $request->validated();

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageService->update(
                $request->file('image'),
                $berita->image,
                'images'
            );
        }

        $berita->update($data);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        $this->imageService->delete($berita->image);
        $berita->delete();

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil dihapus');
    }
}
