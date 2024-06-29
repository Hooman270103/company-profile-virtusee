<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public static function upload($folderName, $file)
    {
        $path = 'uploads/' . $folderName;
        $filePath = Storage::disk('resources')->put($path, $file);

        // Tentukan perizinan file yang diunggah
        Storage::disk('resources')->setVisibility($filePath, 'public');

        return $filePath;
    }
}