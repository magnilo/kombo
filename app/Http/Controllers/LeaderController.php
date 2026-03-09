<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaderRequest;
use App\Http\Requests\UpdateLeaderRequest;
use App\Models\Leader;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class LeaderController extends Controller
{
    public function __construct(
        private ImageUploadService $imageService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaders = Leader::active()->ordered()->get();
        $groupedLeaders = $leaders->groupBy('division');
        $pastPeriods = Leader::archived()->distinct()->pluck('period');

        return view('admin.leaders.index', compact('leaders', 'groupedLeaders', 'pastPeriods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.leaders.form');
    }

    /**
     * Show the form for bulk creation.
     */
    public function createBulk()
    {
        return view('admin.leaders.bulk-create');
    }

    /**
     * Store multiple leaders at once.
     */
    public function storeBulk(Request $request)
    {
        // Increase execution time for bulk upload
        @ini_set('max_execution_time', 300);
        @ini_set('max_input_time', 300);

        $request->validate([
            'members.*.name' => 'required|string|max:255',
            'members.*.position' => 'required|string|max:255',
            'members.*.division' => 'nullable|string|max:255',
            'members.*.period' => 'nullable|string|max:255',
            'members.*.batch' => 'nullable|string|max:255',
            'members.*.photo' => 'nullable|image|max:20480',
            'members.*.order' => 'required|integer',
        ]);

        foreach ($request->members as $index => $member) {
            if (!empty($member['name'])) {
                $data = $member;

                if ($request->hasFile("members.{$index}.photo")) {
                    $data['photo'] = $this->imageService->upload(
                        $request->file("members.{$index}.photo"),
                        'leaders'
                    );
                }

                Leader::create($data);
            }
        }

        return redirect()
            ->route('leaders.index')
            ->with('success', 'Pengurus berhasil ditambahkan secara massal.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaderRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->imageService->upload(
                $request->file('photo'),
                'leaders'
            );
        }

        Leader::create($data);

        return redirect()
            ->route('leaders.index')
            ->with('success', 'Pengurus berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leader $leader)
    {
        return view('admin.leaders.form', compact('leader'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaderRequest $request, Leader $leader)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->imageService->update(
                $request->file('photo'),
                $leader->photo,
                'leaders'
            );
        }

        $leader->update($data);

        return redirect()
            ->route('leaders.index')
            ->with('success', 'Pengurus berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leader $leader)
    {
        $this->imageService->delete($leader->photo);
        $leader->delete();

        return redirect()
            ->route('leaders.index')
            ->with('success', 'Pengurus berhasil dihapus.');
    }

    /**
     * Archive a leader (set as inactive).
     */
    public function archive(Leader $leader)
    {
        $leader->update(['is_active' => false]);

        return redirect()
            ->route('leaders.index')
            ->with('success', 'Pengurus telah diarsipkan ke Sejarah.');
    }

    /**
     * Restore an archived leader (set as active).
     */
    public function restore(Leader $leader)
    {
        $leader->update(['is_active' => true]);

        return redirect()
            ->route('leaders.index')
            ->with('success', 'Pengurus telah diaktifkan kembali.');
    }

    /**
     * Display archived leaders history.
     */
    public function history()
    {
        $pastLeaders = Leader::archived()
            ->orderBy('period', 'desc')
            ->orderBy('order')
            ->get()
            ->groupBy('period');

        return view('admin.leaders.history', compact('pastLeaders'));
    }
}
