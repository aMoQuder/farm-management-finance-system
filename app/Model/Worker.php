<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\MorphMany;


class Worker extends Model {
    protected $fillable = [ 'name', 'salary', 'days_worked','job' ];

    public function expenses(): MorphMany {
        return $this->morphMany( ExpenseDetail::class, 'expensable' );
    }

    public function landsSupervised() {
        return $this->hasMany( Land::class, 'supervisor_id' );
    }

    public function machineJobs() {
        return $this->hasMany( MachineJob::class, 'driver_id' );
    }
}
