<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BeritaImageSeeder extends Seeder
{
    public function run(): void
    {
        $beritas = Berita::whereNull('image')->get();
        $successCount = 0;

        foreach ($beritas as $berita) {
            try {
                // Generate a placeholder image using GD library
                $image = imagecreatetruecolor(800, 500);
                
                // Define colors
                $colors = [
                    ['r' => 59, 'g' => 130, 'b' => 246],   // Blue
                    ['r' => 29, 'g' => 78, 'b' => 216],    // Dark Blue  
                    ['r' => 37, 'g' => 99, 'b' => 235],    // Bright Blue
                    ['r' => 15, 'g' => 23, 'b' => 42],     // Dark Slate
                ];
                
                $color = $colors[array_rand($colors)];
                $bgColor = imagecolorallocate($image, $color['r'], $color['g'], $color['b']);
                imagefill($image, 0, 0, $bgColor);
                
                // Add decorative elements
                $lightColor = imagecolorallocate($image, 255, 255, 255);
                for ($i = 0; $i < 3; $i++) {
                    imagefilledrectangle($image, rand(100, 700), rand(-50, 550), 
                        rand(100, 700) + rand(50, 100), rand(-50, 550) + rand(50, 100), 
                        imagecolorallocate($image, rand(200, 255), rand(200, 255), 255) 
                    );
                }
                
                // Add text - title
                $textColor = imagecolorallocate($image, 255, 255, 255);
                $title = substr($berita->title, 0, 50);
                imagestring($image, 5, 20, 220, $title, $textColor);
                
                // Save to temp location
                $tempPath = sys_get_temp_dir() . '/berita_' . uniqid() . '.jpg';
                imagejpeg($image, $tempPath, 85);
                imagedestroy($image);
                
                // Read and store
                $imageContent = file_get_contents($tempPath);
                $filename = 'berita/' . uniqid('news_') . '.jpg';
                Storage::disk('public')->put($filename, $imageContent);
                
                // Update berita
                $berita->update(['image' => $filename]);
                @unlink($tempPath);
                
                $successCount++;
                $this->command->info("✓ Generated placeholder for: {$berita->title}");
                
            } catch (\Exception $e) {
                $this->command->warn("✗ Failed: {$e->getMessage()}");
            }
        }

        $this->command->info("\n✓ Complete! Generated: $successCount images");
    }
}
