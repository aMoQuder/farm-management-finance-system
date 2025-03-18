<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CashBox extends Model
{
    protected $fillable = ['amount', 'date', 'receiver','source','description'];
    public function CashDetails(): MorphMany {
        return $this->morphMany( CashBoxDetail::class, 'cashable' );
    }
    public function ExpenComcash() {
        return $this->hasMany( ExpenCompany::class, 'cash_id' );
    }
    public function ExpenDetcash() {
        return $this->hasMany( ExpenseDetail::class, 'cash_id' );
    }
    public function WorkerPaycash() {
        return $this->hasMany( worker_payment::class, 'cash_id' );
    }
}
