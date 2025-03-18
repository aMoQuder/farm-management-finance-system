<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WorkerGroup extends Model
{
    protected $fillable = [
        'supervisor_id',
        'worker_count',
        'daily_wage',
        'work_date',
        'work',
        'type_work',
        'Land_id'
    ];


    public function WorkerGroupable(): MorphTo
    {
        return $this->morphTo();
    }
    public function supervisor()
    {
        return $this->belongsTo(Workervisour::class, 'supervisor_id');
    }
    public function landWorking()
    {
        return $this->belongsTo(Land::class, 'Land_id');
    }

}
