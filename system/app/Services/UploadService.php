<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use InvalidArgumentException;

class UploadService
{
    /**
     * Upload a file or image, convert image to webp if applicable.
     *
     * @param UploadedFile $img
     * @param string $folder
     * @return string Relative path to the uploaded file
     * @throws InvalidArgumentException
     */
    public function upload($img, $folder)
    {
        try {
            $folder_ext = explode('/', $folder);
            // Ambil BASE_PATH dari env, pastikan ada trailing slash
            $basePath = rtrim(env('BASE_PATH', base_path('public')), '/\\') . '/';
            $storagePath = $basePath . 'storage/upload/' . $folder;

            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0755, true);
            }

            $extension = strtolower($img->getClientOriginalExtension());
            $filename = rand(100000, 999999) . '_' . $folder_ext[0];

            $mimeType = $img->getMimeType();
            $isImage = str_starts_with($mimeType, 'image/');

            // Jika gambar, convert ke webp
            if ($isImage) {
                $webpPath = $storagePath . '/' . $filename . '.webp';

                Image::make($img)
                    ->encode('webp', 90)
                    ->save($webpPath);

                // return relative path (tanpa base path)
                return 'storage/upload/' . $folder . '/' . $filename . '.webp';
            }

            // Jika bukan gambar, simpan file asli
            $originalFileName = $filename . '.' . $extension;
            $img->move($storagePath, $originalFileName);

            return 'storage/upload/' . $folder . '/' . $originalFileName;
        } catch (\Throwable $th) {
            throw new InvalidArgumentException($th->getMessage(), 500);
        }
    }

    /**
     * Delete a file by its relative path.
     *
     * @param string $relativePath
     * @return bool
     * @throws InvalidArgumentException
     */
    public function deleteFile($relativePath)
    {
        try {
            if (empty($relativePath)) {
                return false;
            }

            $basePath = rtrim(env('BASE_PATH', base_path('public')), '/\\') . '/';
            $filePath = $basePath . ltrim($relativePath, '/\\');

            if (file_exists($filePath)) {
                unlink($filePath);
                return true;
            }

            return false;
        } catch (\Throwable $th) {
            throw new InvalidArgumentException($th->getMessage(), 500);
        }
    }
} 