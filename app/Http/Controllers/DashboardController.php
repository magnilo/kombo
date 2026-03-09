<?php

namespace App\Http\Controllers;

use App\Models\AlumniMember;
use App\Models\Berita;
use App\Models\Jadwal;
use App\Models\Leader;
use App\Models\Registration;

class DashboardController extends Controller
{
    public function index()
    {
        // Auto fix for Vite styles being broken on hosting
        $hotFile = public_path('hot');
        if (file_exists($hotFile)) {
            @unlink($hotFile);
        }

        // Get statistics
        $stats = [
            'berita' => Berita::count(),
            'jadwal' => Jadwal::count(),
            'leader' => Leader::count(),
            'alumni' => AlumniMember::count(),
            'registration' => Registration::count(),
        ];

        // Get recent data
        $recentBeritas = Berita::latest()->take(5)->get();
        $recentJadwals = Jadwal::latest()->take(5)->get();
        $recentRegistrations = Registration::with('division')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentBeritas', 'recentJadwals', 'recentRegistrations'));
    }
}
