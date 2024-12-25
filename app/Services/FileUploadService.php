<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public static function uploadPolygonFile(UploadedFile $file): string
    {
        $filename = time() . '-' . $file->getClientOriginalName();
        return $file->storeAs('mpa_data', $filename, 'public');
    }
}
