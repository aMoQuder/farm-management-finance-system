<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\MorphMany;


class Land extends Model
{
    protected $fillable = ['name', 'area', 'supervisor_id'];

    public function supervisor()
    {
        return $this->belongsTo(Worker::class, 'supervisor_id');
    }
    public function LandCrops(): MorphMany {
        return $this->morphMany( Crop::class, 'Landable' );
    }

    public function landWorking() {
        return $this->hasMany( WorkerGroup::class, 'Land_id' );
    }
    public function landMachine() {
        return $this->hasMany( MachineJob::class, 'land_id' );
    }
    public function landFertilizer() {
        return $this->hasMany( Fertilizer::class, 'land_id' );
    }

}
