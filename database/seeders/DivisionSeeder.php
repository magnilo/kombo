<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = [
            [
                'name' => 'PSDM',
                'description' => 'Pengembangan Sumber Daya Manusia - Fokus pada pengembangan talenta, pelatihan anggota, dan program pengembangan kepemimpinan untuk memastikan organisasi memiliki SDM berkualitas.',
                'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM15 20H9m6 0H9m6 0a9 9 0 10-18 0 9 9 0 0018 0z"></path></svg>',
                'order' => 1,
            ],
            [
                'name' => 'Humas',
                'description' => 'Hubungan Masyarakat - Mengelola komunikasi eksternal, membangun hubungan dengan stakeholder, dan meningkatkan reputasi organisasi melalui berbagai publikasi dan campaign.',
                'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.961 1.961 0 010-.882L15.24 9.092a1.96 1.96 0 00.882-1.961V7.882a1.961 1.961 0 00-1.961-1.961h-.063a1.961 1.961 0 00-1.961 1.961v-.882zM1.440 9v12a2 2 0 002 2h15.718a2 2 0 002-2V9M4 21h16"></path></svg>',
                'order' => 2,
            ],
            [
                'name' => 'Kominfo',
                'description' => 'Komunikasi Informatika - Mengelola platform digital, website, media sosial, dan sistem informasi organisasi untuk meningkatkan engagement dan transparansi komunikasi internal-eksternal.',
                'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20m0 0l-.75 3M9 20l3-3m0 0l3 3m-3-3v-6a9 9 0 11-18 0 9 9 0 0118 0v6m0 0l3-3m-3 3l-3-3"></path></svg>',
                'order' => 3,
            ],
            [
                'name' => 'KWU',
                'description' => 'Kewirausahaan - Memberdayakan anggota dengan program entrepreneurship, mentoring bisnis, dan koneksi dengan ekosistem startup untuk menciptakan wirausahawan muda yang kompetitif.',
                'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>',
                'order' => 4,
            ],
        ];

        foreach ($divisions as $division) {
            Division::create($division);
        }

        $this->command->info('✓ 4 divisions seeded successfully!');
    }
}
