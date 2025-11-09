<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lick extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'revenue'];

    public function spit()
    {
        return $this->hasOne(Spit::class, 'lick_id', 'id');
    }

    public function profit()
    {
        $lickRevenue = $this->revenue ?? 0;
        $spitRevenue = $this->spit?->revenue ?? 0;

        return $spitRevenue - $lickRevenue;

    }
}
