<?php

namespace App\Traits;

use App\Models\Cruds\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageUploadTrait
{
    public function addImage(object $image, object $model, string $folder, string $as = 'random')
    {
        if (isset($image)) {
            $imgPath = match ($as) {
                'random' => $image->store($folder, 'images'),
                default => $image->storeAs($folder, $as, 'images'),
            };
            
            $newImg = new Image(['path' => $imgPath]);
            $newImg->imageable()->associate($model);
            $newImg->save();
        }
    }

    public function deleteImage($image)
    {
        if ($image) {
            Storage::disk('images')->delete($image->path);
            $image->delete();
        }
    }
}
