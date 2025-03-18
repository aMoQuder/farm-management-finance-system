<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\MorphMany;

class Store extends Model
{
    protected $fillable = ['name','quantity','store_date','type_store','type_quantity'];

    public function StoreDetails(): MorphMany {
        return $this->morphMany( StoreDetails::class, 'Storeable' );
    }
}
