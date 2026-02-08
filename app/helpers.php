<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('storage_url')) {
    /**
     * Generate a URL for a file in storage.
     * Uses temporaryUrl for S3 disks, falls back to url() for local disk.
     */
    function storage_url(?string $path, int $expirationMinutes = 60): ?string
    {
        if (empty($path)) {
            return null;
        }

        $disk = Storage::disk();

        if (method_exists($disk, 'temporaryUrl')) {
            try {
                return $disk->temporaryUrl($path, now()->addMinutes($expirationMinutes));
            } catch (RuntimeException) {
                return $disk->url($path);
            }
        }

        return $disk->url($path);
    }
}
