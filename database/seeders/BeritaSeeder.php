<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $beritas = [
            [
                'title' => 'KOMBO Sukses Mengadakan Workshop Leadership 2026',
                'content' => 'Alumni KOMBO berkumpul dalam workshop yang membahas strategi kepemimpinan modern. Acara yang berlangsung selama 2 hari ini menghadirkan pembicara-pembicara terkemuka dari berbagai industri. Peserta mendapat insight berharga tentang bagaimana memimpin tim di era digital.',
            ],
            [
                'title' => 'Peluncuran Program Beasiswa KOMBO Batch 2026',
                'content' => 'KOMBO dengan bangga mengumumkan peluncuran program beasiswa untuk generasi muda Indonesia. Program ini dirancang khusus untuk memberikan kesempatan kepada talenta-talenta terbaik untuk mengembangkan potensi mereka. Pendaftaran sudah dibuka mulai bulan Januari 2026.',
            ],
            [
                'title' => 'Ekspansi Divisi Teknologi KOMBO di Kawasan Timur',
                'content' => 'Sebagai bagian dari rencana pengembangan jangka panjang, KOMBO membuka kantor cabang baru di kawasan Timur Indonesia. Divisi Teknologi akan menjadi fokus utama dengan merekrut 50 profesional muda berpotensial. Diharapkan ekspansi ini dapat membawa dampak positif bagi ekonomi lokal.',
            ],
            [
                'title' => 'Kolaborasi Strategis KOMBO dengan Universitas Terkemuka',
                'content' => 'KOMBO menandatangani Memorandum of Understanding dengan lima universitas terkemuka di Indonesia. Kolaborasi ini bertujuan untuk mengembangkan kurikulum yang relevan dengan kebutuhan industri modern. Melalui partnership ini, mahasiswa akan mendapatkan akses ke magang dan networking opportunities yang lebih baik.',
            ],
            [
                'title' => 'Prestasi Membanggakan: Alumni KOMBO Raih Penghargaan Internasional',
                'content' => 'Dua alumni KOMBO berhasil meraih penghargaan di ajang kompetisi startup internasional yang bergengsi. Mereka mempresentasikan solusi inovatif dalam bidang sustainable technology yang mendapat apresiasi dari panel juri internasional. Prestasi ini membuktikan kualitas sumber daya manusia yang dihasilkan oleh KOMBO.',
            ],
            [
                'title' => 'Launching Platform Digital Hub KOMBO Edisi 2026',
                'content' => 'Platform digital baru KOMBO hadir dengan fitur-fitur canggih yang memudahkan komunikasi antar komunitas. Hub digital ini dilengkapi dengan tools kolaborasi, knowledge sharing, dan mentoring online. Member bisa terhubung dengan lebih mudah dan berbagi pengalaman dari mana saja.',
            ],
            [
                'title' => 'KOMBO Community Summit 2026: Gathering of Innovation',
                'content' => 'Acara tahunan KOMBO kembali hadir dengan tema "Gathering of Innovation". Event tiga hari ini akan menghadirkan lebih dari 100 pembicara dari berbagai bidang industri. Peserta akan mendapat insight tentang tren terbaru dan networking opportunities dengan para leader di berbagai sektor.',
            ],
            [
                'title' => 'Program Mentoring One-on-One KOMBO Dibuka untuk Generasi Muda',
                'content' => 'Dalam upaya memberdayakan generasi muda, KOMBO membuka program mentoring eksklusif satu-satu dengan para mentor berpengalaman. Program ini mencakup career guidance, skill development, dan personal branding coaching. Peserta akan mendapat dukungan penuh dalam mengembangkan karir mereka.',
            ],
        ];

        foreach ($beritas as $berita) {
            Berita::create([
                'title' => $berita['title'],
                'slug' => Str::slug($berita['title']) . '-' . Str::random(5),
                'content' => $berita['content'],
                'image' => null,
            ]);
        }
    }
}
