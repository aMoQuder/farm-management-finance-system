<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Crop extends Model
{
    protected $fillable = ['name','seed_quantity', 'seed_price', 'seed_acquired_date'];
    public function Landable(): MorphTo
    {
        return $this->morphTo();
    }
    public function FertilizerCrop(): MorphMany {
        return $this->morphMany( Fertilizer::class, 'Fertilizerable' );
    }

    public function MachineJobCrop(): MorphMany {
        return $this->morphMany( MachineJob::class, 'MachineJobable' );
    }
    public function WorkerGroupCrop(): MorphMany {
        return $this->morphMany( WorkerGroup::class, 'WorkerGroupable' );
    }


}
