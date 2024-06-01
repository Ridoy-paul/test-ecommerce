<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileHelper
{
    public static function uploadImage($file, $path)
    {
        $fileName = rand(100000, 999999) . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $fileName);
        return $fileName;
    }

    public static function deleteImage($filename, $directory)
    {
        $filePath = public_path($directory . '/' . $filename);
        if (File::exists($filePath)) {
            return File::delete($filePath);
        }
        return false;
    }
}
