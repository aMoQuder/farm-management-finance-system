<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Fertilizer extends Model
{
    protected $fillable = ['quantity', 'type_quantity', 'acquired_date', 'name','land_id'];


    public function Fertilizerable(): MorphTo
    {
        return $this->morphTo();
    }
    public function landFertilizer()
    {
        return $this->belongsTo(Land::class, 'land_id');
    }
}
