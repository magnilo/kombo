<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Division;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    // Public: Show registration form
    public function create()
    {
        $divisions = Division::orderBy('order')->get();
        return view('pages.registration', compact('divisions'));
    }

    // Public: Store registration
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'domisili' => 'required|string|max:255',
            'campus' => 'required|string|in:Kampus Pusat,Kampus 2 Bondowoso',
            'division_id' => 'required|exists:divisions,id',
        ]);

        Registration::create($request->all());

        return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim! Kami akan segera menghubungi Anda.');
    }

    // Admin: List registrations
    public function index()
    {
        $registrations = Registration::with('division')->latest()->paginate(20);
        return view('admin.registrations.index', compact('registrations'));
    }

    // Admin: Export registrations to Excel
    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\RegistrationsExport, 'pendaftaran_kombo_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    // Public: Show divisions info
    public function divisions()
    {
        $divisions = Division::orderBy('order')->get();
        return view('pages.divisions', compact('divisions'));
    }
}
