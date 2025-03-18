<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\MorphMany;

class StoreDetails extends Model
{
    protected $fillable = ['getter_name','get_date','quantity','land_id','crop_id'];

    public function Storeable(): MorphTo
    {
        return $this->morphTo();
    }
    
    public function landstore()
    {
        return $this->belongsTo(Land::class, 'land_id');
    }

    public function cropstore()
    {
        return $this->belongsTo(Crop::class, 'crop_id');
    }
}
