<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jadwal;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = Jadwal::latest()->get();
        return view('jadwal.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwal.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'division' => 'nullable|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/jadwal', 'public');
        }

        Jadwal::create([
            'title' => $request->title,
            'division' => $request->division,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        return view('jadwal.form', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'title' => 'required',
            'division' => 'nullable|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/jadwal', 'public');
            $jadwal->image = $imagePath;
        }

        $jadwal->title = $request->title;
        $jadwal->division = $request->division;
        $jadwal->date = $request->date;
        $jadwal->time = $request->time;
        $jadwal->location = $request->location;
        $jadwal->description = $request->description;
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
}
