<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MachineJob extends Model
{
    protected $fillable = ['machine_name', 'driver_id', 'Work_name','Work_day','Count_hour','Land_id'];

    public function driver()
    {
        return $this->belongsTo(Worker::class, 'driver_id');
    }
    public function MachineJobable(): MorphTo
    {
        return $this->morphTo();
    }
    public function landMachine()
    {
        return $this->belongsTo(Land::class, 'land_id');
    }

}
