<?php

namespace App\Http\Controllers;

use App\Models\Leader;
use Illuminate\Http\Request;

class LeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaders = Leader::where('is_active', true)->orderBy('order')->get();
        $groupedLeaders = $leaders->groupBy('division');
        
        $pastPeriods = Leader::where('is_active', false)->distinct()->pluck('period');
        
        return view('admin.leaders.index', compact('leaders', 'groupedLeaders', 'pastPeriods'));
    }

    public function create()
    {
        return view('admin.leaders.form');
    }

    public function createBulk()
    {
        return view('admin.leaders.bulk-create');
    }

    public function storeBulk(Request $request)
    {
        $request->validate([
            'members.*.name' => 'required|string|max:255',
            'members.*.position' => 'required|string|max:255',
            'members.*.division' => 'nullable|string|max:255',
            'members.*.period' => 'nullable|string|max:255',
            'members.*.batch' => 'nullable|string|max:255',
            'members.*.photo' => 'nullable|image|max:2048',
            'members.*.order' => 'required|integer',
        ]);

        foreach ($request->members as $index => $member) {
            if (!empty($member['name'])) {
                $data = $member;
                
                // Handle photo upload if exists in current row
                if ($request->hasFile("members.{$index}.photo")) {
                    $data['photo'] = $request->file("members.{$index}.photo")->store('leaders', 'public');
                }

                Leader::create($data);
            }
        }

        return redirect()->route('leaders.index')->with('success', 'Massal: Pengurus berhasil ditambahkan.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'division' => 'nullable|string|max:255',
            'period' => 'nullable|string|max:255',
            'batch' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'order' => 'required|integer',
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('leaders', 'public');
        }

        Leader::create($data);
        return redirect()->route('leaders.index')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function edit(Leader $leader)
    {
        return view('admin.leaders.form', compact('leader'));
    }

    public function update(Request $request, Leader $leader)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'division' => 'nullable|string|max:255',
            'period' => 'nullable|string|max:255',
            'batch' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            if ($leader->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($leader->photo);
            }
            $data['photo'] = $request->file('photo')->store('leaders', 'public');
        }

        $leader->update($data);
        return redirect()->route('leaders.index')->with('success', 'Pengurus berhasil diperbarui.');
    }

    public function destroy(Leader $leader)
    {
        if ($leader->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($leader->photo);
        }
        $leader->delete();
        return redirect()->route('leaders.index')->with('success', 'Pengurus berhasil dihapus.');
    }

    public function archive(Leader $leader)
    {
        $leader->update(['is_active' => false]);
        return redirect()->route('leaders.index')->with('success', 'Pengurus telah diarsipkan ke Sejarah.');
    }

    public function restore(Leader $leader)
    {
        $leader->update(['is_active' => true]);
        return redirect()->route('leaders.index')->with('success', 'Pengurus telah diaktifkan kembali.');
    }

    public function history()
    {
        $pastLeaders = Leader::where('is_active', false)->orderBy('period', 'desc')->orderBy('order')->get()->groupBy('period');
        return view('admin.leaders.history', compact('pastLeaders'));
    }
}
