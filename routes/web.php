<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DivisionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $profile = \App\Models\OrganizationProfile::first();
    $beritas = \App\Models\Berita::latest()->take(3)->get();
    $jadwals = \App\Models\Jadwal::latest()->take(3)->get();
    $leaders = \App\Models\Leader::orderBy('order')->get();
    $faqs = \App\Models\Faq::orderBy('order')->get();
    return view('welcome', compact('beritas', 'jadwals', 'leaders', 'faqs', 'profile'));
})->name('home');


Route::get('/struktur-organisasi', function() {
    $leaders = \App\Models\Leader::orderBy('order')->get();
    return view('pages.structure', compact('leaders'));
})->name('pages.structure');

Route::get('/berita-kegiatan', function() {
    $beritas = \App\Models\Berita::latest()->paginate(9);
    return view('pages.news', compact('beritas'));
})->name('pages.news');

Route::get('/jadwal-kegiatan', function() {
    $jadwals = \App\Models\Jadwal::latest()->paginate(9);
    return view('pages.schedule', compact('jadwals'));
})->name('pages.schedule');

Route::get('/alumni-kombo', function() {
    $batches = \App\Models\AlumniBatch::with('members')->orderBy('year', 'desc')->get();
    return view('pages.alumni', compact('batches'));
})->name('pages.alumni');

Route::get('/pendaftaran', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('/pendaftaran', [RegistrationController::class, 'store'])->name('registration.store');
Route::get('/divisi', [RegistrationController::class, 'divisions'])->name('pages.divisions');




Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('berita', \App\Http\Controllers\BeritaController::class)
    ->middleware(['auth', 'verified'])
    ->parameters(['berita' => 'berita']);

Route::resource('jadwal', \App\Http\Controllers\JadwalController::class)
    ->middleware(['auth', 'verified']);

Route::get('/berita/{berita:slug}', [\App\Http\Controllers\BeritaController::class, 'show'])->name('berita.show');

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/organization', [\App\Http\Controllers\OrganizationProfileController::class, 'edit'])->name('organization.edit');
    Route::patch('/organization', [\App\Http\Controllers\OrganizationProfileController::class, 'update'])->name('organization.update');
    
    Route::get('/leaders/bulk', [\App\Http\Controllers\LeaderController::class, 'createBulk'])->name('leaders.bulk.create');
    Route::post('/leaders/bulk', [\App\Http\Controllers\LeaderController::class, 'storeBulk'])->name('leaders.bulk.store');
    Route::get('/leaders/history', [\App\Http\Controllers\LeaderController::class, 'history'])->name('leaders.history');
    Route::patch('/leaders/{leader}/archive', [\App\Http\Controllers\LeaderController::class, 'archive'])->name('leaders.archive');
    Route::patch('/leaders/{leader}/restore', [\App\Http\Controllers\LeaderController::class, 'restore'])->name('leaders.restore');
    Route::resource('leaders', \App\Http\Controllers\LeaderController::class);
    
    Route::get('/alumni', [\App\Http\Controllers\AlumniController::class, 'index'])->name('alumni.index');
    Route::post('/alumni-batch', [\App\Http\Controllers\AlumniController::class, 'storeBatch'])->name('alumni.batch.store');
    Route::patch('/alumni-batch/{batch}', [\App\Http\Controllers\AlumniController::class, 'updateBatch'])->name('alumni.batch.update');
    Route::delete('/alumni-batch/{batch}', [\App\Http\Controllers\AlumniController::class, 'destroyBatch'])->name('alumni.batch.destroy');
    Route::post('/alumni-batch/{batch}/member', [\App\Http\Controllers\AlumniController::class, 'storeMember'])->name('alumni.member.store');
    Route::delete('/alumni-member/{member}', [\App\Http\Controllers\AlumniController::class, 'destroyMember'])->name('alumni.member.destroy');
    
    Route::resource('faqs', \App\Http\Controllers\FaqController::class);

    Route::resource('divisions', DivisionController::class);
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::get('/registrations/export', [RegistrationController::class, 'export'])->name('registrations.export');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
