<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LickImage extends Model
{
    protected $table = "lick_images";
    protected $fillable = ['lick_id', 'image_path'];

    public function lick()
    {
        return $this->belongsTo(Lick::class);
    }
}
