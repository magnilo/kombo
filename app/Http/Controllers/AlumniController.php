<?php

namespace App\Http\Controllers;

use App\Models\AlumniBatch;
use App\Models\AlumniMember;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function __construct(
        private ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of alumni batches.
     */
    public function index()
    {
        $batches = AlumniBatch::with('members')
            ->orderBy('year', 'desc')
            ->get();

        return view('admin.alumni.index', compact('batches'));
    }

    /**
     * Store a new alumni batch.
     */
    public function storeBatch(Request $request)
    {
        $request->validate([
            'year' => 'required|string|unique:alumni_batches',
            'group_photo' => 'nullable|image|max:30720',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['year', 'description']);

        if ($request->hasFile('group_photo')) {
            $data['group_photo'] = $this->imageService->upload(
                $request->file('group_photo'),
                'alumni/groups'
            );
        }

        AlumniBatch::create($data);

        return back()->with('success', 'Angkatan alumni berhasil ditambahkan.');
    }

    /**
     * Update an existing alumni batch.
     */
    public function updateBatch(Request $request, AlumniBatch $batch)
    {
        $request->validate([
            'year' => 'required|string|unique:alumni_batches,year,' . $batch->id,
            'group_photo' => 'nullable|image|max:30720',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['year', 'description']);

        if ($request->hasFile('group_photo')) {
            $data['group_photo'] = $this->imageService->update(
                $request->file('group_photo'),
                $batch->group_photo,
                'alumni/groups'
            );
        }

        $batch->update($data);

        return back()->with('success', 'Angkatan alumni berhasil diperbarui.');
    }

    /**
     * Store a new alumni member.
     */
    public function storeMember(Request $request, AlumniBatch $batch)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string',
            'photo' => 'nullable|image|max:30720',
        ]);

        $data = [
            'alumni_batch_id' => $batch->id,
            'name' => $request->name,
            'position' => $request->position,
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->imageService->upload(
                $request->file('photo'),
                'alumni/members'
            );
        }

        AlumniMember::create($data);

        return back()->with('success', 'Alumni baru berhasil ditambahkan.');
    }

    /**
     * Delete an alumni batch and all its members.
     */
    public function destroyBatch(AlumniBatch $batch)
    {
        // Delete group photo
        $this->imageService->delete($batch->group_photo);

        // Delete all member photos
        foreach ($batch->members as $member) {
            $this->imageService->delete($member->photo);
        }

        $batch->delete();

        return back()->with('success', 'Angkatan berhasil dihapus.');
    }

    /**
     * Delete a single alumni member.
     */
    public function destroyMember(AlumniMember $member)
    {
        $this->imageService->delete($member->photo);
        $member->delete();

        return back()->with('success', 'Anggota berhasil dihapus.');
    }
}
