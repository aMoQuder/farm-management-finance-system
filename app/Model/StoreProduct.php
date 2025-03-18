<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    protected $fillable = ['product_name', 'quantity', 'price', 'store_id'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
