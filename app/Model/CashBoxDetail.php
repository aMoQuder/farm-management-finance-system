<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CashBoxDetail extends Model
{
    protected $fillable = ['amount', 'date', 'receiver','description'];
    public function cashable(): MorphTo
    {
        return $this->morphTo();
    }

}
