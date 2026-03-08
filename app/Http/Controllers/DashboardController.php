<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Jadwal;
use App\Models\Leader;

class DashboardController extends Controller
{
    public function index()
    {
        $countBerita = Berita::count();
        $countJadwal = Jadwal::count();
        $countLeader = Leader::count();
        $countAlumni = \App\Models\AlumniMember::count();
        $countRegistration = \App\Models\Registration::count();
        
        $recentBeritas = Berita::latest()->take(5)->get();
        $recentJadwals = Jadwal::latest()->take(5)->get();
        $recentRegistrations = \App\Models\Registration::with('division')->latest()->take(5)->get();

        return view('dashboard', compact(
            'countBerita', 
            'countJadwal', 
            'countLeader', 
            'countAlumni', 
            'countRegistration',
            'recentBeritas', 
            'recentJadwals',
            'recentRegistrations'
        ));
    }
}
