<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExpenseDetail extends Model
{
    protected $fillable = ['amount', 'date', 'reason','cash_id'];

    public function expensable(): MorphTo
    {
        return $this->morphTo();
    }
    public function ExpenDetcash()
    {
        return $this->belongsTo(CashBox::class, 'cash_id');
    }
}
