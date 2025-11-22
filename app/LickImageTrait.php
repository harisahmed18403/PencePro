<?php

namespace App;

use App\Models\LickImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

trait LickImageTrait
{
    protected $storageDisk = 'public';
    protected $imageFolder = 'lick_images';
    protected $uploadExt = 'webp';
    protected $uploadQuality = 60;
    public function storeLickImage(UploadedFile $uploadedFile, $lick_id)
    {
        // Resize image to 300px
        $resizedimage = Image::read($uploadedFile)->scale(width: 300);

        $path = $this->imageFolder . DIRECTORY_SEPARATOR . Str::uuid() . '.' . $this->uploadExt;

        Storage::disk($this->storageDisk)->put(
            $path,
            $resizedimage->encodeByExtension($this->uploadExt, quality: $this->uploadQuality)
        );

        LickImage::create([
            'lick_id' => $lick_id,
            'image_path' => $path,
        ]);
    }

    public function deleteLickImage(LickImage $lickImage)
    {
        if ($lickImage) {
            // Delete file from storage
            if (Storage::disk($this->storageDisk)->exists($lickImage->image_path)) {
                Storage::disk($this->storageDisk)->delete($lickImage->image_path);
            }

            // Delete record from DB
            $lickImage->delete();

            return true;
        }

        return false;
    }

}
