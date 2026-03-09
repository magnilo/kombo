<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    /**
     * Upload an image to storage
     *
     * @param UploadedFile $file
     * @param string $directory
     * @return string Path to uploaded file
     */
    public function upload(UploadedFile $file, string $directory = 'images'): string
    {
        return $file->store($directory, 'public');
    }

    /**
     * Delete an image from storage
     *
     * @param string|null $path
     * @return bool
     */
    public function delete(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        return Storage::disk('public')->delete($path);
    }

    /**
     * Update image: delete old and upload new
     *
     * @param UploadedFile $newFile
     * @param string|null $oldPath
     * @param string $directory
     * @return string Path to new uploaded file
     */
    public function update(UploadedFile $newFile, ?string $oldPath, string $directory = 'images'): string
    {
        $this->delete($oldPath);
        return $this->upload($newFile, $directory);
    }
}
