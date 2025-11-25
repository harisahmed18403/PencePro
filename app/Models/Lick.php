<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lick extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'cost', 'profit', 'date'];

    public function spit()
    {
        return $this->hasOne(Spit::class, 'lick_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(LickImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
