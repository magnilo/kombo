<?php

namespace App\Http\Controllers;

use App\Exports\RegistrationsExport;
use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Division;
use App\Models\Registration;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationController extends Controller
{
    /**
     * Public: Show registration form
     */
    public function create()
    {
        $divisions = Division::ordered()->get();
        return view('pages.registration', compact('divisions'));
    }

    /**
     * Public: Store registration
     */
    public function store(StoreRegistrationRequest $request)
    {
        Registration::create($request->validated());

        return redirect()
            ->back()
            ->with('success', 'Pendaftaran berhasil dikirim! Kami akan segera menghubungi Anda.');
    }

    /**
     * Admin: List registrations
     */
    public function index()
    {
        $registrations = Registration::with('division')
            ->latest()
            ->paginate(20);

        return view('admin.registrations.index', compact('registrations'));
    }

    /**
     * Admin: Export registrations to Excel
     */
    public function export()
    {
        $filename = 'pendaftaran_kombo_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new RegistrationsExport, $filename);
    }

    /**
     * Public: Show divisions info
     */
    public function divisions()
    {
        $divisions = Division::ordered()->get();
        return view('pages.divisions', compact('divisions'));
    }
}
