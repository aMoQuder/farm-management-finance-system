<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class worker_payment extends Model
{
    protected $fillable = ['amount', 'date', 'receiver','cash_id'];
    public function paymentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function WorkerPaycash()
    {
        return $this->belongsTo(CashBox::class, 'cash_id');
    }
}
