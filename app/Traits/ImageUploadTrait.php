<?php

namespace App\Traits;

use App\Models\Cruds\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

trait ImageUploadTrait
{
    public function addImage(object $image, object $model, string $folder, string $as = 'random')
    {
        if (isset($image)) {
            try {
                $imgPath = match ($as) {
                    'random' => $image->store($folder, 'images'),
                    default => $image->storeAs($folder, $as, 'images'),
                };
                
                $newImg = new Image(['path' => $imgPath]);
                $newImg->imageable()->associate($model);
                $newImg->save();
            } catch (Throwable $e) {
                logger()->error("Image upload failed: " . $e->getMessage());
            }
        }
    }

    public function deleteImage($image)
    {
        if ($image) {
            try {
                Storage::disk('images')->delete($image->path);
                $image->delete();
            } catch (Throwable $e) {
                logger()->error("Image delete failed: " . $e->getMessage());
            }
        }
    }
}
