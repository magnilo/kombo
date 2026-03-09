<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDivisionRequest;
use App\Http\Requests\UpdateDivisionRequest;
use App\Models\Division;

class DivisionController extends Controller
{
    /**
     * Display a listing of divisions.
     */
    public function index()
    {
        $divisions = Division::ordered()->get();
        return view('admin.divisions.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new division.
     */
    public function create()
    {
        return view('admin.divisions.create');
    }

    /**
     * Store a newly created division.
     */
    public function store(StoreDivisionRequest $request)
    {
        Division::create($request->validated());

        return redirect()
            ->route('divisions.index')
            ->with('success', 'Divisi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing a division.
     */
    public function edit(Division $division)
    {
        return view('admin.divisions.edit', compact('division'));
    }

    /**
     * Update the specified division.
     */
    public function update(UpdateDivisionRequest $request, Division $division)
    {
        $division->update($request->validated());

        return redirect()
            ->route('divisions.index')
            ->with('success', 'Divisi berhasil diperbarui.');
    }

    /**
     * Remove the specified division.
     */
    public function destroy(Division $division)
    {
        $division->delete();

        return redirect()
            ->route('divisions.index')
            ->with('success', 'Divisi berhasil dihapus.');
    }
}
