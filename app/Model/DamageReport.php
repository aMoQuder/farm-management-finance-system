<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DamageReport extends Model
{
    protected $fillable = ['product_id', 'machine_job_id', 'hours_worked'];

    public function product()
    {
        return $this->belongsTo(StoreProduct::class);
    }

    public function machineJob()
    {
        return $this->belongsTo(MachineJob::class);
    }

    public function expenses(): MorphMany
    {
        return $this->morphMany(ExpenseDetail::class, 'expensable');
    }
}
