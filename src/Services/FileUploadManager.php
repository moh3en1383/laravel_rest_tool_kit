<?php

namespace App\LaravelRestToolkit\Services;

use Illuminate\Support\Facades\Storage;

class FileUploadManager
{
    /**
     * Upload a single file to the 'files' directory in the 'public' disk.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string|false
     */
    public static function uploadFile($file)
    {
        return $file->store('files', 'public');
    }

    /**
     * Upload a collection of files to the 'files' directory in the 'public' disk.
     *
     * @param array|\Illuminate\Http\UploadedFile[] $files
     * @return array
     */
    public static function uploadFileCollection($files)
    {
        $filePath = [];
        foreach ($files as $file) {
            $filePath[] = $file->store('files', 'public');
        }
        return $filePath;
    }

    /**
     * Delete a file from the 'public' disk.
     *
     * @param string $path
     * @return bool
     */
    public static function deleteFile($path)
    {
        return Storage::disk('public')->delete($path);
    }

    /**
     * Upload an image to the 'image' directory in the 'public' disk.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string|false
     */
    public static function uploadImage($file)
    {
        return $file->store('image', 'public');
    }

    /**
     * Convert a file to Base64 format.
     *
     * @param string $path
     * @return string|null
     */
    public static function convertToBase64($path)
    {
        // Check if the file exists in the public disk
        if ($path && Storage::disk('public')->exists($path)) {
            // Get file content from the path
            $fileData = Storage::disk('public')->get($path);
            // Get file MIME type
            $mimeType = Storage::disk('public')->mimeType($path);
            // Convert file to Base64
            $base64File = base64_encode($fileData);
            // Return file in Base64 format with MIME type
            return 'data:' . $mimeType . ';base64,' . $base64File;
        }

        return null; // If the file doesn't exist
    }
}
