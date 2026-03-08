<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\OrganizationProfile::create([
            'name' => 'KOMBO',
            'slogan' => 'Komunitas Mahasiswa Bondowoso',
            'history' => 'Berdiri sejak lama untuk mewadahi aspirasi mahasiswa Bondowoso di Politeknik Negeri Jember.',
            'philosophy' => 'Kegotongroyongan dan kemajuan bersama untuk Bondowoso yang lebih baik.',
            'vision' => 'Menjadi pusat kolaborasi mahasiswa yang berdampak nyata.',
            'mission' => "Membangun jejaring alumni mahasiswa\nMengadakan bimbingan masuk perguruan tinggi\nBerkolaborasi dengan pemerintah daerah",
            'registration_link' => 'https://forms.gle/example',
            'contact_phone' => '+628123456789',
            'contact_email' => 'kombopolije@gmail.com',
            'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.123456789!2d113.823456!3d-7.9!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNTQnMDAuMCJTIDExM8KwNDknMjQuNCJF!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
        ]);

        $leaders = [
            ['name' => 'Ahmad Fauzi', 'position' => 'Ketua Umum', 'division' => null, 'order' => 1],
            ['name' => 'Siti Aminah', 'position' => 'Wakil Ketua Umum', 'division' => null, 'order' => 2],
            
            ['name' => 'Budi Santoso', 'position' => 'Koordinator', 'division' => 'PSDM', 'order' => 3],
            ['name' => 'Laila Sari', 'position' => 'Sekretaris', 'division' => 'PSDM', 'order' => 4],
            
            ['name' => 'Reza Pahlevi', 'position' => 'Koordinator', 'division' => 'Humas', 'order' => 5],
            ['name' => 'Dewi Persik', 'position' => 'Anggota', 'division' => 'Humas', 'order' => 6],
            
            ['name' => 'Andi Wijaya', 'position' => 'Koordinator', 'division' => 'Kominfo', 'order' => 7],
            ['name' => 'Rina Rosiana', 'position' => 'Anggota', 'division' => 'Kominfo', 'order' => 8],
            
            ['name' => 'Eko Prasetyo', 'position' => 'Koordinator', 'division' => 'KWU', 'order' => 9],
            ['name' => 'Maya Sofia', 'position' => 'Bendahara', 'division' => 'KWU', 'order' => 10],
        ];

        foreach ($leaders as $leader) {
            \App\Models\Leader::create($leader);
        }

        \App\Models\Faq::create([
            'question' => 'Bagaimana cara bergabung?',
            'answer' => 'Silakan klik tombol daftar di halaman utama atau hubungi admin.',
            'order' => 1
        ]);

        $prokers = [
            ['title' => 'Latihan Dasar Kepemimpinan', 'division' => 'PSDM', 'date' => now()->addDays(5), 'time' => '08:00', 'location' => 'Aula Gedung J', 'description' => 'Membangun jiwa kepemimpinan anggota baru.'],
            ['title' => 'Workshop Jurnalistik', 'division' => 'Kominfo', 'date' => now()->addDays(10), 'time' => '09:00', 'location' => 'Lab Komputer', 'description' => 'Meningkatkan skill penulisan berita.'],
            ['title' => 'Kombo Creative Market', 'division' => 'KWU', 'date' => now()->addDays(15), 'time' => '10:00', 'location' => 'Taman Polije', 'description' => 'Pameran produk wirausaha mahasiswa.'],
            ['title' => 'Kunjungan Ke Humas Pemkab', 'division' => 'Humas', 'date' => now()->addDays(20), 'time' => '08:30', 'location' => 'Kantor Pemkab', 'description' => 'Diskusi kolaborasi strategis dengan daerah.'],
        ];

        foreach ($prokers as $proker) {
            \App\Models\Jadwal::create($proker);
        }
    }
}
