<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExpenCompany extends Model
{
    protected $fillable = ['amount', 'date', 'reason','receiver','cash_id'];

    public function ExpenComcash()
    {
        return $this->belongsTo(CashBox::class, 'cash_id');
    }
}
