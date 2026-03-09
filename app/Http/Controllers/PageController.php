<?php

namespace App\Http\Controllers;

use App\Models\AlumniBatch;
use App\Models\Berita;
use App\Models\Faq;
use App\Models\Jadwal;
use App\Models\Leader;
use App\Models\OrganizationProfile;

class PageController extends Controller
{
    public function home()
    {
        $profile = OrganizationProfile::first();
        $beritas = Berita::latest()->take(3)->get();
        $jadwals = Jadwal::latest()->take(3)->get();
        $leaders = Leader::orderBy('order')->get();
        $faqs = Faq::orderBy('order')->get();
        
        return view('welcome', compact('beritas', 'jadwals', 'leaders', 'faqs', 'profile'));
    }

    public function structure()
    {
        $leaders = Leader::orderBy('order')->get();
        return view('pages.structure', compact('leaders'));
    }

    public function news()
    {
        $beritas = Berita::latest()->paginate(9);
        return view('pages.news', compact('beritas'));
    }

    public function schedule()
    {
        $jadwals = Jadwal::latest()->paginate(9);
        return view('pages.schedule', compact('jadwals'));
    }

    public function alumni()
    {
        $batches = AlumniBatch::with('members')->orderBy('year', 'desc')->get();
        return view('pages.alumni', compact('batches'));
    }
}
