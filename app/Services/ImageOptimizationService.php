<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GdDriver;
use Illuminate\Support\Facades\Storage;

class ImageOptimizationService
{
    protected $manager;
    protected $maxWidth = 1200;
    protected $maxHeight = 1200;
    protected $quality = 80; // 0-100

    public function __construct()
    {
        $this->manager = new ImageManager(new GdDriver());
    }

    /**
     * Optimize and save image
     */
    public function optimizeAndSave($file, $directory = 'images')
    {
        if (!$file) {
            return null;
        }

        try {
            // Read the image
            $image = $this->manager->read($file);

            // Resize if necessary
            if ($image->width() > $this->maxWidth || $image->height() > $this->maxHeight) {
                $image = $image->scaleDown(
                    width: $this->maxWidth,
                    height: $this->maxHeight
                );
            }

            // Generate unique filename
            $filename = uniqid() . '_' . time() . '.webp';

            // Save as WebP for better compression
            $imagePath = $directory . '/' . $filename;

            // Create directory if not exists
            if (!file_exists(public_path($directory))) {
                mkdir(public_path($directory), 0755, true);
            }

            // Save the optimized image
            $image->toWebp($this->quality)
                  ->save(public_path($imagePath));

            return $imagePath;

        } catch (\Exception $e) {
            logger()->error('Image optimization failed', ['error' => $e->getMessage()]);
            // Fallback: save original image
            return $this->saveOriginal($file, $directory);
        }
    }

    /**
     * Save original image as fallback
     */
    private function saveOriginal($file, $directory = 'images')
    {
        try {
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($directory), $filename);
            return $directory . '/' . $filename;
        } catch (\Exception $e) {
            logger()->error('Failed to save original image', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Delete image
     */
    public function deleteImage($imagePath)
    {
        if ($imagePath && file_exists(public_path($imagePath))) {
            try {
                unlink(public_path($imagePath));
                return true;
            } catch (\Exception $e) {
                logger()->error('Failed to delete image', ['error' => $e->getMessage()]);
                return false;
            }
        }
        return true;
    }

    /**
     * Generate thumbnail
     */
    public function generateThumbnail($imagePath, $width = 300, $height = 300)
    {
        if (!$imagePath || !file_exists(public_path($imagePath))) {
            return null;
        }

        try {
            $image = $this->manager->read(public_path($imagePath));

            $thumbFilename = 'thumb_' . uniqid() . '.webp';
            $thumbPath = 'images/thumbnails/' . $thumbFilename;

            // Create thumbnails directory if not exists
            if (!file_exists(public_path('images/thumbnails'))) {
                mkdir(public_path('images/thumbnails'), 0755, true);
            }

            $image->scaleDown(width: $width, height: $height)
                  ->toWebp($this->quality)
                  ->save(public_path($thumbPath));

            return $thumbPath;

        } catch (\Exception $e) {
            logger()->error('Thumbnail generation failed', ['error' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Set compression quality
     */
    public function setQuality($quality)
    {
        $this->quality = max(0, min(100, $quality));
        return $this;
    }

    /**
     * Set max dimensions
     */
    public function setMaxDimensions($width, $height)
    {
        $this->maxWidth = $width;
        $this->maxHeight = $height;
        return $this;
    }
}
