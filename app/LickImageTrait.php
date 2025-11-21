<?php

namespace App;

use App\Models\LickImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait LickImageTrait
{
    public function storeLickImage(UploadedFile $image, $lick_id)
    {
        $path = $image->store('lick_images', 'public');

        LickImage::create([
            'lick_id' => $lick_id,
            'image_path' => $path,
        ]);
    }

    public function deleteLickImage(LickImage $lickImage)
    {
        if ($lickImage) {
            // Delete file from storage
            if (Storage::disk('public')->exists($lickImage->image_path)) {
                Storage::disk('public')->delete($lickImage->image_path);
            }

            // Delete record from DB
            $lickImage->delete();

            return true;
        }

        return false;
    }

}
