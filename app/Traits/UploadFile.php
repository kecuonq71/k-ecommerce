<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadFile
{

    public function uploadImage(UploadedFile $file, string $type = 'brands'): string
    {
        $folder = 'uploads/' . strtolower(class_basename($type)); // Brand → brand
        $fileName = time() . '-' . uniqid() . '-' . $file->getClientOriginalName();

        Storage::disk('public')->makeDirectory($folder);
        $file->storeAs($folder, $fileName, 'public');

        return $fileName;
    }

    public function uploadMultipleImages(array $file, string $type = 'products/thumbnails'): array {
        $folder = 'uploads/' . strtolower($type); // Product → product
        $fileNames = [];

        foreach ($file as $item) {
            $fileName = time() . '-' . uniqid() . '-' . $item->getClientOriginalName();
            Storage::disk('public')->makeDirectory($folder);
            $item->storeAs($folder, $fileName, 'public');
            $fileNames[] = $fileName;
        }

        return $fileNames;
    }
}
