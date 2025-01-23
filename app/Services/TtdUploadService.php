<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;


class TtdUploadService
{
    protected $ttdUploadService;

    public function store($signature, $prefix)
    {
        // Decode Base64
        $signature = str_replace('data:image/png;base64,', '', $signature);
        $signature = str_replace(' ', '+', $signature);
        $image = base64_decode($signature);

        // Generate unique filename
        $fileName = $prefix . '_' . time() . '.png';

        // Path untuk menyimpan file
        $filePath = 'signatures/' . $fileName;

        // Simpan file ke storage
        Storage::disk('public')->put($filePath, $image);
        return $filePath; // Kembalikan path untuk disimpan ke database
    }
}
