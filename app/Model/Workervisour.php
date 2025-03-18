<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\MorphMany;


class Workervisour extends Model
{
     protected $fillable = [ 'name' ];

    public function workerSupervised() {
        return $this->hasMany( WorkerGroup::class, 'supervisor_id' );
    }

    public function payments(): MorphMany {
        return $this->morphMany( worker_payment::class, 'paymentable' );
    }
}
