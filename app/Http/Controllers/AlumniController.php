<?php

namespace App\Http\Controllers;

use App\Models\AlumniBatch;
use App\Models\AlumniMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index()
    {
        $batches = AlumniBatch::with('members')->orderBy('year', 'desc')->get();
        return view('admin.alumni.index', compact('batches'));
    }

    public function storeBatch(Request $request)
    {
        $request->validate([
            'year' => 'required|string|unique:alumni_batches',
            'group_photo' => 'nullable|image|max:30720', // 30MB
            'description' => 'nullable|string',
        ]);

        try {
            $data = $request->only(['year', 'description']);
            if ($request->hasFile('group_photo')) {
                $data['group_photo'] = $request->file('group_photo')->store('alumni/groups', 'public');
            }

            AlumniBatch::create($data);
            return back()->with('success', 'Angkatan alumni berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal simpan: ' . $e->getMessage()]);
        }
    }

    public function storeMember(Request $request, AlumniBatch $batch)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string',
            'photo' => 'nullable|image|max:30720', // 30MB
        ]);

        $data = $request->only(['name', 'position']);
        $data['alumni_batch_id'] = $batch->id;
        
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('alumni/members', 'public');
        }

        AlumniMember::create($data);
        return back()->with('success', 'Alumni baru berhasil ditambahkan.');
    }

    public function destroyBatch(AlumniBatch $batch)
    {
        if ($batch->group_photo) Storage::disk('public')->delete($batch->group_photo);
        foreach($batch->members as $member) {
            if ($member->photo) Storage::disk('public')->delete($member->photo);
        }
        $batch->delete();
        return back()->with('success', 'Angkatan berhasil dihapus.');
    }

    public function destroyMember(AlumniMember $member)
    {
        if ($member->photo) Storage::disk('public')->delete($member->photo);
        $member->delete();
        return back()->with('success', 'Anggota berhasil dihapus.');
    }
}
