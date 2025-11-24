<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spit extends Model
{
    protected $fillable = ['lick_id', 'revenue', 'date'];

    public function lick()
    {
        return $this->belongsTo(Lick::class, 'lick_id');
    }
}
