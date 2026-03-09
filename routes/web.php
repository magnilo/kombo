<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\OrganizationProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/struktur-organisasi', [PageController::class, 'structure'])->name('pages.structure');
Route::get('/berita-kegiatan', [PageController::class, 'news'])->name('pages.news');
Route::get('/jadwal-kegiatan', [PageController::class, 'schedule'])->name('pages.schedule');
Route::get('/alumni-kombo', [PageController::class, 'alumni'])->name('pages.alumni');
Route::get('/divisi', [RegistrationController::class, 'divisions'])->name('pages.divisions');

// Public Registration Routes
Route::get('/pendaftaran', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('/pendaftaran', [RegistrationController::class, 'store'])->name('registration.store');

// Public News Detail (slug-based)
Route::get('/berita/{berita:slug}', [BeritaController::class, 'show'])->name('berita.show');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Berita & Jadwal Resources
    Route::resource('berita', BeritaController::class)->except('show')->parameters(['berita' => 'berita']);
    Route::resource('jadwal', JadwalController::class);

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    // Organization Profile
    Route::get('/organization', [OrganizationProfileController::class, 'edit'])->name('organization.edit');
    Route::patch('/organization', [OrganizationProfileController::class, 'update'])->name('organization.update');

    // Leaders Management
    Route::get('/leaders/bulk', [LeaderController::class, 'createBulk'])->name('leaders.bulk.create');
    Route::post('/leaders/bulk', [LeaderController::class, 'storeBulk'])->name('leaders.bulk.store');
    Route::get('/leaders/history', [LeaderController::class, 'history'])->name('leaders.history');
    Route::patch('/leaders/{leader}/archive', [LeaderController::class, 'archive'])->name('leaders.archive');
    Route::patch('/leaders/{leader}/restore', [LeaderController::class, 'restore'])->name('leaders.restore');
    Route::resource('leaders', LeaderController::class);

    // Alumni Management
    Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
    Route::post('/alumni-batch', [AlumniController::class, 'storeBatch'])->name('alumni.batch.store');
    Route::patch('/alumni-batch/{batch}', [AlumniController::class, 'updateBatch'])->name('alumni.batch.update');
    Route::delete('/alumni-batch/{batch}', [AlumniController::class, 'destroyBatch'])->name('alumni.batch.destroy');
    Route::post('/alumni-batch/{batch}/member', [AlumniController::class, 'storeMember'])->name('alumni.member.store');
    Route::delete('/alumni-member/{member}', [AlumniController::class, 'destroyMember'])->name('alumni.member.destroy');

    // FAQ Management
    Route::resource('faqs', FaqController::class);

    // Division Management
    Route::resource('divisions', DivisionController::class);

    // Registration Management
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::get('/registrations/export', [RegistrationController::class, 'export'])->name('registrations.export');
});

/*
|--------------------------------------------------------------------------
| Utility Routes (Development/Deployment Helpers)
|--------------------------------------------------------------------------
| These routes should be removed or protected in production
*/

Route::get('/run-migrate', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    return "[OK] Migrasi berhasil.";
});

Route::get('/run-optimize', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return "[OK] Cache berhasil dibersihkan.";
});

Route::get('/run-link', function () {
    $targetPath = storage_path('app/public');
    $linkPath = public_path('storage');

    if (file_exists($linkPath)) {
        return "[OK] Folder /storage sudah ada di hosting.";
    }

    if (symlink($targetPath, $linkPath)) {
        return "[OK] Storage link berhasil dibuat.";
    }

    return "[ERROR] Gagal membuat link. Coba hapus folder 'storage' di 'public_html' lalu jalankan lagi.";
});

Route::get('/run-fix-vite', function () {
    $hotFile = public_path('hot');
    if (file_exists($hotFile)) {
        unlink($hotFile);
        return "[OK] File 'hot' berhasil dihapus.";
    }
    return "[INFO] File 'hot' tidak ditemukan. Sudah aman.";
});

Route::get('/run-env-fix', function () {
    $envPath = base_path('.env');
    if (file_exists($envPath)) {
        $content = file_get_contents($envPath);
        $content = preg_replace('/APP_URL=.*/', 'APP_URL=https://kombo.siface.my.id', $content);
        $content = preg_replace('/APP_ENV=.*/', 'APP_ENV=production', $content);
        $content = preg_replace('/APP_DEBUG=.*/', 'APP_DEBUG=false', $content);
        file_put_contents($envPath, $content);
        return "[OK] .env berhasil diupdate ke production.";
    }
    return "[ERROR] .env tidak ditemukan.";
});

Route::get('/run-git-pull', function () {
    try {
        $output = shell_exec('git pull origin main 2>&1');
        return "<pre>HASIL GIT PULL:\n\n$output</pre>";
    } catch (\Exception $e) {
        return "ERROR GIT: " . $e->getMessage();
    }
});

Route::get('/check-db', function () {
    try {
        $tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
        return response()->json($tables);
    } catch (\Exception $e) {
        return "ERROR DB: " . $e->getMessage();
    }
});

require __DIR__ . '/auth.php';
